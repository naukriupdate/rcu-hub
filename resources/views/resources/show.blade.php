@extends('layouts.app')

@section('title', "{$resource->title} ({$resource->program->code} Semester {$resource->semester->semester_number}) — RCU Student Resource Hub")
@section('meta_description', Str::limit($resource->description ?: "Download {$resource->title} for {$resource->program->name} semester {$resource->semester->semester_number} at Rani Channamma University.", 160))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    
    <!-- Top Header with Back Arrow & Bookmark (Matching Screen 4) -->
    <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-200">
        <a href="{{ url()->previous() ?: route('resources.index') }}" class="flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Resource Details</span>
        </a>

        <div class="flex items-center gap-2">
            <button type="button" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-slate-100 rounded-xl transition-colors" title="Bookmark resource">
                <i data-lucide="bookmark" class="w-5 h-5"></i>
            </button>
            <button type="button" onclick="document.getElementById('reportModal').classList.remove('hidden')" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-colors" title="Report resource">
                <i data-lucide="flag" class="w-5 h-5"></i>
            </button>
        </div>
    </div>

    @if(Auth::check() && Auth::user()->isAdmin())
        <!-- ADMIN MODERATION ACTION BAR -->
        <div class="p-4 mb-4 rounded-2xl border flex flex-col sm:flex-row sm:items-center justify-between gap-3 {{ $resource->status === 'approved' ? 'bg-emerald-50/80 border-emerald-200 text-emerald-950' : ($resource->status === 'pending' ? 'bg-amber-50/80 border-amber-200 text-amber-950' : 'bg-rose-50/80 border-rose-200 text-rose-950') }}">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center font-bold text-white {{ $resource->status === 'approved' ? 'bg-emerald-600' : ($resource->status === 'pending' ? 'bg-amber-600' : 'bg-rose-600') }}">
                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                </div>
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider block">Administrator Controls</span>
                    <span class="text-xs">Current Status: <strong class="uppercase font-bold">{{ $resource->status }}</strong></span>
                </div>
            </div>

            <div class="flex items-center gap-2 flex-wrap">
                @if($resource->status !== 'approved')
                    <form action="{{ route('admin.resources.approve', $resource->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-xs transition-all flex items-center gap-1.5">
                            <i data-lucide="check" class="w-4 h-4"></i> Approve Resource
                        </button>
                    </form>
                @endif

                @if($resource->status !== 'rejected')
                    <button type="button" onclick="document.getElementById('adminRejectBox').classList.toggle('hidden')" class="px-3.5 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 font-bold text-xs rounded-xl transition-all flex items-center gap-1.5">
                        <i data-lucide="x" class="w-4 h-4"></i> Reject
                    </button>
                @endif

                <a href="{{ route('admin.resources.review', $resource->id) }}" class="px-3 py-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-xs rounded-xl flex items-center gap-1">
                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i> Admin Review
                </a>
            </div>
        </div>

        <!-- Inline Reject Reason Form -->
        <div id="adminRejectBox" class="hidden mb-4 p-4 bg-white border border-rose-200 rounded-2xl shadow-sm space-y-3">
            <h4 class="font-bold text-rose-900 text-xs">Reject Resource (Feedback will be visible to uploader)</h4>
            <form action="{{ route('admin.resources.reject', $resource->id) }}" method="POST" class="space-y-2">
                @csrf
                <textarea name="rejection_reason" rows="2" required placeholder="Please provide specific feedback (e.g. illegible scan, incorrect subject)..."
                    class="w-full px-3 py-2 bg-rose-50/50 border border-rose-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-rose-500"></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('adminRejectBox').classList.add('hidden')" class="px-3 py-1 text-xs text-slate-500">Cancel</button>
                    <button type="submit" class="px-4 py-1.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl">Confirm Rejection</button>
                </div>
            </form>
        </div>
    @endif

    <!-- MAIN RESOURCE DETAILS CARD (Screen 4 from Reference Image 1) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-2xs space-y-6">
        
        <!-- Header Info -->
        <div class="flex items-start gap-4">
            <!-- Red PDF icon -->
            <div class="w-14 h-14 rounded-2xl bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                <i data-lucide="file-text" class="w-7 h-7"></i>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
                        {{ $resource->title }}
                    </h1>
                    @if($resource->isVerifiedTeacherUpload())
                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold">
                            🏅 Verified Teacher
                        </span>
                    @endif
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    {{ $resource->program->code }} • Semester {{ $resource->semester->semester_number }} • {{ $resource->resourceType->name }}
                </p>
                <p class="text-xs text-slate-400 mt-0.5">
                    {{ $resource->created_at->format('d M Y') }} • {{ $resource->humanFileSize() }} • {{ number_format($resource->downloads_count) }} downloads
                </p>
            </div>
        </div>

        <!-- Description Paragraph -->
        @if($resource->description)
            <div class="text-xs sm:text-sm text-slate-600 leading-relaxed bg-slate-50/80 p-4 rounded-xl border border-slate-100">
                {{ $resource->description }}
            </div>
        @endif

        <!-- Metadata Key-Value Table (Exact layout from Screen 4) -->
        <div class="border-t border-b border-slate-100 py-3 text-xs sm:text-sm">
            <dl class="divide-y divide-slate-100">
                <div class="py-2.5 grid grid-cols-3 gap-4">
                    <dt class="font-medium text-slate-400">Course</dt>
                    <dd class="col-span-2 font-semibold text-slate-900">: {{ $resource->program->name }} ({{ $resource->program->code }})</dd>
                </div>
                <div class="py-2.5 grid grid-cols-3 gap-4">
                    <dt class="font-medium text-slate-400">Semester</dt>
                    <dd class="col-span-2 font-semibold text-slate-900">: {{ $resource->semester->semester_number }}</dd>
                </div>
                <div class="py-2.5 grid grid-cols-3 gap-4">
                    <dt class="font-medium text-slate-400">Subject</dt>
                    <dd class="col-span-2 font-semibold text-slate-900">: {{ $resource->subject->name }} ({{ $resource->subject->code ?: 'N/A' }})</dd>
                </div>
                <div class="py-2.5 grid grid-cols-3 gap-4">
                    <dt class="font-medium text-slate-400">Type</dt>
                    <dd class="col-span-2 font-semibold text-slate-900">: {{ $resource->resourceType->name }}</dd>
                </div>
                @if($resource->academic_year)
                    <div class="py-2.5 grid grid-cols-3 gap-4">
                        <dt class="font-medium text-slate-400">Academic Year</dt>
                        <dd class="col-span-2 font-semibold text-slate-900">: {{ $resource->academic_year }}</dd>
                    </div>
                @endif
                <div class="py-2.5 grid grid-cols-3 gap-4">
                    <dt class="font-medium text-slate-400">Uploaded by</dt>
                    <dd class="col-span-2 font-semibold text-slate-900 flex items-center gap-1.5">
                        : {{ $resource->uploader_name }} 
                        <span class="text-xs font-normal text-slate-500">({{ ucfirst($resource->uploader_type) }})</span>
                        @if($resource->isVerifiedTeacherUpload())
                            <span class="text-emerald-700 font-bold text-xs">🏅 Verified</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

        <!-- Action Buttons from Screen 4: [View PDF] & [Download] -->
        <div class="space-y-3 pt-2">
            <a href="{{ route('resources.preview', $resource->id) }}" target="_blank" 
               class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-xs shadow-blue-500/20 transition-all flex items-center justify-center gap-2">
                <i data-lucide="eye" class="w-4 h-4"></i>
                <span>View PDF</span>
            </a>
            
            <a href="{{ route('resources.download', $resource->id) }}" 
               class="w-full py-3 px-4 bg-white hover:bg-slate-50 border border-blue-600 text-blue-600 font-bold text-sm rounded-xl transition-all flex items-center justify-center gap-2">
                <i data-lucide="download" class="w-4 h-4"></i>
                <span>Download</span>
            </a>
        </div>

    </div>

    <!-- RELATED RESOURCES (Screen 4 from Reference Image 1) -->
    <div class="mt-8 space-y-3">
        <h2 class="font-bold text-slate-900 text-base">Related Resources</h2>
        <div class="bg-white rounded-2xl border border-slate-200/80 p-2 shadow-2xs divide-y divide-slate-100">
            @forelse($relatedResources as $rel)
                <a href="{{ route('resources.show', ['program' => $rel->program->slug, 'semester' => $rel->semester->slug, 'subject' => $rel->subject->slug, 'slug' => $rel->slug]) }}" 
                   class="p-3 flex items-center justify-between gap-3 hover:bg-slate-50 rounded-xl transition-colors group">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0">
                            <i data-lucide="file-text" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="text-sm font-semibold text-slate-900 group-hover:text-blue-600 truncate">{{ $rel->title }}</h4>
                            <p class="text-[11px] text-slate-400 truncate">{{ $rel->program->code }} • Sem {{ $rel->semester->semester_number }} • {{ $rel->resourceType->name }}</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-600 shrink-0"></i>
                </a>
            @empty
                <div class="p-6 text-center text-xs text-slate-400">
                    No other resources found for this subject yet.
                </div>
            @endforelse
        </div>
    </div>

</div>

<!-- REPORT RESOURCE MODAL -->
<div id="reportModal" class="fixed inset-0 bg-slate-900/60 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="font-bold text-slate-900 text-base flex items-center gap-2">
                <i data-lucide="flag" class="w-4 h-4 text-rose-600"></i> Report Resource
            </h3>
            <button type="button" onclick="document.getElementById('reportModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="{{ route('resources.report', $resource->id) }}" method="POST" class="space-y-3 text-xs">
            @csrf
            <div>
                <label class="font-semibold text-slate-700 block mb-1">Reason for Report *</label>
                <select name="reason" required class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs">
                    <option value="wrong_content">Wrong content / Incorrect syllabus</option>
                    <option value="duplicate">Duplicate document</option>
                    <option value="copyright">Copyright concern</option>
                    <option value="broken_file">Damaged or corrupted file</option>
                    <option value="offensive">Offensive or abusive content</option>
                    <option value="other">Other issue</option>
                </select>
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Your Name *</label>
                <input type="text" name="reporter_name" value="{{ auth()->user()?->name }}" required class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Your Email *</label>
                <input type="email" name="reporter_email" value="{{ auth()->user()?->email }}" required class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Details / Explanation *</label>
                <textarea name="details" rows="3" required placeholder="Please describe why this resource should be reviewed..." class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="pt-2 flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('reportModal').classList.add('hidden')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-semibold rounded-xl transition-colors">
                    Submit Report
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Structured Data (JSON-LD Schema) for SEO -->
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'DigitalDocument',
    'name' => $resource->title,
    'description' => $resource->description,
    'fileFormat' => $resource->mime_type,
    'encodingFormat' => $resource->file_type,
    'datePublished' => $resource->created_at->toIso8601String(),
    'author' => [
        '@type' => 'Person',
        'name' => $resource->uploader_name,
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection
