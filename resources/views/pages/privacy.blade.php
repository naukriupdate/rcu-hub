@extends('layouts.app')

@section('title', 'Privacy Policy — RCU Student Resource Hub')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8 space-y-6">
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Privacy Policy</h1>
        <p class="text-xs text-slate-400 mt-1">Last updated: September 2026</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-2xs space-y-4 text-xs sm:text-sm text-slate-700 leading-relaxed">
        <p>
            At <strong>RCU Student Resource Hub</strong>, student privacy is a foundational principle. This policy explains what minimal data we collect and how we safeguard it.
        </p>
        <h3 class="font-bold text-slate-900 text-sm">1. Information We Collect</h3>
        <p>
            We require only your Full Name, Email Address, and Password during registration. We deliberately <strong>never collect</strong> sensitive private information such as phone numbers, home addresses, Aadhaar numbers, or college fee credentials.
        </p>
        <h3 class="font-bold text-slate-900 text-sm">2. Use of Information</h3>
        <p>
            Your email is used solely to authenticate your account, attribute resources you choose to publish, and prevent abusive bot submissions. We will never sell, lease, or share your contact information with marketing brokers.
        </p>
        <h3 class="font-bold text-slate-900 text-sm">3. Uploaded Files</h3>
        <p>
            Files uploaded to the platform are stored securely in non-public storage directories and distributed exclusively after human moderation approval.
        </p>
    </div>
</div>
@endsection
