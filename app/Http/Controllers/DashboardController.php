<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $totalUploads = Resource::where('user_id', $user->id)->count();
        $approvedUploads = Resource::where('user_id', $user->id)->where('status', 'approved')->count();
        $pendingUploads = Resource::where('user_id', $user->id)->where('status', 'pending')->count();
        $totalDownloadsReceived = Resource::where('user_id', $user->id)->sum('downloads_count');

        $recentUploads = Resource::where('user_id', $user->id)
            ->with(['program', 'semester', 'subject', 'resourceType'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'user',
            'totalUploads',
            'approvedUploads',
            'pendingUploads',
            'totalDownloadsReceived',
            'recentUploads'
        ));
    }

    public function myUploads(): View
    {
        $user = Auth::user();
        $resources = Resource::where('user_id', $user->id)
            ->with(['program', 'semester', 'subject', 'resourceType'])
            ->latest()
            ->paginate(10);

        return view('dashboard.my-uploads', compact('resources'));
    }

    public function profile(): View
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
