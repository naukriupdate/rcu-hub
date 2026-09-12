@extends('layouts.app')

@section('title', 'Contact Us — RCU Student Resource Hub')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 py-8 space-y-6">
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Contact Us</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Have feedback, questions, or a content concern? Reach out to us.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-2xs space-y-6">
        <div class="space-y-4 text-xs sm:text-sm text-slate-700">
            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900">Email Support</h3>
                    <p class="text-slate-500 mt-0.5">contact@rcustudenthub.in</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">We respond within 24–48 working hours.</p>
                </div>
            </div>

            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <i data-lucide="shield-alert" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900">Copyright / Content Removal</h3>
                    <p class="text-slate-500 mt-0.5">dmca@rcustudenthub.in</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">Please provide the resource link and proof of authorship.</p>
                </div>
            </div>
        </div>

        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 text-xs text-slate-500 leading-relaxed">
            For official university admission inquiries, exam forms, fee receipts, or duplicate marks cards, please contact the Rani Channamma University administration directly via <a href="https://www.rcu.edu.in/" target="_blank" rel="noopener" class="text-blue-600 underline font-semibold">rcu.edu.in</a>.
        </div>
    </div>
</div>
@endsection
