<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::withCount('resources');

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%");
            });
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function toggleStatus(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot suspend your own administrative account.');
        }

        $newStatus = $user->status === 'active' ? 'blocked' : 'active';
        $user->status = $newStatus;
        $user->save();

        AuditService::log('user_status_toggled', "Changed user {$user->email} status to {$newStatus}", $user);

        return back()->with('success', "User {$user->name} is now {$newStatus}.");
    }

    public function changeRole(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'in:student,teacher'],
        ]);

        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Cannot alter your own administrative role.');
        }

        $user->role = $request->role;
        // If demoted from teacher, clear verification
        if ($request->role !== 'teacher') {
            $user->teacher_verified_at = null;
        }
        $user->save();

        AuditService::log('user_role_changed', "Changed user {$user->email} role to {$request->role}", $user);

        return back()->with('success', "Role for {$user->name} changed to {$request->role}.");
    }
}
