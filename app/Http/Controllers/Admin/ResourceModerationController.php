<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Resource;
use App\Models\ResourceType;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ResourceModerationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Resource::with(['program', 'semester', 'subject', 'resourceType', 'user', 'approver']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $resources = $query->latest()->paginate(15)->withQueryString();
        $programs = Program::where('is_active', true)->get();
        $pendingCount = Resource::pending()->count();

        return view('admin.resources.index', compact('resources', 'programs', 'pendingCount'));
    }

    public function pending(): View
    {
        $resources = Resource::pending()
            ->with(['program', 'semester', 'subject', 'resourceType', 'user'])
            ->latest()
            ->paginate(15);

        return view('admin.resources.pending', compact('resources'));
    }

    public function review(int $id): View
    {
        $resource = Resource::with(['program', 'semester', 'subject', 'resourceType', 'user'])
            ->findOrFail($id);

        return view('admin.resources.review', compact('resource'));
    }

    public function approve(int $id): RedirectResponse
    {
        $resource = Resource::findOrFail($id);

        $resource->update([
            'status' => 'approved',
            'rejection_reason' => null,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        AuditService::log('resource_approved', "Approved resource '{$resource->title}'", $resource);

        return back()->with('success', "Resource '{$resource->title}' has been approved and is now live.");
    }

    public function reject(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'rejection_reason' => ['required', 'string', 'max:1000'],
        ]);

        $resource = Resource::findOrFail($id);

        $resource->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'approved_by' => Auth::id(),
            'approved_at' => null,
        ]);

        AuditService::log('resource_rejected', "Rejected resource '{$resource->title}' with reason: {$request->rejection_reason}", $resource);

        return back()->with('success', "Resource '{$resource->title}' has been rejected.");
    }

    public function destroy(int $id): RedirectResponse
    {
        $resource = Resource::findOrFail($id);

        // Delete physical file
        if (Storage::disk('local')->exists($resource->file_path)) {
            Storage::disk('local')->delete($resource->file_path);
        }

        $title = $resource->title;
        $resource->forceDelete();

        AuditService::log('resource_deleted', "Permanently deleted resource '{$title}'");

        return back()->with('success', "Resource '{$title}' permanently deleted.");
    }
}
