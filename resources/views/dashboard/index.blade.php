@extends('layouts.app')

@section('title', 'My Account — RCU Student Resource Hub')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 py-6 space-y-5">
    
    <!-- Header with Back Arrow (Screen 6 from Mobile Reference Image) -->
    <div class="flex items-center gap-3 pb-3 border-b border-slate-200">
        <a href="{{ route('home') }}" class="p-2 -ml-2 text-slate-500 hover:text-slate-900 rounded-lg">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">My Account</h1>
    </div>

    @if($user->isAdmin())
        <div class="p-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-2xl shadow-sm flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center font-bold">
                    <i data-lucide="shield" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm">Administrative Account</h3>
                    <p class="text-xs text-blue-100">Review pending documents, manage faculties, semesters, and teachers.</p>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-white text-blue-700 hover:bg-blue-50 font-bold text-xs rounded-xl shadow-xs shrink-0 transition-colors">
                Go to Admin Panel
            </a>
        </div>
    @endif

    <!-- User Profile Card from Screen 6 -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs flex items-center gap-4">
        <div class="w-16 h-16 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl shrink-0">
            {{ strtoupper(substr($user->name, 0, 2)) }}
        </div>
        <div class="min-w-0 flex-1">
            <div class="flex items-center gap-2 flex-wrap">
                <h2 class="text-base sm:text-lg font-bold text-slate-900 truncate">{{ $user->name }}</h2>
                <span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200 text-[11px] font-semibold">
                    {{ $user->isVerifiedTeacher() ? '🏅 Verified Teacher' : ($user->isAdmin() ? 'Admin' : ($user->isTeacher() ? 'Teacher' : 'Member')) }}
                </span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5 truncate">{{ $user->email }}</p>
            <p class="text-[10px] text-slate-400 mt-1">Joined {{ $user->created_at->format('M Y') }}</p>
        </div>
    </div>

    <!-- Metrics overview -->
    <div class="grid grid-cols-3 gap-3">
        <div class="bg-white rounded-xl border border-slate-200/80 p-3 text-center shadow-2xs">
            <span class="block text-lg font-extrabold text-slate-900">{{ $totalUploads }}</span>
            <span class="text-[10px] text-slate-400 uppercase font-medium">Uploads</span>
        </div>
        <div class="bg-white rounded-xl border border-slate-200/80 p-3 text-center shadow-2xs">
            <span class="block text-lg font-extrabold text-emerald-600">{{ $approvedUploads }}</span>
            <span class="text-[10px] text-slate-400 uppercase font-medium">Approved</span>
        </div>
        <div class="bg-white rounded-xl border border-slate-200/80 p-3 text-center shadow-2xs">
            <span class="block text-lg font-extrabold text-amber-500">{{ $pendingUploads }}</span>
            <span class="text-[10px] text-slate-400 uppercase font-medium">Pending</span>
        </div>
    </div>

    <!-- ACTION LIST (Pixel-perfect match of Screen 6 from Mobile Reference Image) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs divide-y divide-slate-100 overflow-hidden text-xs sm:text-sm">
        
        <!-- My Uploads -->
        <a href="{{ route('dashboard.my-uploads') }}" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors group">
            <div class="flex items-center gap-3 text-slate-700 group-hover:text-blue-600 font-medium">
                <i data-lucide="folder" class="w-5 h-5 text-slate-400 group-hover:text-blue-600"></i>
                <span>My Uploads</span>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-600"></i>
        </a>

        <!-- Bookmarks -->
        <a href="{{ route('resources.index') }}" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors group">
            <div class="flex items-center gap-3 text-slate-700 group-hover:text-blue-600 font-medium">
                <i data-lucide="bookmark" class="w-5 h-5 text-slate-400 group-hover:text-blue-600"></i>
                <span>Bookmarks</span>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-600"></i>
        </a>

        <!-- Download History -->
        <a href="{{ route('resources.index') }}" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors group">
            <div class="flex items-center gap-3 text-slate-700 group-hover:text-blue-600 font-medium">
                <i data-lucide="download" class="w-5 h-5 text-slate-400 group-hover:text-blue-600"></i>
                <span>Download History</span>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-600"></i>
        </a>

        <!-- Profile Settings -->
        <a href="{{ route('dashboard.profile') }}" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors group">
            <div class="flex items-center gap-3 text-slate-700 group-hover:text-blue-600 font-medium">
                <i data-lucide="settings" class="w-5 h-5 text-slate-400 group-hover:text-blue-600"></i>
                <span>Profile Settings</span>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-600"></i>
        </a>

        <!-- Change Password -->
        <a href="{{ route('dashboard.profile') }}" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors group">
            <div class="flex items-center gap-3 text-slate-700 group-hover:text-blue-600 font-medium">
                <i data-lucide="lock" class="w-5 h-5 text-slate-400 group-hover:text-blue-600"></i>
                <span>Change Password</span>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-600"></i>
        </a>

        <!-- Notifications -->
        <a href="{{ route('notices.index') }}" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors group">
            <div class="flex items-center gap-3 text-slate-700 group-hover:text-blue-600 font-medium">
                <i data-lucide="bell" class="w-5 h-5 text-slate-400 group-hover:text-blue-600"></i>
                <span>Notifications</span>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-600"></i>
        </a>

        <!-- Help & Support -->
        <a href="{{ route('contact') }}" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors group">
            <div class="flex items-center gap-3 text-slate-700 group-hover:text-blue-600 font-medium">
                <i data-lucide="help-circle" class="w-5 h-5 text-slate-400 group-hover:text-blue-600"></i>
                <span>Help & Support</span>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-600"></i>
        </a>

        <!-- About -->
        <a href="{{ route('about') }}" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors group">
            <div class="flex items-center gap-3 text-slate-700 group-hover:text-blue-600 font-medium">
                <i data-lucide="info" class="w-5 h-5 text-slate-400 group-hover:text-blue-600"></i>
                <span>About</span>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-600"></i>
        </a>

        <!-- Logout (Red style from Screen 6) -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full p-4 flex items-center gap-3 text-rose-600 hover:bg-rose-50 font-semibold transition-colors text-left">
                <i data-lucide="log-out" class="w-5 h-5 text-rose-500"></i>
                <span>Logout</span>
            </button>
        </form>

    </div>

</div>
@endsection
