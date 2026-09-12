@extends('layouts.app')

@section('title', 'Access Forbidden (403) — RCU Student Resource Hub')

@section('content')
<div class="max-w-md mx-auto px-4 py-16 text-center space-y-4">
    <div class="w-16 h-16 rounded-3xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto">
        <i data-lucide="shield-alert" class="w-8 h-8"></i>
    </div>
    <span class="text-xs font-bold text-amber-600 tracking-wider uppercase">Error 403</span>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Access Restricted</h1>
    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
        You do not have administrative clearance to access this protected area or document.
    </p>
    <div class="pt-4 flex items-center justify-center gap-3">
        <a href="{{ route('home') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-xs transition-all">
            Back to Home
        </a>
    </div>
</div>
@endsection
