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
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'avatar.image' => 'The file uploaded must be a valid image file.',
            'avatar.mimes' => 'Profile photos must be in JPEG, PNG, or WebP format.',
            'avatar.max' => 'Profile photo size cannot exceed 2 MB.',
        ]);

        $user->name = $validated['name'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            if ($file->isValid()) {
                // Safely delete previous custom avatar if exists
                if ($user->avatar && str_starts_with($user->avatar, 'images/profile/') && file_exists(public_path($user->avatar))) {
                    @unlink(public_path($user->avatar));
                }

                // Ensure target directory exists
                $targetDir = public_path('images/profile');
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                // Generate safe, unguessable filename
                $extension = strtolower($file->getClientOriginalExtension());
                if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $extension = 'jpg';
                }
                $safeFilename = 'avatar_' . $user->id . '_' . bin2hex(random_bytes(10)) . '.' . $extension;

                $file->move($targetDir, $safeFilename);
                $user->avatar = 'images/profile/' . $safeFilename;
            }
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
