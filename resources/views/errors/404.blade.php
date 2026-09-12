@extends('layouts.app')

@section('title', 'Page Not Found (404) — RCU Student Resource Hub')

@section('content')
<div class="max-w-md mx-auto px-4 py-16 text-center space-y-4">
    <div class="w-16 h-16 rounded-3xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto">
        <i data-lucide="file-question" class="w-8 h-8"></i>
    </div>
    <span class="text-xs font-bold text-blue-600 tracking-wider uppercase">Error 404</span>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Resource Not Found</h1>
    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
        The study document, notice, or course URL you requested does not exist or has been relocated by the moderation team.
    </p>
    <div class="pt-4 flex items-center justify-center gap-3">
        <a href="{{ route('home') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-xs transition-all">
            Back to Home
        </a>
        <a href="{{ route('resources.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition-colors">
            Search Resources
        </a>
    </div>
</div>
@endsection
