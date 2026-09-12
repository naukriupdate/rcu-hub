@extends('layouts.app')

@section('title', 'Session Expired (419) — RCU Student Resource Hub')

@section('content')
<div class="max-w-md mx-auto px-4 py-16 text-center space-y-4">
    <div class="w-16 h-16 rounded-3xl bg-slate-100 text-slate-600 flex items-center justify-center mx-auto">
        <i data-lucide="clock" class="w-8 h-8"></i>
    </div>
    <span class="text-xs font-bold text-slate-500 tracking-wider uppercase">Error 419</span>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Session Expired</h1>
    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
        Your security session timed out due to inactivity. Please refresh the page and submit again.
    </p>
    <div class="pt-4 flex items-center justify-center gap-3">
        <button onclick="window.location.reload()" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-xs transition-all">
            Refresh Page
        </button>
    </div>
</div>
@endsection
