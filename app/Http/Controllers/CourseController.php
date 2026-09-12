<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        $departments = Department::where('is_active', true)
            ->with(['programs' => function ($q) {
                $q->where('is_active', true)->withCount(['resources' => function ($rq) {
                    $rq->where('status', 'approved');
                }]);
            }])
            ->orderBy('sort_order')
            ->get();

        return view('courses.index', compact('departments'));
    }

    public function show(string $slug): View
    {
        $program = Program::where('slug', $slug)
            ->where('is_active', true)
            ->with(['department', 'semesters.subjects' => function ($sq) {
                $sq->where('is_active', true)->withCount(['resources' => function ($rq) {
                    $rq->where('status', 'approved');
                }]);
            }])
            ->firstOrFail();

        return view('courses.show', compact('program'));
    }
}
