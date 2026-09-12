<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Program;
use App\Models\ResourceType;
use App\Models\Semester;
use App\Models\Subject;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AcademicController extends Controller
{
    // ==========================================
    // DEPARTMENTS
    // ==========================================
    public function departments(): View
    {
        $departments = Department::withCount(['programs', 'resources'])->orderBy('sort_order')->get();
        return view('admin.academic.departments', compact('departments'));
    }

    public function storeDepartment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $slug = Str::slug($validated['name']) ?: ('dept-' . time());
        $originalSlug = $slug;
        $counter = 1;
        while (Department::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $dept = Department::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'code' => $validated['code'] ? strtoupper(trim($validated['code'])) : null,
            'description' => $validated['description'] ?? null,
            'is_active' => true,
            'sort_order' => Department::count() + 1,
        ]);

        AuditService::log('department_created', "Created department '{$dept->name}'", $dept);
        return back()->with('success', "Department '{$dept->name}' created successfully.");
    }

    public function destroyDepartment(int $id): RedirectResponse
    {
        $dept = Department::withCount(['programs', 'resources'])->findOrFail($id);

        if ($dept->programs_count > 0 || $dept->resources_count > 0) {
            return back()->with('error', "Cannot delete department '{$dept->name}' because it contains {$dept->programs_count} programs and {$dept->resources_count} resources.");
        }

        $deptName = $dept->name;
        $dept->delete();

        AuditService::log('department_deleted', "Deleted department '{$deptName}'");
        return back()->with('success', "Department '{$deptName}' deleted successfully.");
    }

    // ==========================================
    // PROGRAMS / DEGREES
    // ==========================================
    public function programs(): View
    {
        $programs = Program::with(['department', 'semesters'])->withCount('resources')->orderBy('sort_order')->get();
        $departments = Department::where('is_active', true)->get();
        return view('admin.academic.programs', compact('programs', 'departments'));
    }

    public function storeProgram(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50'],
            'total_semesters' => ['required', 'integer', 'min:1', 'max:16'],
            'badge_color' => ['nullable', 'string', 'in:blue,green,orange,purple,teal'],
        ]);

        $slug = Str::slug($validated['code']) ?: Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Program::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $program = Program::create([
            'department_id' => $validated['department_id'],
            'name' => $validated['name'],
            'code' => strtoupper(trim($validated['code'])),
            'slug' => $slug,
            'total_semesters' => $validated['total_semesters'],
            'badge_color' => $validated['badge_color'] ?? 'blue',
            'is_active' => true,
            'sort_order' => Program::count() + 1,
        ]);

        // Auto-generate requested semesters
        for ($i = 1; $i <= $validated['total_semesters']; $i++) {
            Semester::create([
                'program_id' => $program->id,
                'semester_number' => $i,
                'name' => "Semester {$i}",
                'slug' => "semester-{$i}",
                'is_active' => true,
            ]);
        }

        AuditService::log('program_created', "Created program '{$program->name}' with {$program->total_semesters} semesters", $program);
        return back()->with('success', "Degree program '{$program->name}' and {$program->total_semesters} semesters created successfully.");
    }

    public function destroyProgram(int $id): RedirectResponse
    {
        $program = Program::withCount(['resources', 'subjects'])->findOrFail($id);

        if ($program->resources_count > 0 || $program->subjects_count > 0) {
            return back()->with('error', "Cannot delete program '{$program->name}' because it contains {$program->subjects_count} subjects and {$program->resources_count} uploaded resources.");
        }

        $programName = $program->name;
        $program->semesters()->delete();
        $program->delete();

        AuditService::log('program_deleted', "Deleted program '{$programName}' and its empty semesters");
        return back()->with('success', "Degree program '{$programName}' deleted successfully.");
    }

    // ==========================================
    // SEMESTERS
    // ==========================================
    public function semesters(Request $request): View
    {
        $programs = Program::where('is_active', true)->orderBy('name')->get();
        $selectedProgramId = $request->input('program_id', $programs->first()?->id);

        $query = Semester::with('program')
            ->withCount(['subjects', 'resources'])
            ->orderBy('semester_number');

        if ($selectedProgramId) {
            $query->where('program_id', $selectedProgramId);
        }

        $semesters = $query->paginate(20)->withQueryString();

        return view('admin.academic.semesters', compact('programs', 'semesters', 'selectedProgramId'));
    }

    public function storeSemester(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
            'semester_number' => ['required', 'integer', 'min:1', 'max:20'],
            'name' => ['nullable', 'string', 'max:100'],
        ]);

        $exists = Semester::where('program_id', $validated['program_id'])
            ->where('semester_number', $validated['semester_number'])
            ->first();

        if ($exists) {
            return back()->with('error', "Semester {$validated['semester_number']} already exists for this program.");
        }

        $name = !empty($validated['name']) ? trim($validated['name']) : "Semester {$validated['semester_number']}";
        $slug = "semester-{$validated['semester_number']}";

        $semester = Semester::create([
            'program_id' => $validated['program_id'],
            'semester_number' => $validated['semester_number'],
            'name' => $name,
            'slug' => $slug,
            'is_active' => true,
        ]);

        // Keep program total_semesters count updated if added semester is higher
        $program = Program::find($validated['program_id']);
        if ($program && $validated['semester_number'] > $program->total_semesters) {
            $program->update(['total_semesters' => $validated['semester_number']]);
        }

        AuditService::log('semester_created', "Created {$semester->name} for program '{$program?->name}'", $semester);
        return back()->with('success', "{$semester->name} added successfully.");
    }

    public function destroySemester(int $id): RedirectResponse
    {
        $semester = Semester::withCount(['subjects', 'resources'])->with('program')->findOrFail($id);

        if ($semester->subjects_count > 0 || $semester->resources_count > 0) {
            return back()->with('error', "Cannot delete '{$semester->name}' because it contains {$semester->subjects_count} subjects and {$semester->resources_count} uploaded resources.");
        }

        $name = $semester->name;
        $semester->delete();

        AuditService::log('semester_deleted', "Deleted semester '{$name}'");
        return back()->with('success', "Semester '{$name}' deleted successfully.");
    }

    // ==========================================
    // SUBJECTS
    // ==========================================
    public function subjects(Request $request): View
    {
        $programs = Program::where('is_active', true)->get();
        $selectedProgramId = $request->input('program_id', $programs->first()?->id);

        $semesters = Semester::where('program_id', $selectedProgramId)->orderBy('semester_number')->get();
        $subjects = Subject::with(['program', 'semester'])
            ->when($selectedProgramId, function ($q) use ($selectedProgramId) {
                $q->where('program_id', $selectedProgramId);
            })
            ->withCount('resources')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.academic.subjects', compact('programs', 'semesters', 'subjects', 'selectedProgramId'));
    }

    public function storeSubject(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
            'semester_id' => ['required', 'exists:semesters,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $slug = Str::slug($validated['name']) ?: ('subject-' . time());
        $originalSlug = $slug;
        $counter = 1;
        while (Subject::where('program_id', $validated['program_id'])->where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $subject = Subject::create([
            'program_id' => $validated['program_id'],
            'semester_id' => $validated['semester_id'],
            'name' => $validated['name'],
            'code' => $validated['code'] ? strtoupper(trim($validated['code'])) : null,
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'is_active' => true,
        ]);

        AuditService::log('subject_created', "Created subject '{$subject->name}'", $subject);
        return back()->with('success', "Subject '{$subject->name}' added successfully.");
    }

    public function destroySubject(int $id): RedirectResponse
    {
        $subject = Subject::withCount('resources')->findOrFail($id);

        if ($subject->resources_count > 0) {
            return back()->with('error', "Cannot delete subject '{$subject->name}' because it contains {$subject->resources_count} uploaded resources.");
        }

        $subjectName = $subject->name;
        $subject->delete();

        AuditService::log('subject_deleted', "Deleted subject '{$subjectName}'");
        return back()->with('success', "Subject '{$subjectName}' deleted successfully.");
    }

    // ==========================================
    // RESOURCE TYPES
    // ==========================================
    public function resourceTypes(): View
    {
        $resourceTypes = ResourceType::withCount('resources')->orderBy('sort_order')->get();
        return view('admin.academic.resource-types', compact('resourceTypes'));
    }

    public function storeResourceType(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'color_theme' => ['required', 'string', 'in:blue,green,purple,orange,teal'],
            'icon' => ['nullable', 'string', 'max:50'],
        ]);

        $slug = Str::slug($validated['name']) ?: ('type-' . time());
        $originalSlug = $slug;
        $counter = 1;
        while (ResourceType::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $type = ResourceType::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'subtitle' => $validated['subtitle'] ?? null,
            'color_theme' => $validated['color_theme'],
            'icon' => $validated['icon'] ?? 'file-text',
            'is_active' => true,
            'sort_order' => ResourceType::count() + 1,
        ]);

        AuditService::log('resource_type_created', "Created resource type '{$type->name}'", $type);
        return back()->with('success', "Resource category '{$type->name}' created successfully.");
    }

    public function destroyResourceType(int $id): RedirectResponse
    {
        $type = ResourceType::withCount('resources')->findOrFail($id);

        if ($type->resources_count > 0) {
            return back()->with('error', "Cannot delete category '{$type->name}' because it contains {$type->resources_count} uploaded resources.");
        }

        $typeName = $type->name;
        $type->delete();

        AuditService::log('resource_type_deleted', "Deleted resource type '{$typeName}'");
        return back()->with('success', "Category '{$typeName}' deleted successfully.");
    }
}
