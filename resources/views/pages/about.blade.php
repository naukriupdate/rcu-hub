@extends('layouts.app')

@section('title', 'About Us — RCU Student Resource Hub')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8 space-y-6">
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">About RCU Student Resource Hub</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Independent student-driven academic sharing platform.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-2xs space-y-4 text-xs sm:text-sm text-slate-700 leading-relaxed">
        <p>
            The <strong>RCU Student Resource Hub</strong> was founded with a single mission: to empower students and faculty of Ramchandra Chandravanshi University (RCU) by providing frictionless, high-speed access to quality study material, previous year question papers, syllabi, and official notifications.
        </p>
        <h3 class="font-bold text-slate-900 text-base pt-2">Our Key Values</h3>
        <ul class="list-disc list-inside space-y-1.5 pl-2 text-slate-600">
            <li><strong>Find Fast:</strong> Students can search, preview, and download study materials within seconds without filling out painful forms.</li>
            <li><strong>Contribute Easily:</strong> Any student or educator can submit lecture notes, solved papers, and lab files directly through our mobile-first upload form.</li>
            <li><strong>Verified Academic Quality:</strong> All community-submitted resources undergo human moderation before being listed publicly.</li>
            <li><strong>Official Updates:</strong> Direct access to university exam timetables, admit card notices, and results without delays.</li>
        </ul>
        <div class="p-4 bg-purple-50 border border-purple-200 rounded-xl text-purple-900 text-xs mt-6">
            <strong>Community Notice:</strong> This platform is an independent student community initiative built for students of Ramchandra Chandravanshi University (RCU).
        </div>
    </div>
</div>
@endsection
