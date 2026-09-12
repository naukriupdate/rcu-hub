@extends('layouts.app')

@section('title', 'Important University Links — RCU Student Resource Hub')
@section('meta_description', 'Official university portal links, examination section, student login, and official resources for Rani Channamma University.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Important University Links</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Verified direct links to official portals of Rani Channamma University.</p>
    </div>

    @foreach($links as $category => $items)
        <div class="space-y-3">
            <h2 class="text-sm font-bold text-slate-700 uppercase tracking-wider">{{ $category }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                @foreach($items as $item)
                    <a href="{{ $item->url }}" target="_blank" rel="noopener" 
                       class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-2xs hover:border-blue-300 hover:shadow-md transition-all flex items-start justify-between gap-3 group">
                        <div class="space-y-1 min-w-0">
                            <h3 class="font-bold text-sm text-slate-900 group-hover:text-blue-600 transition-colors flex items-center gap-1.5 truncate">
                                {{ $item->title }}
                            </h3>
                            <p class="text-xs text-slate-500 line-clamp-1">
                                {{ $item->description ?: $item->url }}
                            </p>
                        </div>
                        <div class="w-8 h-8 rounded-xl bg-slate-100 group-hover:bg-blue-50 text-slate-400 group-hover:text-blue-600 flex items-center justify-center shrink-0 transition-colors">
                            <i data-lucide="external-link" class="w-4 h-4"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach

</div>
@endsection
