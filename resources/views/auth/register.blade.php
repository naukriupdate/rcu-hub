@extends('layouts.app')

@section('title', 'Student & Teacher Registration — RCU Student Resource Hub')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center mx-auto shadow-xs">
                <i data-lucide="user-plus" class="w-7 h-7"></i>
            </div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Create Account</h1>
            <p class="text-xs text-slate-500">Fast, free registration for RCU students and teachers.</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-4 text-xs sm:text-sm">
            @csrf

            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">Full Name</label>
                <div class="relative flex items-center">
                    <div class="absolute left-3 text-slate-400">
                        <i data-lucide="user" class="w-4 h-4"></i>
                    </div>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Your Full Name"
                        class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-900">
                </div>
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">Email Address</label>
                <div class="relative flex items-center">
                    <div class="absolute left-3 text-slate-400">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                        class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-900">
                </div>
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">Password</label>
                <div class="relative flex items-center">
                    <div class="absolute left-3 text-slate-400">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </div>
                    <input type="password" name="password" required placeholder="Minimum 8 characters"
                        class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-900">
                </div>
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">Confirm Password</label>
                <div class="relative flex items-center">
                    <div class="absolute left-3 text-slate-400">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                    </div>
                    <input type="password" name="password_confirmation" required placeholder="Re-enter your password"
                        class="w-full pl-9 pr-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-900">
                </div>
            </div>

            <div class="flex items-start gap-2 pt-1">
                <input type="checkbox" name="accept_terms" value="1" required id="accept_terms" class="mt-0.5 rounded text-blue-600 focus:ring-blue-500">
                <label for="accept_terms" class="text-xs text-slate-600 leading-tight">
                    I agree to the <a href="{{ route('terms') }}" target="_blank" class="text-blue-600 underline font-semibold">Terms of Service</a> and acknowledge the <a href="{{ route('disclaimer') }}" target="_blank" class="text-blue-600 underline font-semibold">Academic Disclaimer</a>.
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-xs transition-all">
                    Register Account
                </button>
            </div>
        </form>

        <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:underline">Sign In</a>
        </div>

    </div>
</div>
@endsection
