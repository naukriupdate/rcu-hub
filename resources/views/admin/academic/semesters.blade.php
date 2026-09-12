@extends('layouts.admin')

@section('title', 'Manage Semesters')

@section('content')
<div class="space-y-6">
    
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Academic Semesters & Terms</h1>
        <p class="text-xs text-slate-500 mt-0.5">Define semester levels for each degree program to organize subjects and student resources</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Add Semester Form -->
        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-4">
            <h3 class="font-bold text-slate-900 text-sm">Add New Semester</h3>
            <form action="{{ route('admin.semesters.store') }}" method="POST" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Select Degree Program *</label>
                    <select name="program_id" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($programs as $p)
                            <option value="{{ $p->id }}" {{ $selectedProgramId == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->code }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Semester Number *</label>
                    <input type="number" name="semester_number" min="1" max="20" required placeholder="e.g. 7"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-[10px] text-slate-400 mt-1">Numeric level (1 to 20).</p>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Custom Display Name (Optional)</label>
                    <input type="text" name="name" placeholder="e.g. Semester 7 or Final Year Sem 1"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-[10px] text-slate-400 mt-1">Defaults to "Semester [Number]" if left blank.</p>
                </div>

                <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-xs transition-all flex items-center justify-center gap-1.5">
                    <i data-lucide="plus" class="w-4 h-4"></i> Add Semester
                </button>
            </form>
        </div>

        <!-- Semesters List -->
        <div class="lg:col-span-2 space-y-4">
            
            <!-- Program Filter -->
            <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-2xs">
                <form action="{{ route('admin.semesters.index') }}" method="GET" class="flex items-center gap-3 text-xs">
                    <label class="font-semibold text-slate-700 shrink-0">Filter by Program:</label>
                    <select name="program_id" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl">
                        @foreach($programs as $p)
                            <option value="{{ $p->id }}" {{ $selectedProgramId == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->code }})
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <!-- Table of Semesters -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
                <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="font-bold text-slate-900 text-sm">Semesters</h3>
                    <span class="text-xs text-slate-400">{{ $semesters->total() }} Total</span>
                </div>
                
                <div class="divide-y divide-slate-100 text-xs">
                    @forelse($semesters as $sem)
                        <div class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-[11px]">
                                        {{ $sem->semester_number }}
                                    </span>
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $sem->name }}</h4>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600">
                                        {{ $sem->program->code }}
                                    </span>
                                </div>
                                <p class="text-slate-400 mt-1 ml-8">
                                    Course: {{ $sem->program->name }} • Slug: <code class="text-slate-500 font-mono text-[10px]">{{ $sem->slug }}</code>
                                </p>
                            </div>

                            <div class="flex items-center gap-4 shrink-0">
                                <div class="text-right">
                                    <span class="font-semibold text-blue-600">{{ $sem->subjects_count }} subjects</span>
                                    <span class="block text-[11px] text-slate-400">{{ $sem->resources_count }} resources</span>
                                </div>

                                <form action="{{ route('admin.semesters.destroy', $sem->id) }}" method="POST" onsubmit="return confirm('Delete {{ $sem->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Delete Semester">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-slate-400 text-xs">
                            No semesters found for this program. You can add one using the form on the left.
                        </div>
                    @endforelse
                </div>
            </div>

            <div>
                {{ $semesters->links() }}
            </div>

        </div>

    </div>

</div>
@endsection
