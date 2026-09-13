@extends('layouts.app')

@section('title', 'Student & Teacher Registration — RCU Student Resource Hub')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="clay-card p-6 sm:p-10 space-y-6">
        
        <div class="text-center space-y-2">
            <div class="clay-bubble clay-bubble-purple w-14 h-14 mx-auto mb-2">
                <i data-lucide="user-plus" class="w-7 h-7 text-white"></i>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Create Account</h1>
            <p class="text-xs sm:text-sm text-slate-400 font-medium">Fast, free registration for RCU students and teachers.</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-4 text-xs sm:text-sm">
            @csrf

            <div>
                <label class="block font-bold text-slate-700 mb-1.5">Full Name</label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 text-purple-400">
                        <i data-lucide="user" class="w-4 h-4"></i>
                    </div>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Your Full Name"
                        class="clay-input w-full pl-11 pr-4 py-3 text-sm font-medium">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1.5">Email Address</label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 text-purple-400">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                        class="clay-input w-full pl-11 pr-4 py-3 text-sm font-medium">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1.5">Password</label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 text-purple-400">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </div>
                    <input type="password" name="password" required placeholder="Minimum 8 characters"
                        class="clay-input w-full pl-11 pr-4 py-3 text-sm font-medium">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1.5">Confirm Password</label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 text-purple-400">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                    </div>
                    <input type="password" name="password_confirmation" required placeholder="Re-enter your password"
                        class="clay-input w-full pl-11 pr-4 py-3 text-sm font-medium">
                </div>
            </div>

            <div class="flex items-start gap-2 pt-1">
                <input type="checkbox" name="accept_terms" value="1" required id="accept_terms" class="mt-0.5 rounded text-[#6C5CE7] focus:ring-[#6C5CE7]">
                <label for="accept_terms" class="text-xs text-slate-500 font-medium leading-tight">
                    I agree to the <a href="{{ route('terms') }}" target="_blank" class="text-[#6C5CE7] underline font-bold">Terms of Service</a> and acknowledge the <a href="{{ route('disclaimer') }}" target="_blank" class="text-[#6C5CE7] underline font-bold">Academic Disclaimer</a>.
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="clay-btn clay-btn-primary w-full py-3.5 text-sm font-bold">
                    Register Account
                </button>
            </div>
        </form>

        <div class="pt-4 border-t border-purple-50 text-center text-xs text-slate-400 font-medium">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-bold text-[#6C5CE7] hover:underline">Sign In</a>
        </div>

    </div>
</div>
@endsection
