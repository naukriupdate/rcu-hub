@extends('layouts.app')

@section('title', 'Disclaimer — RCU Student Resource Hub')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8 space-y-6">
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Disclaimer</h1>
        <p class="text-xs text-slate-400 mt-1">Important legal and academic disclosure.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-2xs space-y-4 text-xs sm:text-sm text-slate-700 leading-relaxed">
        <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl text-amber-900 font-medium">
            <strong>RCU Student Resource Hub is an independent community initiative</strong> run by and for students of Rani Channamma University (RCU). It is <strong>NOT</strong> an official university website, portal, or administrative wing.
        </div>

        <h3 class="font-bold text-slate-900 text-sm">1. Official University Authority</h3>
        <p>
            Rani Channamma University (RCU), Belagavi, maintains its official university portal at <a href="https://www.rcu.edu.in/" target="_blank" rel="noopener" class="text-blue-600 underline font-semibold">https://www.rcu.edu.in/</a>. For all legally binding examination timetables, grade lists, marks card issuances, and official circulars, the university's official site remains the authoritative source of record.
        </p>

        <h3 class="font-bold text-slate-900 text-sm">2. Community Submitted Content</h3>
        <p>
            Study notes, solution sets, and practical manuals uploaded by users represent the individual viewpoints, notes, and academic summaries of their respective authors. While our moderation team evaluates submissions prior to listing, we make no express guarantees regarding syllabus completeness or academic correctness.
        </p>

        <h3 class="font-bold text-slate-900 text-sm">3. Copyright & Takedowns</h3>
        <p>
            If you are a copyright owner or publisher and believe any document on this site infringes your intellectual property, please report the file via the on-page "Report Resource" button or email <a href="mailto:dmca@rcustudenthub.in" class="text-blue-600 underline">dmca@rcustudenthub.in</a> for immediate takedown.
        </p>
    </div>
</div>
@endsection
