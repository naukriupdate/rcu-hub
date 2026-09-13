@extends('layouts.app')

@section('title', 'Sign In — RCU Student Resource Hub')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="clay-card p-6 sm:p-10 space-y-6">
        
        <div class="text-center space-y-2">
            <div class="clay-bubble clay-bubble-purple w-14 h-14 mx-auto mb-2">
                <i data-lucide="graduation-cap" class="w-7 h-7 text-white"></i>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Welcome Back</h1>
            <p class="text-xs sm:text-sm text-slate-400 font-medium">Sign in to your RCU Hub account to upload and manage materials.</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-4 text-xs sm:text-sm">
            @csrf

            <div>
                <label class="block font-bold text-slate-700 mb-1.5">Email Address</label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 text-purple-400">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com"
                        class="clay-input w-full pl-11 pr-4 py-3 text-sm font-medium">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="font-bold text-slate-700">Password</label>
                    <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-[#6C5CE7] hover:underline">
                        Forgot password?
                    </a>
                </div>
                <div class="relative flex items-center">
                    <div class="absolute left-4 text-purple-400">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="clay-input w-full pl-11 pr-4 py-3 text-sm font-medium">
                </div>
            </div>

            <div class="flex items-center">
                <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-600 font-medium">
                    <input type="checkbox" name="remember" class="rounded text-[#6C5CE7] focus:ring-[#6C5CE7]">
                    <span>Remember me on this browser</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="clay-btn clay-btn-primary w-full py-3.5 text-sm font-bold">
                    Sign In
                </button>
            </div>
        </form>

        <div class="pt-4 border-t border-purple-50 text-center text-xs text-slate-400 font-medium">
            Don't have an account yet? 
            <a href="{{ route('register') }}" class="font-bold text-[#6C5CE7] hover:underline">Create an account</a>
        </div>

    </div>
</div>
@endsection
