@extends('layouts.app')

@section('title', 'Reset Password — RCU Student Resource Hub')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto">
                <i data-lucide="key" class="w-6 h-6"></i>
            </div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Reset Password</h1>
            <p class="text-xs text-slate-500">Enter your email and we'll send you instructions to recover your account.</p>
        </div>

        @if (session('status'))
            <div class="p-3 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl text-xs font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-4 text-xs sm:text-sm">
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

            <div class="pt-2">
                <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-xs transition-all">
                    Send Reset Link
                </button>
            </div>
        </form>

        <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500">
            Remember your credentials? 
            <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:underline">Back to Login</a>
        </div>

    </div>
</div>
@endsection
