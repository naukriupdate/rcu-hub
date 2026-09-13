@extends('layouts.app')

@section('title', "{$notice->title} — Official RCU Notice")
@section('meta_description', Str::limit(strip_tags($notice->excerpt ?: $notice->content), 160))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    
    <div class="flex items-center justify-between pb-3 border-b border-purple-100">
        <a href="{{ route('notices.index') }}" class="flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-[#6C5CE7] transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>All Notices</span>
        </a>

        <a href="{{ $notice->original_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#6C5CE7] hover:underline">
            <span>View on Official RCU Portal</span>
            <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
        </a>
    </div>

    <!-- Main Notice Card (Clay Style) -->
    <div class="clay-card p-6 sm:p-10 space-y-6">
        
        <!-- Header -->
        <div class="space-y-3">
            <div class="flex items-center gap-2 flex-wrap">
                <span class="clay-chip text-xs font-black">
                    Official RCU Circular
                </span>
                <span class="px-3 py-1 rounded-full bg-purple-50 text-[#6C5CE7] text-xs font-bold">
                    {{ $notice->category }}
                </span>
                <span class="text-xs text-slate-400 font-medium">
                    Published {{ $notice->published_at ? $notice->published_at->format('d M Y, h:i A') : 'Recently' }}
                </span>
            </div>

            <h1 class="text-xl sm:text-2xl lg:text-3xl font-black text-slate-900 tracking-tight leading-snug">
                {{ $notice->title }}
            </h1>
        </div>

        <!-- Official Disclaimer Callout -->
        <div class="p-4 bg-gradient-to-r from-purple-50/80 to-indigo-50/80 rounded-2xl border border-purple-100 flex items-center justify-between gap-3 text-xs text-slate-800">
            <div class="flex items-center gap-2.5 font-medium">
                <i data-lucide="info" class="w-4 h-4 text-[#6C5CE7] shrink-0"></i>
                <span>This notice is synchronized from the official RCU website.</span>
            </div>
            <a href="{{ $notice->original_url }}" target="_blank" rel="noopener" class="shrink-0 font-black text-[#6C5CE7] underline hover:text-[#5641E5]">
                Verify Source
            </a>
        </div>

        <!-- Formatted Notice Content -->
        <div class="prose prose-slate max-w-none text-xs sm:text-sm text-slate-700 leading-relaxed space-y-4">
            {!! $notice->content ?: nl2br(e($notice->excerpt)) !!}
        </div>

        <!-- External Link Trigger -->
        <div class="pt-6 border-t border-purple-50 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-slate-400">
                Last synchronized: {{ $notice->last_synced_at ? $notice->last_synced_at->diffForHumans() : 'Just now' }}
            </p>
            <a href="{{ $notice->original_url }}" target="_blank" rel="noopener" 
               class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-xs transition-all flex items-center gap-2">
                <span>Open Original University Post</span>
                <i data-lucide="external-link" class="w-4 h-4"></i>
            </a>
        </div>

    </div>

    <!-- Recent Circulars -->
    <div class="space-y-3">
        <h3 class="font-bold text-slate-900 text-base">Other Recent Notices</h3>
        <div class="bg-white rounded-2xl border border-slate-200/80 p-2 shadow-2xs divide-y divide-slate-100">
            @foreach($recentNotices as $rn)
                <a href="{{ route('notices.show', $rn->slug) }}" class="p-3 flex items-center justify-between gap-3 hover:bg-slate-50 rounded-xl transition-colors group">
                    <div class="min-w-0">
                        <h4 class="text-xs sm:text-sm font-semibold text-slate-900 group-hover:text-blue-600 truncate">{{ $rn->title }}</h4>
                        <p class="text-[11px] text-slate-400">{{ $rn->published_at ? $rn->published_at->format('d M Y') : '' }}</p>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-600 shrink-0"></i>
                </a>
            @endforeach
        </div>
    </div>

</div>
@endsection
