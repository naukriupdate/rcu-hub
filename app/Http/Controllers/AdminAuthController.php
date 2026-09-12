<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(): View
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if (!$user->isAdmin()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                AuditService::log('admin_login_denied', "Non-admin user {$credentials['email']} attempted admin login");

                throw ValidationException::withMessages([
                    'email' => 'Access denied. You do not possess administrative clearance.',
                ]);
            }

            if (!$user->isActive()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                throw ValidationException::withMessages([
                    'email' => 'Administrative account suspended.',
                ]);
            }

            $request->session()->regenerate();
            AuditService::log('admin_login_success', 'Admin logged in');

            return redirect()->intended(route('admin.dashboard'));
        }

        AuditService::log('admin_login_failed', "Failed admin login attempt for {$credentials['email']}");

        throw ValidationException::withMessages([
            'email' => 'Invalid administrative credentials.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        AuditService::log('admin_logout', 'Admin logged out');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Admin session terminated.');
    }
}
