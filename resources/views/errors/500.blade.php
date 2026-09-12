@extends('layouts.app')

@section('title', 'System Error (500) — RCU Student Resource Hub')

@section('content')
<div class="max-w-md mx-auto px-4 py-16 text-center space-y-4">
    <div class="w-16 h-16 rounded-3xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto">
        <i data-lucide="server-off" class="w-8 h-8"></i>
    </div>
    <span class="text-xs font-bold text-rose-600 tracking-wider uppercase">Error 500</span>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Temporary System Glitch</h1>
    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
        An unexpected condition occurred while processing this request. Our technical staff has been notified.
    </p>
    <div class="pt-4 flex items-center justify-center gap-3">
        <a href="{{ route('home') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-xs transition-all">
            Return to Homepage
        </a>
    </div>
</div>
@endsection
