@extends('layouts.admin')

@section('title', 'Manage Departments')

@section('content')
<div class="space-y-6">
    
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">University Departments & Faculties</h1>
        <p class="text-xs text-slate-500 mt-0.5">Define academic faculties to organize courses, syllabi, and resources</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Add Department Form -->
        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-4">
            <h3 class="font-bold text-slate-900 text-sm">Add New Faculty</h3>
            <form action="{{ route('admin.departments.store') }}" method="POST" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Faculty / Department Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Faculty of Law"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Department Code</label>
                    <input type="text" name="code" placeholder="e.g. LAW"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Description</label>
                    <textarea name="description" rows="2" placeholder="Brief notes..."
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-xs transition-all">
                    Create Department
                </button>
            </form>
        </div>

        <!-- Departments List -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-900 text-sm">Active Faculties</h3>
                <span class="text-xs text-slate-400">{{ $departments->count() }} Total</span>
            </div>
            <div class="divide-y divide-slate-100 text-xs">
                @foreach($departments as $dept)
                    <div class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50">
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="font-bold text-slate-900 text-sm">{{ $dept->name }}</h4>
                                @if($dept->code)
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-bold">
                                        {{ $dept->code }}
                                    </span>
                                @endif
                            </div>
                            <p class="text-slate-400 mt-0.5">{{ $dept->description ?: 'No description' }}</p>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <div class="text-right">
                                <span class="font-semibold text-blue-600">{{ $dept->programs_count }} programs</span>
                                <span class="block text-[11px] text-slate-400">{{ $dept->resources_count }} resources</span>
                            </div>
                            @if($dept->programs_count == 0 && $dept->resources_count == 0)
                                <form action="{{ route('admin.departments.destroy', $dept->id) }}" method="POST" onsubmit="return confirm('Delete department {{ $dept->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg" title="Delete Department">
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
