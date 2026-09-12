@extends('layouts.app')

@section('title', 'Browse Study Resources — RCU Student Resource Hub')
@section('meta_description', 'Discover notes, previous year question papers, syllabi and study material for all courses at Rani Channamma University.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    
    <!-- Header with Back Arrow on Mobile (Matching Screen 3) -->
    <div class="flex items-center justify-between pb-4 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="p-2 -ml-2 text-slate-500 hover:text-slate-900 rounded-lg lg:hidden">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Resources</h1>
                <p class="text-xs text-slate-500 hidden sm:block">Find approved notes, question papers, and study guides.</p>
            </div>
        </div>

        <a href="{{ route('upload.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-xl shadow-xs transition-all">
            <i data-lucide="upload-cloud" class="w-4 h-4"></i>
            <span>Upload Resource</span>
        </a>
    </div>

    <!-- SEARCH & FILTER CONTROLS (Screen 3 from Mobile Image) -->
    <div class="my-6 space-y-4">
        <form action="{{ route('resources.index') }}" method="GET" class="space-y-3">
            
            <!-- Search Input -->
            <div class="relative flex items-center bg-white rounded-2xl border border-slate-200 shadow-2xs">
                <div class="pl-4 text-slate-400">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </div>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search resources, subjects, courses, papers..." 
                    class="w-full bg-transparent border-0 px-3.5 py-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none">
                @if(request('q') || request('course') || request('semester') || request('type'))
                    <a href="{{ route('resources.index') }}" class="pr-3 text-xs text-slate-400 hover:text-slate-700">Clear</a>
                @endif
                <button type="submit" class="mr-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl transition-colors">
                    Search
                </button>
            </div>

            <!-- Filter Pill Dropdowns (Matching [Course v] [Semester v] [Type v] from Screen 3) -->
            <div class="flex flex-wrap items-center gap-2">
                <!-- Course dropdown -->
                <select name="course" onchange="this.form.submit()" 
                    class="px-3 py-1.5 bg-white border border-slate-200 rounded-full text-xs font-semibold text-slate-700 shadow-2xs hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Course: All</option>
                    @foreach($courses as $c)
                        <option value="{{ $c->slug }}" {{ request('course') == $c->slug ? 'selected' : '' }}>{{ $c->code }}</option>
                    @endforeach
                </select>

                <!-- Semester dropdown -->
                <select name="semester" onchange="this.form.submit()" 
                    class="px-3 py-1.5 bg-white border border-slate-200 rounded-full text-xs font-semibold text-slate-700 shadow-2xs hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semester: All</option>
                    @for($s = 1; $s <= 6; $s++)
                        <option value="{{ $s }}" {{ request('semester') == $s ? 'selected' : '' }}>Semester {{ $s }}</option>
                    @endfor
                </select>

                <!-- Type dropdown -->
                <select name="type" onchange="this.form.submit()" 
                    class="px-3 py-1.5 bg-white border border-slate-200 rounded-full text-xs font-semibold text-slate-700 shadow-2xs hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Type: All</option>
                    @foreach($resourceTypes as $t)
                        <option value="{{ $t->slug }}" {{ request('type') == $t->slug ? 'selected' : '' }}>{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>

        </form>
    </div>

    <!-- RESOURCE LIST (Screen 3 from Mobile Reference Image) -->
    <div class="space-y-3">
        @forelse($resources as $resource)
            <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-2xs hover:shadow-md hover:border-blue-200 transition-all flex items-center justify-between gap-4">
                
                <div class="flex items-center gap-3.5 min-w-0">
                    <!-- Dynamic format icon: red for pdf, green for syllabus, blue for pyq/doc -->
                    <div class="w-11 h-11 rounded-2xl shrink-0 flex items-center justify-center text-white shadow-xs
                        {{ $resource->file_type === 'pdf' ? 'bg-rose-500' : ($resource->resourceType->slug === 'syllabus' ? 'bg-emerald-500' : 'bg-blue-600') }}">
                        <i data-lucide="{{ $resource->file_type === 'pdf' ? 'file-text' : ($resource->resourceType->slug === 'syllabus' ? 'book-open' : 'file') }}" class="w-6 h-6"></i>
                    </div>

                    <div class="min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <a href="{{ route('resources.show', ['program' => $resource->program->slug, 'semester' => $resource->semester->slug, 'subject' => $resource->subject->slug, 'slug' => $resource->slug]) }}" 
                               class="font-bold text-sm sm:text-base text-slate-900 hover:text-blue-600 transition-colors truncate">
                                {{ $resource->title }}
                            </a>
                            @if($resource->isVerifiedTeacherUpload())
                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold">
                                    🏅 Verified Teacher
                                </span>
                            @endif
                        </div>

                        <p class="text-xs text-slate-500 mt-0.5 truncate">
                            {{ $resource->program->code }} • Sem {{ $resource->semester->semester_number }} • {{ $resource->resourceType->name }}
                        </p>
                        
                        <p class="text-[11px] text-slate-400 mt-1 flex items-center gap-2">
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
                       class="w-10 h-10 rounded-xl bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 flex items-center justify-center transition-colors" 
                       title="Download Resource">
                        <i data-lucide="download" class="w-5 h-5"></i>
                    </a>
                </div>

            </div>
        @empty
            <div class="bg-white rounded-2xl border border-slate-200/80 p-12 text-center shadow-2xs space-y-3">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center">
                    <i data-lucide="folder-search" class="w-7 h-7"></i>
                </div>
                <h3 class="font-bold text-slate-900 text-base">No resources found</h3>
                <p class="text-xs text-slate-500 max-w-sm mx-auto">
                    Try adjusting your search terms or clearing selected filters to find what you are looking for.
                </p>
                <div class="pt-2">
                    <a href="{{ route('resources.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-xl transition-colors">
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
