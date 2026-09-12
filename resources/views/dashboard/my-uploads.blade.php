@extends('layouts.app')

@section('title', 'My Uploaded Resources — RCU Student Resource Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    
    <div class="flex items-center justify-between pb-4 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="p-2 -ml-2 text-slate-500 hover:text-slate-900 rounded-lg">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">My Uploads</h1>
                <p class="text-xs text-slate-500">Track moderation progress of your submitted study materials</p>
            </div>
        </div>

        <a href="{{ route('upload.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-xl shadow-xs transition-all">
            <i data-lucide="upload-cloud" class="w-4 h-4"></i>
            <span>Upload New</span>
        </a>
    </div>

    <!-- Uploads List -->
    <div class="space-y-3">
        @forelse($resources as $resource)
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-3">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-start gap-3.5 min-w-0">
                        <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-bold text-sm sm:text-base text-slate-900 truncate">
                                {{ $resource->title }}
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5 truncate">
                                {{ $resource->program->code }} • Sem {{ $resource->semester->semester_number }} • {{ $resource->subject->name }} • {{ $resource->resourceType->name }}
                            </p>
                            <p class="text-[11px] text-slate-400 mt-1">
                                Uploaded on {{ $resource->created_at->format('d M Y, h:i A') }} • {{ $resource->humanFileSize() }}
                            </p>
                        </div>
                    </div>

                    <!-- Status Pill -->
                    <div class="shrink-0">
                        @if($resource->status === 'approved')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Approved
                            </span>
                        @elseif($resource->status === 'pending')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-xs font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending Review
                            </span>
                        @elseif($resource->status === 'rejected')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-xs font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Rejected
                            </span>
                        @endif
                    </div>
                </div>

                <!-- If Rejected: Show Admin Rejection Reason -->
                @if($resource->status === 'rejected' && $resource->rejection_reason)
                    <div class="p-3 bg-rose-50 rounded-xl border border-rose-200 text-xs text-rose-800">
                        <span class="font-bold">Moderator Feedback:</span> {{ $resource->rejection_reason }}
                    </div>
                @endif

                <!-- Action links if approved -->
                @if($resource->status === 'approved')
                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500 font-medium">
                            <i data-lucide="download" class="w-3.5 h-3.5 inline text-slate-400"></i> {{ $resource->downloads_count }} downloads
                        </span>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('resources.show', ['program' => $resource->program->slug, 'semester' => $resource->semester->slug, 'subject' => $resource->subject->slug, 'slug' => $resource->slug]) }}" 
                               class="text-blue-600 font-semibold hover:underline">
                                View Public Page &rarr;
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-slate-200/80 p-12 text-center shadow-2xs space-y-3">
                <div class="w-12 h-12 mx-auto rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <i data-lucide="upload-cloud" class="w-6 h-6"></i>
                </div>
                <h3 class="font-bold text-slate-900 text-base">No resources uploaded yet</h3>
                <p class="text-xs text-slate-500 max-w-sm mx-auto">
                    Help your fellow students by uploading past year papers, handwritten notes, or syllabi.
                </p>
                <div class="pt-2">
                    <a href="{{ route('upload.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-xl transition-all">
                        Upload Your First Resource
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $resources->links() }}
    </div>

</div>
@endsection
