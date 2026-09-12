@extends('layouts.app')

@section('title', 'Sign In — RCU Student Resource Hub')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center mx-auto shadow-xs">
                <i data-lucide="graduation-cap" class="w-7 h-7"></i>
            </div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Welcome Back</h1>
            <p class="text-xs text-slate-500">Sign in to your RCU Hub account to upload and manage materials.</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-4 text-xs sm:text-sm">
            @csrf

            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">Email Address</label>
                <div class="relative flex items-center">
                    <div class="absolute left-3 text-slate-400">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com"
                        class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-900">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="font-semibold text-slate-700">Password</label>
                    <a href="{{ route('password.request') }}" class="text-[11px] font-semibold text-blue-600 hover:underline">
                        Forgot password?
                    </a>
                </div>
                <div class="relative flex items-center">
                    <div class="absolute left-3 text-slate-400">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-900">
                </div>
            </div>

            <div class="flex items-center">
                <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-600">
                    <input type="checkbox" name="remember" class="rounded text-blue-600 focus:ring-blue-500">
                    <span>Remember me on this browser</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-xs transition-all">
                    Sign In
                </button>
            </div>
        </form>

        <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500">
            Don't have an account yet? 
            <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:underline">Create an account</a>
        </div>

    </div>
</div>
@endsection
