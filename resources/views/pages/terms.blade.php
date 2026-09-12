@extends('layouts.app')

@section('title', 'Terms and Conditions — RCU Student Resource Hub')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8 space-y-6">
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Terms and Conditions</h1>
        <p class="text-xs text-slate-400 mt-1">Please read these terms carefully before accessing or uploading resources.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-2xs space-y-4 text-xs sm:text-sm text-slate-700 leading-relaxed">
        <h3 class="font-bold text-slate-900 text-sm">1. Acceptance of Terms</h3>
        <p>
            By accessing RCU Student Resource Hub, registering an account, or downloading/uploading materials, you agree to comply with these terms and all applicable laws.
        </p>
        <h3 class="font-bold text-slate-900 text-sm">2. Permitted Academic Use</h3>
        <p>
            All study guides, notes, and previous year papers are shared exclusively for non-commercial educational, revision, and personal learning purposes. Selling or commercializing materials downloaded from this site is strictly prohibited.
        </p>
        <h3 class="font-bold text-slate-900 text-sm">3. User Upload Responsibilities</h3>
        <p>
            Users uploading materials affirm that they either own the copyright to the notes or have lawful authorization to share them. Uploading defamatory, obscene, offensive, or malicious executable content will result in immediate permanent account termination and administrative blacklisting.
        </p>
        <h3 class="font-bold text-slate-900 text-sm">4. Teacher Verification</h3>
        <p>
            The "🏅 Verified Teacher" badge is granted exclusively through manual review by platform administrators upon verification of academic credentials. Normal users are prohibited from misrepresenting their status.
        </p>
    </div>
</div>
@endsection
