@extends('layouts.app')

@section('title', 'Profile Settings — Ramchandra Chandravanshi University (RCU)')
@section('meta_description', 'Manage your student or faculty profile, photo, and account security on RCU Hub.')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 py-6 sm:py-8 space-y-6">
    
    <!-- Back Header -->
    <div class="flex items-center gap-3 pb-3 border-b border-purple-100">
        <a href="{{ route('dashboard') }}" class="p-2 -ml-2 text-slate-500 hover:text-[#6C5CE7] rounded-xl hover:bg-purple-50 transition-colors" aria-label="Back to account">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Profile Settings</h1>
            <p class="text-xs text-slate-500 mt-0.5">Update your personal details, avatar, and security credentials</p>
        </div>
    </div>

    <!-- Main Card -->
    <div class="clay-card p-6 sm:p-8 bg-white/95 shadow-clay-card rounded-3xl border border-white/90">
        <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs sm:text-sm" x-data="{
            photoPreview: null,
            handlePhotoChange(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 2097152) {
                        alert('Image must be less than 2MB');
                        e.target.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = (e) => { this.photoPreview = e.target.result; };
                    reader.readAsDataURL(file);
                }
            }
        }">
            @csrf

            <!-- Profile Photo Upload Section -->
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 p-4 rounded-2xl bg-purple-50/50 border border-purple-100">
                <div class="relative shrink-0">
                    <template x-if="photoPreview">
                        <img :src="photoPreview" alt="Profile preview" class="w-20 h-20 rounded-full object-cover border-2 border-[#6C5CE7] shadow-md">
                    </template>
                    <template x-if="!photoPreview">
                        @if($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full object-cover border-2 border-white shadow-md">
                        @else
                            <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-[#6C5CE7] to-[#8C7CFF] text-white flex items-center justify-center font-bold text-2xl shadow-md">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                        @endif
                    </template>
                </div>

                <div class="flex-1 text-center sm:text-left space-y-1.5 min-w-0">
                    <h3 class="font-bold text-slate-900 text-sm">Profile Photo</h3>
                    <p class="text-[11px] text-slate-500 leading-normal">
                        Upload a clear JPEG, PNG, or WebP photo. Maximum file size: <strong>2 MB</strong>.
                    </p>
                    <div class="pt-1 flex flex-wrap items-center justify-center sm:justify-start gap-2">
                        <label class="cursor-pointer px-3.5 py-1.5 rounded-full bg-white text-[#6C5CE7] hover:bg-purple-100/80 font-bold text-xs border border-purple-200 shadow-xs transition-colors flex items-center gap-1.5">
                            <i data-lucide="camera" class="w-3.5 h-3.5"></i>
                            <span>Choose Photo</span>
                            <input type="file" name="avatar" accept="image/jpeg,image/png,image/webp" class="hidden" @change="handlePhotoChange($event)">
                        </label>
                    </div>
                    @error('avatar')
                        <p class="text-rose-500 text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Full Name -->
            <div>
                <label class="block font-bold text-slate-700 mb-1.5">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-2.5 bg-white border border-purple-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#6C5CE7] focus:border-transparent text-slate-900 text-sm font-medium shadow-xs">
                @error('name')
                    <p class="text-rose-500 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address (Disabled) -->
            <div>
                <label class="block font-bold text-slate-700 mb-1.5">Email Address</label>
                <input type="email" value="{{ $user->email }}" disabled
                    class="w-full px-4 py-2.5 bg-slate-100 border border-slate-200 rounded-2xl text-slate-500 cursor-not-allowed text-sm font-medium">
                <p class="text-[11px] text-slate-400 mt-1">Contact administration to modify your registered university email.</p>
            </div>

            <!-- Password Change Section -->
            <div class="pt-4 border-t border-purple-50 space-y-3">
                <h3 class="font-black text-slate-900 text-sm">Security & Password</h3>
                <p class="text-xs text-slate-500">Leave blank if you don't wish to change your current password.</p>
                
                <div class="space-y-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">New Password</label>
                        <input type="password" name="password" placeholder="••••••••"
                            class="w-full px-4 py-2.5 bg-white border border-purple-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#6C5CE7] text-slate-900 text-sm shadow-xs">
                        @error('password')
                            <p class="text-rose-500 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••"
                            class="w-full px-4 py-2.5 bg-white border border-purple-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#6C5CE7] text-slate-900 text-sm shadow-xs">
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-[#7C4DFF] to-[#6C5CE7] hover:from-[#6C5CE7] hover:to-[#5641E5] text-white font-bold text-sm rounded-full shadow-[0_8px_20px_-4px_rgba(108,92,231,0.5)] transition-all flex items-center justify-center gap-2">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>Save Changes</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
