<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') — RCU Student Resource Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="flex flex-col min-h-full text-slate-800 antialiased pb-16 lg:pb-0">

    <!-- TOP HEADER (Desktop & Mobile Header matching Screen 7 from Reference Image 1) -->
    <header class="sticky top-0 z-40 bg-slate-900 text-white border-b border-slate-800 shadow-md">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Header Branding from Screen 7 -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold shadow-xs">
                        <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h1 class="font-extrabold text-base sm:text-lg text-white tracking-tight leading-tight">RCU Admin Panel</h1>
                        <p class="text-[11px] text-slate-400">Manage resources, users and notices</p>
                    </div>
                </div>

                <!-- Right Header Actions -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-slate-300 hover:text-white bg-slate-800 hover:bg-slate-700 rounded-lg transition-colors">
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        <span>View Public Hub</span>
                    </a>
                    
                    <div class="flex items-center gap-2 pl-2 border-l border-slate-800">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <span class="hidden md:inline text-xs font-semibold text-slate-200">{{ auth()->user()->name }}</span>
                    </div>

                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-400 transition-colors" title="Sign out">
                            <i data-lucide="log-out" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </header>

    <div class="flex-1 flex">

        <!-- DESKTOP SIDEBAR -->
        <aside class="hidden lg:block w-64 shrink-0 bg-white border-r border-slate-200/80 p-4 space-y-6">
            <div class="space-y-1 text-xs">
                
                <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Core</p>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                </a>

                <a href="{{ route('admin.resources.pending') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl font-semibold transition-colors {{ request()->routeIs('admin.resources.pending') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    <span class="flex items-center gap-3">
                        <i data-lucide="inbox" class="w-4 h-4"></i> Pending Reviews
                    </span>
                    @php $pendingCount = \App\Models\Resource::pending()->count(); @endphp
                    @if($pendingCount > 0)
                        <span class="px-2 py-0.5 rounded-full bg-amber-500 text-white text-[10px] font-bold">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.resources.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition-colors {{ request()->routeIs('admin.resources.index') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i data-lucide="files" class="w-4 h-4"></i> All Resources
                </a>

                <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-4 mb-2">Academic Structure</p>

                <a href="{{ route('admin.departments.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.departments.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i data-lucide="building-2" class="w-4 h-4"></i> Departments
                </a>

                <a href="{{ route('admin.programs.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.programs.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i data-lucide="graduation-cap" class="w-4 h-4"></i> Courses / Programs
                </a>

                <a href="{{ route('admin.semesters.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.semesters.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i data-lucide="calendar" class="w-4 h-4"></i> Semesters
                </a>

                <a href="{{ route('admin.subjects.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.subjects.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i data-lucide="book-marked" class="w-4 h-4"></i> Subjects
                </a>

                <a href="{{ route('admin.resource-types.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.resource-types.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i data-lucide="layers" class="w-4 h-4"></i> Resource Categories
                </a>

                <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-4 mb-2">Users & Roles</p>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i data-lucide="users" class="w-4 h-4"></i> User Management
                </a>

                <a href="{{ route('admin.teachers.verification') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.teachers.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i data-lucide="award" class="w-4 h-4 text-emerald-600"></i> Teacher Verification
                </a>

                <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-4 mb-2">Integration & System</p>

                <a href="{{ route('admin.notices.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.notices.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i data-lucide="refresh-cw" class="w-4 h-4 text-blue-600"></i> Official Notices Sync
                </a>

                <a href="{{ route('admin.reports.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.reports.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="flex items-center gap-3">
                        <i data-lucide="flag" class="w-4 h-4"></i> Community Reports
                    </span>
                    @php $reportsCount = \App\Models\Report::where('status', 'pending')->count(); @endphp
                    @if($reportsCount > 0)
                        <span class="px-2 py-0.5 rounded-full bg-rose-500 text-white text-[10px] font-bold">{{ $reportsCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i data-lucide="settings" class="w-4 h-4"></i> Site Settings
                </a>

                <a href="{{ route('admin.audit-logs.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.audit-logs.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i data-lucide="shield-check" class="w-4 h-4"></i> Audit Trails
                </a>

            </div>
        </aside>

        <!-- MAIN ADMIN CONTENT -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0">
            
            <!-- Toast messages -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 shadow-xs">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                    <div class="flex-1 text-xs sm:text-sm font-semibold">{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error') || $errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-3 shadow-xs">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5"></i>
                    <div class="flex-1 text-xs sm:text-sm font-semibold">
                        {{ session('error') ?: $errors->first() }}
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

    </div>

    <!-- MOBILE ADMIN BOTTOM NAVIGATION BAR (Exact visual from Screen 7 of Reference Image 1) -->
    <nav class="lg:hidden fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-md border-t border-slate-200 z-40 py-2 px-3 flex items-center justify-around shadow-lg text-xs">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-semibold' : 'text-slate-500' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.resources.pending') }}" class="flex flex-col items-center gap-1 relative {{ request()->routeIs('admin.resources.*') ? 'text-blue-600 font-semibold' : 'text-slate-500' }}">
            <i data-lucide="files" class="w-5 h-5"></i>
            <span>Resources</span>
            @if($pendingCount > 0)
                <span class="absolute -top-1 -right-1 w-2 h-2 rounded-full bg-amber-500"></span>
            @endif
        </a>
        <a href="{{ route('admin.notices.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('admin.notices.*') ? 'text-blue-600 font-semibold' : 'text-slate-500' }}">
            <i data-lucide="bell" class="w-5 h-5"></i>
            <span>Notices</span>
        </a>
        <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('admin.users.*') ? 'text-blue-600 font-semibold' : 'text-slate-500' }}">
            <i data-lucide="users" class="w-5 h-5"></i>
            <span>Users</span>
        </a>
        <a href="{{ route('admin.settings.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('admin.settings.*') ? 'text-blue-600 font-semibold' : 'text-slate-500' }}">
            <i data-lucide="settings" class="w-5 h-5"></i>
            <span>Settings</span>
        </a>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    </script>
    @stack('scripts')
</body>
</html>
