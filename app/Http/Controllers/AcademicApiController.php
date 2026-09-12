<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AcademicApiController extends Controller
{
    public function programs(Request $request): JsonResponse
    {
        $query = Program::where('is_active', true);

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        $programs = $query->orderBy('sort_order')->get(['id', 'name', 'code', 'slug']);
        return response()->json($programs);
    }

    public function semesters(Request $request): JsonResponse
    {
        $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
        ]);

        $semesters = Semester::where('program_id', $request->program_id)
            ->where('is_active', true)
            ->orderBy('semester_number')
            ->get(['id', 'name', 'semester_number', 'slug']);

        return response()->json($semesters);
    }

    public function subjects(Request $request): JsonResponse
    {
        $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
        ]);

        $query = Subject::where('program_id', $request->program_id)
            ->where('is_active', true);

        if ($request->filled('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }

        $subjects = $query->orderBy('name')->get(['id', 'name', 'code', 'slug']);
        return response()->json($subjects);
    }
}
