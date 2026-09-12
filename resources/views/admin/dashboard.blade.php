@extends('layouts.admin')

@section('title', 'Administrative Overview')

@section('content')
<div class="space-y-6">
    
    <!-- 2x2 METRIC KPI CARDS (Pixel-perfect match of Screen 7 from Mobile Reference Image 1) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Total Resources (Blue) -->
        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-3">
            <div class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <i data-lucide="book-open" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500">Total Resources</p>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight mt-0.5">
                    {{ number_format($totalResources) }}
                </h3>
            </div>
        </div>

        <!-- Pending Uploads (Green) -->
        <a href="{{ route('admin.resources.pending') }}" class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-3 hover:border-emerald-300 transition-colors group block">
            <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                <i data-lucide="inbox" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500">Pending Uploads</p>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight mt-0.5">
                    {{ number_format($pendingUploads) }}
                </h3>
            </div>
        </a>

        <!-- Total Downloads (Purple) -->
        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-3">
            <div class="w-11 h-11 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center">
                <i data-lucide="download" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500">Total Downloads</p>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight mt-0.5">
                    {{ number_format($totalDownloads) }}
                </h3>
            </div>
        </div>

        <!-- Total Users (Orange) -->
        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-3 hover:border-amber-300 transition-colors group block">
            <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500">Total Users</p>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight mt-0.5">
                    {{ number_format($totalUsers) }}
                </h3>
            </div>
        </a>

    </div>

    <!-- PENDING REVIEW BANNER IF PENDING ITEMS EXIST -->
    @if($pendingUploads > 0)
        <div class="p-4 rounded-2xl bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-2xs">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 text-sm">Action Needed: {{ $pendingUploads }} Pending Submissions</h4>
                    <p class="text-xs text-slate-600">Students and teachers have submitted new study materials awaiting your approval.</p>
                </div>
            </div>
            <a href="{{ route('admin.resources.pending') }}" class="shrink-0 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold rounded-xl shadow-xs transition-all">
                Moderate Submissions &rarr;
            </a>
        </div>
    @endif

    <!-- TWO COLUMN MID SECTION (Recent Uploads + Recent Registrations) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- RECENT UPLOADS (Screen 7 from Mobile Reference Image) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="font-bold text-slate-900 text-base">Recent Uploads</h3>
                <a href="{{ route('admin.resources.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">
                    View All &rarr;
                </a>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($recentUploads as $upload)
                    <div class="py-3 flex items-center justify-between gap-3 group">
                        <div class="flex items-center gap-3 min-w-0">
                            <!-- Red PDF File icon from Screen 7 -->
                            <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-2xs">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <h4 class="text-sm font-bold text-slate-900 truncate">
                                        {{ $upload->title }}
                                    </h4>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold 
                                        {{ $upload->status === 'approved' ? 'bg-emerald-50 text-emerald-700' : ($upload->status === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-rose-50 text-rose-700') }}">
                                        {{ ucfirst($upload->status) }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5 truncate">
                                    {{ $upload->program->code }} • Sem {{ $upload->semester->semester_number }} • By {{ $upload->uploader_name }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 shrink-0">
                            <span class="text-xs text-slate-400">
                                {{ $upload->created_at->diffForHumans() }}
                            </span>
                            <a href="{{ route('admin.resources.review', $upload->id) }}" 
                               class="px-3 py-1.5 bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-blue-600 text-xs font-semibold rounded-xl transition-colors">
                                Review
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-slate-400 text-xs">
                        No recent uploads found.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- RECENT USERS & QUICK SHORTCUTS -->
        <div class="space-y-6">
            
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-3">
                <h3 class="font-bold text-slate-900 text-sm">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-2 text-xs font-semibold">
                    <a href="{{ route('admin.departments.index') }}" class="p-3 bg-slate-50 hover:bg-blue-50 hover:text-blue-700 rounded-xl text-slate-700 transition-colors text-center border border-slate-100">
                        + New Course
                    </a>
                    <a href="{{ route('admin.subjects.index') }}" class="p-3 bg-slate-50 hover:bg-blue-50 hover:text-blue-700 rounded-xl text-slate-700 transition-colors text-center border border-slate-100">
                        + New Subject
                    </a>
                    <a href="{{ route('admin.teachers.verification') }}" class="p-3 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 rounded-xl transition-colors text-center border border-emerald-100">
                        Verify Teachers
                    </a>
                    <form action="{{ route('admin.notices.sync') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="w-full h-full p-3 bg-blue-50 hover:bg-blue-100 text-blue-800 rounded-xl transition-colors text-center border border-blue-100">
                            Sync Notices
                        </button>
                    </form>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <h3 class="font-bold text-slate-900 text-sm">New Registrations</h3>
                    <a href="{{ route('admin.users.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">Manage</a>
                </div>
                <div class="divide-y divide-slate-100 text-xs">
                    @foreach($recentUsers as $ru)
                        <div class="py-2.5 flex items-center justify-between">
                            <div>
                                <p class="font-bold text-slate-800">{{ $ru->name }}</p>
                                <p class="text-slate-400 text-[11px]">{{ $ru->email }}</p>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $ru->role === 'teacher' ? 'bg-purple-100 text-purple-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($ru->role) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
