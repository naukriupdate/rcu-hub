@extends('layouts.admin')

@section('title', 'Manage Courses / Programs')

@section('content')
<div class="space-y-6">
    
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Degree Programs & Courses</h1>
        <p class="text-xs text-slate-500 mt-0.5">Administer university degrees. New programs automatically generate semester structures.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Add Program Form -->
        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-4">
            <h3 class="font-bold text-slate-900 text-sm">Add New Degree Program</h3>
            <form action="{{ route('admin.programs.store') }}" method="POST" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Parent Faculty *</label>
                    <select name="department_id" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($departments as $d)
                            <option value="{{ $d->id }}">{{ $d->name }} ({{ $d->code }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Program Full Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Master of Science in Physics"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Code *</label>
                        <input type="text" name="code" required placeholder="e.g. M.Sc"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Total Semesters *</label>
                        <input type="number" name="total_semesters" value="6" min="1" max="12" required
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Color Accent for Cards</label>
                    <select name="badge_color" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="blue">Blue (e.g. BCA)</option>
                        <option value="green">Green (e.g. BBA)</option>
                        <option value="orange">Orange (e.g. BA)</option>
                        <option value="purple">Purple (e.g. B.Sc)</option>
                        <option value="teal">Teal</option>
                    </select>
                </div>

                <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-xs transition-all">
                    Create Course & Semesters
                </button>
            </form>
        </div>

        <!-- Programs List -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-900 text-sm">Existing Programs</h3>
                <span class="text-xs text-slate-400">{{ $programs->count() }} Degrees</span>
            </div>
            <div class="divide-y divide-slate-100 text-xs">
                @foreach($programs as $prog)
                    <div class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold
                                    {{ $prog->badge_color === 'green' ? 'bg-emerald-100 text-emerald-800' : ($prog->badge_color === 'orange' ? 'bg-amber-100 text-amber-800' : ($prog->badge_color === 'purple' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800')) }}">
                                    {{ $prog->code }}
                                </span>
                                <h4 class="font-bold text-slate-900 text-sm">{{ $prog->name }}</h4>
                            </div>
                            <p class="text-slate-400 mt-0.5">{{ $prog->department->name }} • {{ $prog->total_semesters }} Semesters</p>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <div class="text-right">
                                <span class="font-bold text-slate-700">{{ $prog->resources_count }}</span>
                                <span class="text-slate-400 block text-[11px]">resources</span>
                            </div>
                            <a href="{{ route('admin.semesters.index', ['program_id' => $prog->id]) }}" 
                               class="px-2.5 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold rounded-lg text-xs flex items-center gap-1" title="Manage Semesters">
                                <i data-lucide="calendar" class="w-3.5 h-3.5"></i> Semesters ({{ $prog->semesters->count() }})
                            </a>
                            @if($prog->resources_count == 0)
                                <form action="{{ route('admin.programs.destroy', $prog->id) }}" method="POST" onsubmit="return confirm('Delete program {{ $prog->name }} and its empty semesters?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg" title="Delete Degree Program">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</div>
@endsection
