@extends('layouts.admin')

@section('title', "Review: {$resource->title}")

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between pb-3 border-b border-slate-200">
        <a href="{{ route('admin.resources.index') }}" class="flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Resources
        </a>

        <div class="flex items-center gap-2">
            @if($resource->status !== 'approved')
                <form action="{{ route('admin.resources.approve', $resource->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-xs transition-all flex items-center gap-1.5">
                        <i data-lucide="check" class="w-4 h-4"></i> Approve Resource
                    </button>
                </form>
            @endif

            @if($resource->status !== 'rejected')
                <button type="button" onclick="document.getElementById('reviewRejectBox').classList.toggle('hidden')" class="px-3.5 py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold text-xs rounded-xl transition-colors flex items-center gap-1">
                    <i data-lucide="x" class="w-4 h-4"></i> Reject
                </button>
            @endif

            <form action="{{ route('admin.resources.destroy', $resource->id) }}" method="POST" onsubmit="return confirm('Permanently delete this file?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold text-xs rounded-xl transition-colors">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Reject Box Modal/Inline -->
    <div id="reviewRejectBox" class="hidden bg-white border border-rose-200 rounded-2xl p-4 shadow-sm space-y-3">
        <h4 class="font-bold text-rose-900 text-xs">Reject Resource</h4>
        <form action="{{ route('admin.resources.reject', $resource->id) }}" method="POST" class="space-y-2">
            @csrf
            <textarea name="rejection_reason" rows="2" required placeholder="Specify reason for rejection (feedback sent to student dashboard)..."
                class="w-full px-3 py-2 bg-rose-50/50 border border-rose-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-rose-500"></textarea>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('reviewRejectBox').classList.add('hidden')" class="px-3 py-1 text-xs text-slate-500">Cancel</button>
                <button type="submit" class="px-4 py-1.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl">Confirm Rejection</button>
            </div>
        </form>
    </div>

    <!-- Details Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-2xs space-y-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">{{ $resource->title }}</h1>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold
                        {{ $resource->status === 'approved' ? 'bg-emerald-50 text-emerald-700' : ($resource->status === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-rose-50 text-rose-700') }}">
                        {{ ucfirst($resource->status) }}
                    </span>
                </div>
                <p class="text-xs text-slate-400 mt-1">
                    Uploaded on {{ $resource->created_at->format('d M Y, h:i A') }} • File Size: {{ $resource->humanFileSize() }} ({{ $resource->mime_type }})
                </p>
            </div>
            <a href="{{ route('resources.preview', $resource->id) }}" target="_blank" 
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-xl flex items-center gap-1.5">
                <i data-lucide="eye" class="w-4 h-4"></i> Preview PDF
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 bg-slate-50 rounded-xl border border-slate-100 text-xs">
            <div>
                <span class="text-slate-400 block font-medium">Faculty / Dept</span>
                <span class="font-bold text-slate-800">{{ $resource->department->code }}</span>
            </div>
            <div>
                <span class="text-slate-400 block font-medium">Program</span>
                <span class="font-bold text-slate-800">{{ $resource->program->code }}</span>
            </div>
            <div>
                <span class="text-slate-400 block font-medium">Semester</span>
                <span class="font-bold text-slate-800">Sem {{ $resource->semester->semester_number }}</span>
            </div>
            <div>
                <span class="text-slate-400 block font-medium">Subject</span>
                <span class="font-bold text-slate-800">{{ $resource->subject->name }}</span>
            </div>
        </div>

        <div>
            <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider mb-1">Uploader Details</h3>
            <p class="text-xs text-slate-700">
                Name: <span class="font-semibold">{{ $resource->uploader_name }}</span> (Role: {{ ucfirst($resource->uploader_type) }})
                @if($resource->isVerifiedTeacherUpload())
                    <span class="text-emerald-700 font-bold ml-1">🏅 Verified Teacher</span>
                @endif
            </p>
        </div>

        @if($resource->description)
            <div>
                <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider mb-1">Description / Syllabus Notes</h3>
                <div class="p-3 bg-slate-50 rounded-xl text-xs text-slate-700 leading-relaxed">
                    {{ $resource->description }}
                </div>
            </div>
        @endif

        @if($resource->rejection_reason)
            <div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-800">
                <span class="font-bold">Rejection Reason:</span> {{ $resource->rejection_reason }}
            </div>
        @endif
    </div>

</div>
@endsection
