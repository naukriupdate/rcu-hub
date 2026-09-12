<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $reports = Report::with(['resource.program', 'resource.subject', 'user'])->latest()->paginate(15);
        return view('admin.reports.index', compact('reports'));
    }

    public function resolve(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:reviewed,dismissed,actioned'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $report = Report::findOrFail($id);
        $report->update($validated);

        if ($validated['status'] === 'actioned' && $report->resource) {
            // Unpublish the offending resource
            $report->resource->update(['status' => 'rejected', 'rejection_reason' => 'Unpublished following community violation report.']);
        }

        AuditService::log('report_resolved', "Report #{$report->id} marked as {$validated['status']}", $report);

        return back()->with('success', "Report #{$report->id} updated.");
    }
}
