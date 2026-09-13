@extends('layouts.app')

@section('title', 'Browse Study Resources — RCU Student Resource Hub')
@section('meta_description', 'Discover notes, previous year question papers, syllabi and study material for all courses at Rani Channamma University.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    
    <!-- Header with Back Arrow on Mobile -->
    <div class="flex items-center justify-between pb-4 border-b border-purple-100">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="p-2 -ml-2 text-slate-500 hover:text-[#6C5CE7] rounded-full lg:hidden">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Resources</h1>
                <p class="text-xs sm:text-sm text-slate-400 font-medium hidden sm:block">Find verified notes, question papers, and study guides.</p>
            </div>
        </div>

        <a href="{{ route('upload.create') }}" class="clay-btn clay-btn-primary px-5 py-2.5 text-xs sm:text-sm font-bold">
            <i data-lucide="upload-cloud" class="w-4 h-4"></i>
            <span>Upload Resource</span>
        </a>
    </div>

    <!-- SEARCH & FILTER CONTROLS (Claymorphism Style) -->
    <div class="space-y-4">
        <form action="{{ route('resources.index') }}" method="GET" class="space-y-3">
            
            <!-- Clay Search Input -->
            <div class="relative flex items-center bg-white/95 rounded-full p-1.5 border border-purple-100 shadow-[0_10px_25px_-5px_rgba(108,92,231,0.1),0_2px_4px_#FFF_inset,0_-3px_6px_rgba(162,155,254,0.12)_inset] focus-within:ring-4 focus-within:ring-purple-200/60 transition-all">
                <div class="pl-4 text-purple-400">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </div>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search resources, subjects, courses, papers..." 
                    class="w-full bg-transparent border-0 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-0 font-medium">
                @if(request('q') || request('course') || request('semester') || request('type'))
                    <a href="{{ route('resources.index') }}" class="pr-3 text-xs font-bold text-purple-400 hover:text-[#6C5CE7]">Clear</a>
                @endif
                <button type="submit" class="clay-btn clay-btn-primary px-5 py-2 text-xs font-bold mr-1">
                    Search
                </button>
            </div>

            <!-- Filter Pill Dropdowns (Clay Buttons Style) -->
            <div class="flex flex-wrap items-center gap-2.5 pt-1">
                <!-- Course dropdown -->
                <select name="course" onchange="this.form.submit()" 
                    class="px-4 py-2 bg-white border border-purple-100 rounded-full text-xs font-bold text-slate-700 shadow-[0_4px_10px_rgba(108,92,231,0.06),0_1px_2px_#FFF_inset] hover:border-purple-300 focus:outline-none focus:ring-2 focus:ring-[#6C5CE7] cursor-pointer">
                    <option value="">Course: All</option>
                    @foreach($courses as $c)
                        <option value="{{ $c->slug }}" {{ request('course') == $c->slug ? 'selected' : '' }}>{{ $c->code }}</option>
                    @endforeach
                </select>

                <!-- Semester dropdown -->
                <select name="semester" onchange="this.form.submit()" 
                    class="px-4 py-2 bg-white border border-purple-100 rounded-full text-xs font-bold text-slate-700 shadow-[0_4px_10px_rgba(108,92,231,0.06),0_1px_2px_#FFF_inset] hover:border-purple-300 focus:outline-none focus:ring-2 focus:ring-[#6C5CE7] cursor-pointer">
                    <option value="">Semester: All</option>
                    @for($s = 1; $s <= 6; $s++)
                        <option value="{{ $s }}" {{ request('semester') == $s ? 'selected' : '' }}>Semester {{ $s }}</option>
                    @endfor
                </select>

                <!-- Type dropdown -->
                <select name="type" onchange="this.form.submit()" 
                    class="px-4 py-2 bg-white border border-purple-100 rounded-full text-xs font-bold text-slate-700 shadow-[0_4px_10px_rgba(108,92,231,0.06),0_1px_2px_#FFF_inset] hover:border-purple-300 focus:outline-none focus:ring-2 focus:ring-[#6C5CE7] cursor-pointer">
                    <option value="">Type: All</option>
                    @foreach($resourceTypes as $t)
                        <option value="{{ $t->slug }}" {{ request('type') == $t->slug ? 'selected' : '' }}>{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>

        </form>
    </div>

    <!-- RESOURCE LIST (Claymorphism Cards) -->
    <div class="space-y-4">
        @forelse($resources as $resource)
            <div class="clay-card p-5 flex items-center justify-between gap-4 group">
                
                <div class="flex items-center gap-4 min-w-0">
                    <!-- Format icon bubble: PDF / Syllabus / Doc -->
                    <div class="w-12 h-12 rounded-2xl shrink-0 flex items-center justify-center text-white shadow-sm
                        {{ $resource->file_type === 'pdf' ? 'clay-bubble-peach' : ($resource->resourceType->slug === 'syllabus' ? 'clay-bubble-mint' : 'clay-bubble-purple') }}">
                        <i data-lucide="{{ $resource->file_type === 'pdf' ? 'file-text' : ($resource->resourceType->slug === 'syllabus' ? 'book-open' : 'file') }}" class="w-6 h-6"></i>
                    </div>

                    <div class="min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <a href="{{ route('resources.show', ['program' => $resource->program->slug, 'semester' => $resource->semester->slug, 'subject' => $resource->subject->slug, 'slug' => $resource->slug]) }}" 
                               class="font-black text-sm sm:text-base text-slate-900 group-hover:text-[#6C5CE7] transition-colors truncate">
                                {{ $resource->title }}
                            </a>
                            @if($resource->isVerifiedTeacherUpload())
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                    🏅 Verified Teacher
                                </span>
                            @endif
                        </div>

                        <p class="text-xs text-slate-500 mt-1 truncate font-medium">
                            {{ $resource->program->code }} • Semester {{ $resource->semester->semester_number }} • {{ $resource->resourceType->name }}
                        </p>
                        
                        <p class="text-[11px] text-slate-400 mt-1 flex items-center gap-2 font-medium">
                            <span>{{ $resource->humanFileSize() }}</span>
                            <span>•</span>
                            <span>{{ $resource->created_at->format('d M Y') }}</span>
                            <span>•</span>
                            <span>{{ number_format($resource->downloads_count) }} downloads</span>
                        </p>
                    </div>
                </div>

                <!-- Download Action Button -->
                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('resources.download', $resource->id) }}" 
                       class="clay-arrow-btn text-[#6C5CE7] hover:bg-[#6C5CE7] hover:text-white" 
                       title="Download Resource">
                        <i data-lucide="download" class="w-4 h-4"></i>
                    </a>
                </div>

            </div>
        @empty
            <div class="clay-card p-12 text-center space-y-4">
                <div class="w-16 h-16 mx-auto rounded-3xl bg-purple-50 text-[#6C5CE7] flex items-center justify-center">
                    <i data-lucide="folder-search" class="w-8 h-8"></i>
                </div>
                <h3 class="font-black text-slate-900 text-lg">No resources found</h3>
                <p class="text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">
                    Try adjusting your search terms or clearing selected filters to find what you are looking for.
                </p>
                <div class="pt-2">
                    <a href="{{ route('resources.index') }}" class="clay-btn clay-btn-secondary px-5 py-2 text-xs font-bold">
                        Reset All Filters
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $resources->links() }}
    </div>

</div>
@endsection
