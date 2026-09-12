@extends('layouts.admin')

@section('title', 'Pending Moderation Queue')

@section('content')
<div class="space-y-6">
    
    <div class="flex items-center justify-between pb-4 border-b border-slate-200">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Pending Review Queue</h1>
            <p class="text-xs text-slate-500 mt-0.5">Evaluate and approve community study materials before public distribution</p>
        </div>
        <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-800 border border-amber-200 text-xs font-bold">
            {{ $resources->total() }} Submissions Pending
        </span>
    </div>

    <!-- Submissions Table / Cards -->
    <div class="space-y-4">
        @forelse($resources as $resource)
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-4">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    
                    <div class="flex items-start gap-3.5 min-w-0">
                        <div class="w-12 h-12 rounded-2xl bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                            <i data-lucide="file-text" class="w-6 h-6"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="font-bold text-base text-slate-900 truncate">{{ $resource->title }}</h3>
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px] font-semibold uppercase">
                                    {{ $resource->file_type }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">
                                Course: <span class="font-semibold text-slate-700">{{ $resource->program->name }} ({{ $resource->program->code }})</span> • 
                                Sem: <span class="font-semibold text-slate-700">{{ $resource->semester->semester_number }}</span> • 
                                Subject: <span class="font-semibold text-slate-700">{{ $resource->subject->name }}</span>
                            </p>
                            <p class="text-xs text-slate-400 mt-0.5">
                                Submitted by: <span class="font-semibold text-slate-700">{{ $resource->uploader_name }}</span> ({{ ucfirst($resource->uploader_type) }}) • 
                                Size: {{ $resource->humanFileSize() }} • 
                                Date: {{ $resource->created_at->format('d M Y, h:i A') }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2 shrink-0 pt-2 lg:pt-0">
                        <a href="{{ route('resources.preview', $resource->id) }}" target="_blank" 
                           class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition-colors flex items-center gap-1.5">
                            <i data-lucide="eye" class="w-4 h-4"></i> Preview
                        </a>

                        <!-- Approve Form -->
                        <form action="{{ route('admin.resources.approve', $resource->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-xl shadow-xs transition-all flex items-center gap-1.5">
                                <i data-lucide="check" class="w-4 h-4"></i> Approve
                            </button>
                        </form>

                        <!-- Reject Trigger Button -->
                        <button type="button" onclick="openRejectModal({{ $resource->id }}, '{{ addslashes($resource->title) }}')"
                            class="px-3.5 py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 font-semibold text-xs rounded-xl transition-colors flex items-center gap-1.5">
                            <i data-lucide="x" class="w-4 h-4"></i> Reject
                        </button>
                    </div>

                </div>

                @if($resource->description)
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-xs text-slate-600">
                        <span class="font-bold text-slate-700">Description:</span> {{ $resource->description }}
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-slate-200/80 p-12 text-center shadow-2xs space-y-3">
                <div class="w-12 h-12 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i data-lucide="check-check" class="w-6 h-6"></i>
                </div>
                <h3 class="font-bold text-slate-900 text-base">Moderation Queue Clear</h3>
                <p class="text-xs text-slate-500">All submitted resources have been reviewed. Good job!</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $resources->links() }}
    </div>

</div>

<!-- REJECT REASON MODAL -->
<div id="rejectModal" class="fixed inset-0 bg-slate-900/60 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="font-bold text-slate-900 text-base">Reject Resource</h3>
            <button type="button" onclick="closeRejectModal()" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="rejectForm" method="POST" class="space-y-4 text-xs sm:text-sm">
            @csrf
            <div>
                <p class="text-xs text-slate-600 mb-2">
                    Rejecting: <span id="rejectTitle" class="font-bold text-slate-900"></span>
                </p>
                <label class="block font-semibold text-slate-700 mb-1.5">Rejection Reason *</label>
                <textarea name="rejection_reason" rows="3" required placeholder="State reason (e.g., poor scan quality, incomplete units, wrong syllabus...)"
                    class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-rose-500 text-xs"></textarea>
                <p class="text-[11px] text-slate-400 mt-1">This message will be shown to the uploader in their dashboard.</p>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-xs">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-semibold rounded-xl text-xs">
                    Confirm Rejection
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openRejectModal(id, title) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    const titleEl = document.getElementById('rejectTitle');
    
    form.action = `/admin/resources/${id}/reject`;
    titleEl.textContent = title;
    modal.classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}
</script>
@endpush
@endsection
