<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeacherVerificationController extends Controller
{
    public function index(): View
    {
        $teachers = User::where('role', 'teacher')
            ->with(['department'])
            ->withCount(['resources' => function ($q) {
                $q->where('status', 'approved');
            }])
            ->latest()
            ->paginate(15);

        return view('admin.teachers.verification', compact('teachers'));
    }

    public function verify(int $id): RedirectResponse
    {
        $teacher = User::where('role', 'teacher')->findOrFail($id);

        $teacher->teacher_verified_at = now();
        $teacher->save();

        AuditService::log('teacher_verified', "Verified teacher badge granted to {$teacher->name} ({$teacher->email})", $teacher);

        return back()->with('success', "Teacher {$teacher->name} has been verified! The '🏅 Verified Teacher' badge is now visible on their resources.");
    }

    public function revoke(int $id): RedirectResponse
    {
        $teacher = User::where('role', 'teacher')->findOrFail($id);

        $teacher->teacher_verified_at = null;
        $teacher->save();

        AuditService::log('teacher_verification_revoked', "Revoked verified teacher badge from {$teacher->name}", $teacher);

        return back()->with('success', "Verification badge revoked for {$teacher->name}.");
    }
}
