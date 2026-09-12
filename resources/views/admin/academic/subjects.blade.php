@extends('layouts.admin')

@section('title', 'Manage Academic Subjects')

@section('content')
<div class="space-y-6">
    
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Academic Subjects</h1>
        <p class="text-xs text-slate-500 mt-0.5">Define semester subjects and syllabus modules across all university courses</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Add Subject Form -->
        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-4">
            <h3 class="font-bold text-slate-900 text-sm">Add New Subject</h3>
            <form action="{{ route('admin.subjects.store') }}" method="POST" class="space-y-3 text-xs">
                @csrf

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Select Degree Program *</label>
                    <select id="programSelect" name="program_id" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($programs as $p)
                            <option value="{{ $p->id }}" {{ $selectedProgramId == $p->id ? 'selected' : '' }}>{{ $p->name }} ({{ $p->code }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Select Semester *</label>
                    <select id="semesterSelect" name="semester_id" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($semesters as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Subject Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Artificial Intelligence"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Subject Code</label>
                    <input type="text" name="code" placeholder="e.g. BCA504"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Brief Description</label>
                    <textarea name="description" rows="2" placeholder="Course outline / modules covered..."
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-xs transition-all">
                    Save Subject
                </button>
            </form>
        </div>

        <!-- Subjects List -->
        <div class="lg:col-span-2 space-y-4">
            <!-- Filter Bar -->
            <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-2xs">
                <form action="{{ route('admin.subjects.index') }}" method="GET" class="flex items-center gap-3 text-xs">
                    <label class="font-semibold text-slate-700 shrink-0">Filter by Program:</label>
                    <select name="program_id" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl">
                        @foreach($programs as $p)
                            <option value="{{ $p->id }}" {{ $selectedProgramId == $p->id ? 'selected' : '' }}>{{ $p->name }} ({{ $p->code }})</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
                <div class="divide-y divide-slate-100 text-xs">
                    @forelse($subjects as $sub)
                        <div class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $sub->name }}</h4>
                                    @if($sub->code)
                                        <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[10px] font-mono font-bold">
                                            {{ $sub->code }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-slate-400 mt-0.5">{{ $sub->program->code }} • {{ $sub->semester->name }}</p>
                            </div>
                            <div class="flex items-center gap-3 shrink-0">
                                <span class="text-xs font-semibold text-blue-600">
                                    {{ $sub->resources_count }} files
                                </span>
                                @if($sub->resources_count == 0)
                                    <form action="{{ route('admin.subjects.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Delete subject {{ $sub->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg" title="Delete Subject">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-slate-400 text-xs">No subjects created for this program yet.</div>
                    @endforelse
                </div>
            </div>

            <div>
                {{ $subjects->links() }}
            </div>
        </div>

    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const prog = document.getElementById('programSelect');
    const sem = document.getElementById('semesterSelect');

    prog.addEventListener('change', async () => {
        sem.innerHTML = '<option value="">Loading...</option>';
        try {
            const res = await fetch(`/api/academic/semesters?program_id=${prog.value}`);
            const data = await res.json();
            sem.innerHTML = '';
            data.forEach(s => {
                const opt = document.createElement('option');
                opt.value = s.id;
                opt.textContent = s.name;
                sem.appendChild(opt);
            });
        } catch (e) {
            sem.innerHTML = '<option value="">Error</option>';
        }
    });
});
</script>
@endpush
@endsection
