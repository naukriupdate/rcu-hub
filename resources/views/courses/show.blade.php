@extends('layouts.app')

@section('title', "{$program->name} ({$program->code}) — Resources & Syllabus")
@section('meta_description', "Explore semester-wise notes, previous year question papers, and syllabus for {$program->name} at Rani Channamma University.")

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    
    <div class="flex items-center justify-between pb-4 border-b border-slate-200">
        <a href="{{ route('courses.index') }}" class="flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>All Courses</span>
        </a>

        <a href="{{ route('resources.index', ['course' => $program->slug]) }}" class="text-xs font-semibold text-blue-600 hover:underline">
            View All {{ $program->code }} Resources &rarr;
        </a>
    </div>

    <!-- Course Banner -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-2xs space-y-2">
        <div class="inline-flex px-3 py-1 rounded-lg text-xs font-bold
            {{ $program->badge_color === 'green' ? 'bg-emerald-50 text-emerald-700' : ($program->badge_color === 'orange' ? 'bg-amber-50 text-amber-700' : ($program->badge_color === 'purple' ? 'bg-purple-50 text-purple-700' : 'bg-blue-50 text-blue-700')) }}">
            {{ $program->code }}
        </div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ $program->name }}</h1>
        <p class="text-xs sm:text-sm text-slate-500 max-w-3xl">
            Department: <span class="font-semibold text-slate-700">{{ $program->department->name }}</span> • 
            Duration: <span class="font-semibold text-slate-700">{{ $program->duration_years }} Years</span> • 
            Total Semesters: <span class="font-semibold text-slate-700">{{ $program->total_semesters }}</span>
        </p>
    </div>

    <!-- Semesters Grid -->
    <div class="space-y-6">
        <h2 class="font-bold text-slate-900 text-lg">Curriculum & Semester Structure</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($program->semesters as $semester)
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <h3 class="font-bold text-slate-900 text-base">Semester {{ $semester->semester_number }}</h3>
                        <a href="{{ route('resources.index', ['course' => $program->slug, 'semester' => $semester->semester_number]) }}" 
                           class="text-xs font-semibold text-blue-600 hover:underline">
                            Browse All
                        </a>
                    </div>

                    <div class="space-y-2">
                        @forelse($semester->subjects as $subject)
                            <a href="{{ route('resources.index', ['course' => $program->slug, 'semester' => $semester->semester_number, 'q' => $subject->name]) }}" 
                               class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 hover:bg-blue-50 hover:text-blue-700 transition-colors group text-xs font-medium text-slate-700">
                                <span class="truncate">{{ $subject->name }}</span>
                                <span class="text-[10px] text-slate-400 group-hover:text-blue-600 shrink-0 ml-2">
                                    {{ $subject->resources_count }} files &rarr;
                                </span>
                            </a>
                        @empty
                            <p class="text-xs text-slate-400 py-3 text-center">No subjects registered yet.</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10 text-slate-400 text-xs">
                    No semester data available for this program.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
