<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceUploadRequest;
use App\Models\Department;
use App\Models\Program;
use App\Models\Resource;
use App\Models\ResourceType;
use App\Models\Semester;
use App\Models\Subject;
use App\Services\AuditService;
use App\Services\FileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UploadController extends Controller
{
    public function create(): View
    {
        $departments = Department::where('is_active', true)->orderBy('sort_order')->get();
        $programs = Program::where('is_active', true)->orderBy('sort_order')->get();
        $resourceTypes = ResourceType::where('is_active', true)->orderBy('sort_order')->get();

        return view('upload.create', compact('departments', 'programs', 'resourceTypes'));
    }

    public function store(ResourceUploadRequest $request, FileUploadService $uploadService): RedirectResponse
    {
        $validated = $request->validated();

        // Perform secure file handling
        $fileData = $uploadService->upload($request->file('file'));

        // Generate clean SEO slug
        $subject = Subject::find($validated['subject_id']);
        $program = Program::find($validated['program_id']);
        $baseSlug = Str::slug(($program ? $program->code : '') . '-' . ($subject ? $subject->name : '') . '-' . $validated['title']);
        $uniqueSlug = $baseSlug . '-' . Str::random(5);

        $resource = Resource::create([
            'title' => $validated['title'],
            'slug' => $uniqueSlug,
            'description' => $validated['description'] ?? null,
            'user_id' => Auth::id(),
            'uploader_type' => $validated['uploader_type'],
            'uploader_name' => $validated['uploader_name'],
            'department_id' => $validated['department_id'],
            'program_id' => $validated['program_id'],
            'semester_id' => $validated['semester_id'],
            'subject_id' => $validated['subject_id'],
            'resource_type_id' => $validated['resource_type_id'],
            'academic_year' => $validated['academic_year'] ?? null,
            'file_path' => $fileData['file_path'],
            'file_name' => $fileData['file_name'],
            'file_type' => $fileData['file_type'],
            'mime_type' => $fileData['mime_type'],
            'file_size' => $fileData['file_size'],
            'file_hash' => $fileData['file_hash'],
            'status' => 'pending', // NEVER publish immediately!
        ]);

        AuditService::log('resource_uploaded', "Uploaded resource '{$resource->title}' pending review", $resource);

        return redirect()->route('dashboard.my-uploads')
            ->with('success', 'Resource uploaded successfully! It is now in the review queue and will be published once approved by moderators.');
    }
}
