@extends('layouts.app')

@section('title', 'Profile Settings — RCU Student Resource Hub')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 py-6 space-y-6">
    
    <div class="flex items-center gap-3 pb-3 border-b border-slate-200">
        <a href="{{ route('dashboard') }}" class="p-2 -ml-2 text-slate-500 hover:text-slate-900 rounded-lg">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Profile Settings</h1>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-2xs">
        <form action="{{ route('dashboard.profile.update') }}" method="POST" class="space-y-4 text-xs sm:text-sm">
            @csrf

            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-900">
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">Email Address</label>
                <input type="email" value="{{ $user->email }}" disabled
                    class="w-full px-3.5 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed">
                <p class="text-[11px] text-slate-400 mt-1">Contact administrator to modify registered email.</p>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <h3 class="font-bold text-slate-900 text-sm mb-3">Change Password</h3>
                
                <div class="space-y-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">New Password (leave blank to keep current)</label>
                        <input type="password" name="password" placeholder="••••••••"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-900">
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-900">
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-xs transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
