@extends('layouts.app')

@section('title', 'Academic Programs & Courses — Ramchandra Chandravanshi University (RCU)')
@section('meta_description', 'Explore courses, departments, semesters, and subjects offered at Ramchandra Chandravanshi University (RCU).')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-8">
    
    <div class="pb-4 border-b border-purple-100">
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Courses & Academic Programs</h1>
        <p class="text-xs sm:text-sm text-slate-400 font-medium mt-1">Browse study materials organized by faculty, program, and semester.</p>
    </div>

    @foreach($departments as $dept)
        <div class="space-y-4">
            <div class="flex items-center gap-2.5">
                <div class="w-3 h-3 rounded-full bg-[#6C5CE7]"></div>
                <h2 class="font-black text-slate-900 text-lg sm:text-xl">{{ $dept->name }}</h2>
                <span class="text-xs font-bold text-slate-400">({{ $dept->code }})</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($dept->programs as $prog)
                    <a href="{{ route('courses.show', $prog->slug) }}" class="clay-card p-6 group flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="clay-chip font-black text-xs
                                    {{ $prog->badge_color === 'green' ? 'bg-emerald-100 text-emerald-800' : ($prog->badge_color === 'orange' ? 'bg-amber-100 text-amber-800' : ($prog->badge_color === 'purple' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800')) }}">
                                    {{ $prog->code }}
                                </span>
                                <span class="text-xs font-bold text-slate-400">{{ $prog->total_semesters }} Semesters</span>
                            </div>
                            <h3 class="font-extrabold text-base sm:text-lg text-slate-900 group-hover:text-[#6C5CE7] transition-colors">
                                {{ $prog->name }}
                            </h3>
                            <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed font-medium">
                                {{ $prog->description ?: "Notes, syllabus, and PYQs for {$prog->name} students." }}
                            </p>
                        </div>

                        <div class="mt-6 pt-3 border-t border-purple-50 flex items-center justify-between text-xs text-slate-400 font-medium">
                            <span>{{ $prog->resources_count }} approved resources</span>
                            <div class="clay-arrow-btn">
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach

</div>
@endsection
