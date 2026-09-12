@extends('layouts.app')

@section('title', 'Official RCU Notices & Circulars — RCU Student Resource Hub')
@section('meta_description', 'Latest examination timetables, results, revaluation notifications, and university circulars directly from Rani Channamma University.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-5">
    
    <!-- Top Header with Back Arrow on Mobile (Screen 2) -->
    <div class="flex items-center justify-between pb-3 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="p-2 -ml-2 text-slate-500 hover:text-slate-900 rounded-lg lg:hidden">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Notices</h1>
                <p class="text-xs text-slate-500 hidden sm:block">Live circulars synchronized directly from RCU Official Portal</p>
            </div>
        </div>

        <span class="text-xs text-slate-400">
            Source: <a href="https://www.rcu.edu.in/" target="_blank" rel="noopener" class="text-blue-600 font-semibold hover:underline">rcu.edu.in</a>
        </span>
    </div>

    <!-- TAB TOGGLE: [RCU Official] vs [My Uploads] (Screen 2 from Mobile Reference Image) -->
    <div class="flex items-center p-1 bg-slate-200/70 rounded-xl max-w-sm">
        <a href="{{ route('notices.index') }}" class="flex-1 py-2 text-center text-xs font-bold rounded-lg bg-white text-blue-600 shadow-xs transition-all">
            RCU Official
        </a>
        <a href="{{ route('dashboard.my-uploads') }}" class="flex-1 py-2 text-center text-xs font-semibold text-slate-600 hover:text-slate-900 rounded-lg transition-all">
            My Uploads
        </a>
    </div>

    <!-- WORDPRESS REST API CALLOUT CARD (Exact visual from Screen 2) -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-2xl p-4 flex items-center gap-3.5 shadow-2xs">
        <div class="w-11 h-11 rounded-2xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-xs">
            <i data-lucide="globe" class="w-6 h-6"></i>
        </div>
        <div class="min-w-0">
            <h3 class="font-bold text-slate-900 text-xs sm:text-sm">Notice from RCU Official Website</h3>
            <p class="text-[11px] text-blue-600/80 font-medium">Fetched via WordPress REST API</p>
        </div>
    </div>

    <!-- Category Filter Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs">
        <a href="{{ route('notices.index') }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-colors {{ !request('category') || request('category') === 'all' ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
            All Circulars
        </a>
        <a href="{{ route('notices.index', ['category' => 'exams']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-colors {{ request('category') === 'exams' ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
            Exams & Schedules
        </a>
        <a href="{{ route('notices.index', ['category' => 'results']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-colors {{ request('category') === 'results' ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
            Results
        </a>
        <a href="{{ route('notices.index', ['category' => 'others']) }}" class="px-3.5 py-1.5 rounded-full font-semibold transition-colors {{ request('category') === 'others' ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
            General / Others
        </a>
    </div>

    <!-- NOTICE LIST (Screen 2 from Mobile Reference Image) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs divide-y divide-slate-100 overflow-hidden">
        @forelse($notices as $notice)
            <a href="{{ route('notices.show', $notice->slug) }}" class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50 transition-colors group">
                <div class="min-w-0 space-y-1">
                    <div class="flex items-center gap-2">
                        @if($notice->is_new)
                            <span class="px-1.5 py-0.5 rounded bg-rose-500 text-white text-[9px] font-extrabold tracking-wider uppercase shrink-0">
                                NEW
                            </span>
                        @endif
                        <h3 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-blue-600 truncate">
                            {{ $notice->title }}
                        </h3>
                    </div>
                    <p class="text-[11px] text-slate-400">
                        {{ $notice->published_at ? $notice->published_at->format('d M Y') : '12 Sep 2026' }}
                    </p>
                </div>
                <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-600 shrink-0"></i>
            </a>
        @empty
            <div class="p-10 text-center text-slate-400 text-xs">
                No official notices found under this category.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $notices->links() }}
    </div>

</div>
@endsection
