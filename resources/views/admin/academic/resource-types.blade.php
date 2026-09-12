@extends('layouts.admin')

@section('title', 'Manage Resource Categories')

@section('content')
<div class="space-y-6">
    
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Resource Categories & Types</h1>
        <p class="text-xs text-slate-500 mt-0.5">Control categories available in upload forms, search filters, and home page cards</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Add Category Form -->
        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-4">
            <h3 class="font-bold text-slate-900 text-sm">Create New Category</h3>
            <form action="{{ route('admin.resource-types.store') }}" method="POST" class="space-y-3 text-xs">
                @csrf

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Category Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Lab Manuals"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Subtitle / Tagline</label>
                    <input type="text" name="subtitle" placeholder="e.g. Practical experiment files"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Color Theme *</label>
                    <select name="color_theme" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                        <option value="purple">Purple</option>
                        <option value="orange">Orange</option>
                        <option value="teal">Teal</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Lucide Icon Name</label>
                    <input type="text" name="icon" value="file-text" placeholder="e.g. file-text, book-open, flask"
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-xs transition-all">
                    Save Category
                </button>
            </form>
        </div>

        <!-- Categories List -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
            <div class="divide-y divide-slate-100 text-xs">
                @foreach($resourceTypes as $rt)
                    <div class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold">
                                <i data-lucide="{{ $rt->icon }}" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">{{ $rt->name }}</h4>
                                <p class="text-slate-400 mt-0.5">{{ $rt->subtitle ?: 'No subtitle' }} (Theme: {{ ucfirst($rt->color_theme) }})</p>
                            </div>
                        </div>
                        <span class="font-semibold text-slate-700">{{ $rt->resources_count }} items</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</div>
@endsection
