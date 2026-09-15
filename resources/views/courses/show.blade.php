@extends('layouts.app')

@section('title', "{$program->name} ({$program->code}) — Ramchandra Chandravanshi University (RCU)")
@section('meta_description', "Explore semester-wise notes, previous year question papers, and syllabus for {$program->name} at Ramchandra Chandravanshi University (RCU).")

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    
    <div class="flex items-center justify-between pb-4 border-b border-purple-100">
        <a href="{{ route('courses.index') }}" class="flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-[#6C5CE7] transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>All Courses</span>
        </a>

        <a href="{{ route('resources.index', ['course' => $program->slug]) }}" class="text-xs sm:text-sm font-bold text-[#6C5CE7] hover:underline flex items-center gap-1">
            <span>View All {{ $program->code }} Resources</span>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
        </a>
    </div>

    <!-- Course Banner (Clay Style) -->
    <div class="clay-card p-6 sm:p-8 space-y-3">
        <div class="inline-flex px-3 py-1 rounded-full text-xs font-black
            {{ $program->badge_color === 'green' ? 'bg-emerald-100 text-emerald-800' : ($program->badge_color === 'orange' ? 'bg-amber-100 text-amber-800' : ($program->badge_color === 'purple' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800')) }}">
            {{ $program->code }}
        </div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ $program->name }}</h1>
        <p class="text-xs sm:text-sm text-slate-500 max-w-3xl font-medium">
            Department: <span class="font-bold text-slate-800">{{ $program->department->name }}</span> • 
            Duration: <span class="font-bold text-slate-800">{{ $program->duration_years }} Years</span> • 
            Total Semesters: <span class="font-bold text-slate-800">{{ $program->total_semesters }}</span>
        </p>
    </div>

    <!-- Semesters Grid (Clay Style) -->
    <div class="space-y-6">
        <h2 class="font-black text-slate-900 text-xl tracking-tight">Curriculum & Semester Structure</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($program->semesters as $semester)
                <div class="clay-card p-6 space-y-4 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-purple-50">
                            <h3 class="font-black text-slate-900 text-base sm:text-lg">Semester {{ $semester->semester_number }}</h3>
                            <a href="{{ route('resources.index', ['course' => $program->slug, 'semester' => $semester->semester_number]) }}" 
                               class="text-xs font-bold text-[#6C5CE7] hover:underline">
                                Browse All
                            </a>
                        </div>

                        <div class="space-y-2 mt-3">
                            @forelse($semester->subjects as $subject)
                                <a href="{{ route('resources.index', ['course' => $program->slug, 'semester' => $semester->semester_number, 'q' => $subject->name]) }}" 
                                   class="flex items-center justify-between p-3 rounded-2xl bg-white/70 hover:bg-white border border-purple-50 hover:border-purple-200 shadow-sm transition-all group text-xs font-bold text-slate-700">
                                    <span class="truncate">{{ $subject->name }}</span>
                                    <span class="text-[10px] text-slate-400 group-hover:text-[#6C5CE7] shrink-0 ml-2">
                                        {{ $subject->resources_count }} files &rarr;
                                    </span>
                                </a>
                            @empty
                                <p class="text-xs text-slate-400 py-3 text-center">No subjects registered yet.</p>
                            @endforelse
                        </div>
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
