<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Report;
use App\Models\Resource;
use App\Models\ResourceDownload;
use App\Models\ResourceType;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class ResourceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Resource::approved()
            ->with(['program', 'semester', 'subject', 'resourceType', 'user']);

        // Search term
        if ($request->filled('q')) {
            $query->search($request->input('q'));
        }

        // Filters
        if ($request->filled('course')) {
            $course = (string) $request->input('course');
            $query->whereHas('program', function ($q) use ($course) {
                $q->where(function ($sub) use ($course) {
                    $sub->where('slug', $course);
                    if (is_numeric($course)) {
                        $sub->orWhere('id', (int) $course);
                    }
                });
            });
        }

        if ($request->filled('semester')) {
            $semester = (string) $request->input('semester');
            $query->whereHas('semester', function ($q) use ($semester) {
                $q->where(function ($sub) use ($semester) {
                    $sub->where('slug', $semester);
                    if (is_numeric($semester)) {
                        $sub->orWhere('semester_number', (int) $semester)
                            ->orWhere('id', (int) $semester);
                    }
                });
            });
        }

        if ($request->filled('type')) {
            $type = (string) $request->input('type');
            $query->whereHas('resourceType', function ($q) use ($type) {
                $q->where(function ($sub) use ($type) {
                    $sub->where('slug', $type);
                    if (is_numeric($type)) {
                        $sub->orWhere('id', (int) $type);
                    }
                });
            });
        }

        $resources = $query->latest()->paginate(15)->withQueryString();

        $courses = Program::where('is_active', true)->orderBy('sort_order')->get();
        $resourceTypes = ResourceType::where('is_active', true)->orderBy('sort_order')->get();

        return view('resources.index', compact('resources', 'courses', 'resourceTypes'));
    }

    public function show(string $program_slug, string $semester_slug, string $subject_slug, string $resource_slug): View
    {
        $resource = Resource::where('slug', $resource_slug)
            ->with(['program', 'semester', 'subject', 'resourceType', 'user'])
            ->firstOrFail();

        // Must be approved to view, or owner/admin
        if (!$resource->isApproved()) {
            if (!Auth::check() || (!Auth::user()->isAdmin() && Auth::id() !== $resource->user_id)) {
                abort(404);
            }
        }

        // Related resources in same subject or program
        $relatedResources = Resource::approved()
            ->where('id', '!=', $resource->id)
            ->where(function ($q) use ($resource) {
                $q->where('subject_id', $resource->subject_id)
                  ->orWhere('program_id', $resource->program_id);
            })
            ->with(['program', 'semester', 'resourceType'])
            ->take(4)
            ->get();

        return view('resources.show', compact('resource', 'relatedResources'));
    }

    public function download(int $id)
    {
        $resource = Resource::findOrFail($id);

        if (!$resource->isApproved()) {
            if (!Auth::check() || (!Auth::user()->isAdmin() && Auth::id() !== $resource->user_id)) {
                abort(403, 'This resource is pending approval and cannot be downloaded.');
            }
        }

        // Check if file exists in storage
        if (!Storage::disk('local')->exists($resource->file_path)) {
            abort(404, 'The requested file could not be found on storage.');
        }

        // Increment downloads count safely
        $resource->increment('downloads_count');

        // Log download
        try {
            ResourceDownload::create([
                'resource_id' => $resource->id,
                'user_id' => Auth::id(),
                'ip_address' => request()->ip(),
                'user_agent' => substr(request()->userAgent() ?? '', 0, 500),
                'downloaded_at' => now(),
            ]);
        } catch (\Throwable $e) {
            // Ignore logging exception
        }

        return Storage::disk('local')->download($resource->file_path, $resource->file_name);
    }

    public function preview(int $id): Response
    {
        $resource = Resource::findOrFail($id);

        if (!$resource->isApproved()) {
            if (!Auth::check() || (!Auth::user()->isAdmin() && Auth::id() !== $resource->user_id)) {
                abort(403, 'Preview not available for unapproved materials.');
            }
        }

        if (!Storage::disk('local')->exists($resource->file_path)) {
            abort(404, 'File not found on server.');
        }

        $file = Storage::disk('local')->get($resource->file_path);
        $mime = $resource->mime_type ?: 'application/pdf';

        return response($file, 200, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . $resource->file_name . '"',
        ]);
    }

    public function report(Request $request, int $id)
    {
        $resource = Resource::findOrFail($id);

        $validated = $request->validate([
            'reason' => ['required', 'in:wrong_content,duplicate,copyright,incorrect_info,offensive,broken_file,other'],
            'details' => ['required', 'string', 'max:1000'],
            'reporter_name' => ['required', 'string', 'max:255'],
            'reporter_email' => ['required', 'email', 'max:255'],
        ]);

        Report::create([
            'resource_id' => $resource->id,
            'user_id' => Auth::id(),
            'reporter_name' => $validated['reporter_name'],
            'reporter_email' => $validated['reporter_email'],
            'reason' => $validated['reason'],
            'details' => $validated['details'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your report has been submitted to the moderation team. Thank you for helping keep RCU Hub clean.');
    }
}
