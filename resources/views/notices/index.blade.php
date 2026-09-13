@extends('layouts.app')

@section('title', 'Official RCU Notices & Circulars — RCU Student Resource Hub')
@section('meta_description', 'Latest examination timetables, results, revaluation notifications, and university circulars directly from Rani Channamma University.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    
    <!-- Top Header with Back Arrow on Mobile -->
    <div class="flex items-center justify-between pb-4 border-b border-purple-100">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="p-2 -ml-2 text-slate-500 hover:text-[#6C5CE7] rounded-full lg:hidden">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Notices</h1>
                <p class="text-xs sm:text-sm text-slate-400 font-medium hidden sm:block">Live circulars synchronized directly from RCU Official Portal</p>
            </div>
        </div>

        <span class="text-xs text-slate-400 font-medium">
            Source: <a href="https://www.rcu.edu.in/" target="_blank" rel="noopener" class="text-[#6C5CE7] font-bold hover:underline">rcu.edu.in</a>
        </span>
    </div>

    <!-- TAB TOGGLE: [RCU Official] vs [My Uploads] (Clay Style) -->
    <div class="flex items-center p-1.5 bg-[#EDE9FE]/80 rounded-full max-w-xs border border-white/90 shadow-[0_2px_6px_rgba(108,92,231,0.06)_inset]">
        <a href="{{ route('notices.index') }}" class="flex-1 py-2 text-center text-xs font-bold rounded-full bg-[#6C5CE7] text-white shadow-[0_4px_10px_rgba(108,92,231,0.3)] transition-all">
            RCU Official
        </a>
        <a href="{{ route('dashboard.my-uploads') }}" class="flex-1 py-2 text-center text-xs font-bold text-slate-600 hover:text-[#6C5CE7] rounded-full transition-all">
            My Uploads
        </a>
    </div>

    <!-- REST API CALLOUT CARD (Clay Style) -->
    <div class="clay-card-purple p-4 sm:p-5 flex items-center gap-4">
        <div class="clay-bubble clay-bubble-purple w-12 h-12 shrink-0">
            <i data-lucide="globe" class="w-6 h-6 text-white"></i>
        </div>
        <div class="min-w-0">
            <h3 class="font-extrabold text-slate-900 text-sm sm:text-base">Notice from RCU Official Website</h3>
            <p class="text-xs text-[#6C5CE7] font-semibold">Fetched via Official WordPress REST API</p>
        </div>
    </div>

    <!-- Category Filter Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs font-bold">
        <a href="{{ route('notices.index') }}" class="px-4 py-2 rounded-full transition-all shrink-0 {{ !request('category') || request('category') === 'all' ? 'bg-[#6C5CE7] text-white shadow-md' : 'bg-white border border-purple-100 text-slate-600 hover:text-[#6C5CE7]' }}">
            All Circulars
        </a>
        <a href="{{ route('notices.index', ['category' => 'exams']) }}" class="px-4 py-2 rounded-full transition-all shrink-0 {{ request('category') === 'exams' ? 'bg-[#6C5CE7] text-white shadow-md' : 'bg-white border border-purple-100 text-slate-600 hover:text-[#6C5CE7]' }}">
            Exams & Schedules
        </a>
        <a href="{{ route('notices.index', ['category' => 'results']) }}" class="px-4 py-2 rounded-full transition-all shrink-0 {{ request('category') === 'results' ? 'bg-[#6C5CE7] text-white shadow-md' : 'bg-white border border-purple-100 text-slate-600 hover:text-[#6C5CE7]' }}">
            Results
        </a>
        <a href="{{ route('notices.index', ['category' => 'others']) }}" class="px-4 py-2 rounded-full transition-all shrink-0 {{ request('category') === 'others' ? 'bg-[#6C5CE7] text-white shadow-md' : 'bg-white border border-purple-100 text-slate-600 hover:text-[#6C5CE7]' }}">
            General / Others
        </a>
    </div>

    <!-- NOTICE LIST (Claymorphism Cards) -->
    <div class="space-y-3">
        @forelse($notices as $notice)
            <a href="{{ route('notices.show', $notice->slug) }}" class="clay-card p-4 sm:p-5 flex items-center justify-between gap-4 group">
                <div class="flex items-center gap-3.5 min-w-0">
                    <!-- Category Badge: New, Update, Info -->
                    @if($notice->is_new)
                        <span class="clay-badge-new shrink-0">New</span>
                    @elseif(str_contains(strtolower($notice->title), 'exam') || str_contains(strtolower($notice->title), 'schedule'))
                        <span class="clay-badge-update shrink-0">Update</span>
                    @else
                        <span class="clay-badge-info shrink-0">Info</span>
                    @endif

                    <div class="min-w-0">
                        <h3 class="font-extrabold text-xs sm:text-sm text-slate-900 group-hover:text-[#6C5CE7] truncate transition-colors">
                            {{ $notice->title }}
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">
                            {{ $notice->published_at ? $notice->published_at->format('d M Y') : 'Recent' }}
                        </p>
                    </div>
                </div>

                <div class="clay-arrow-btn shrink-0">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </div>
            </a>
        @empty
            <div class="clay-card p-12 text-center text-slate-400 text-xs sm:text-sm">
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
