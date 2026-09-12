@extends('layouts.app')

@section('title', 'RCU Academic Programs & Courses — RCU Student Resource Hub')
@section('meta_description', 'Explore courses, departments, semesters, and subjects offered at Rani Channamma University.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-8">
    
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Courses & Academic Programs</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Browse study materials organized by faculty, program, and semester.</p>
    </div>

    @foreach($departments as $dept)
        <div class="space-y-4">
            <div class="flex items-center gap-2">
                <div class="w-2.5 h-2.5 rounded-full bg-blue-600"></div>
                <h2 class="font-bold text-slate-900 text-lg">{{ $dept->name }}</h2>
                <span class="text-xs text-slate-400">({{ $dept->code }})</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($dept->programs as $prog)
                    <a href="{{ route('courses.show', $prog->slug) }}" class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs hover:shadow-md hover:border-blue-300 transition-all group flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-bold
                                    {{ $prog->badge_color === 'green' ? 'bg-emerald-50 text-emerald-700' : ($prog->badge_color === 'orange' ? 'bg-amber-50 text-amber-700' : ($prog->badge_color === 'purple' ? 'bg-purple-50 text-purple-700' : 'bg-blue-50 text-blue-700')) }}">
                                    {{ $prog->code }}
                                </span>
                                <span class="text-xs text-slate-400">{{ $prog->total_semesters }} Semesters</span>
                            </div>
                            <h3 class="font-bold text-base text-slate-900 group-hover:text-blue-600 transition-colors">
                                {{ $prog->name }}
                            </h3>
                            <p class="text-xs text-slate-500 mt-1 line-clamp-2">
                                {{ $prog->description ?: "Notes, syllabus, and PYQs for {$prog->name} students." }}
                            </p>
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span>{{ $prog->resources_count }} approved resources</span>
                            <span class="font-semibold text-blue-600 group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                                Browse &rarr;
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach

</div>
@endsection
