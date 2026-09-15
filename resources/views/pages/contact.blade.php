@extends('layouts.app')

@section('title', 'Contact Us — Ramchandra Chandravanshi University (RCU)')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 py-8 space-y-6">
    <div class="pb-4 border-b border-purple-100">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Contact Us</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Have questions, feedback, or resource inquiries? Reach out to us directly.</p>
    </div>

    <div class="clay-card bg-white/95 rounded-3xl border border-white/90 p-6 sm:p-8 shadow-clay-card space-y-6">
        <div class="space-y-4 text-xs sm:text-sm text-slate-700">
            
            <!-- WhatsApp -->
            <a href="https://wa.me/919608022431" target="_blank" rel="noopener noreferrer" class="flex items-start gap-3.5 p-3 rounded-2xl hover:bg-emerald-50/50 transition-colors group">
                <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-[#25D366] flex items-center justify-center shrink-0 shadow-xs group-hover:scale-105 transition-transform">
                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 group-hover:text-emerald-700">WhatsApp Support</h3>
                    <p class="text-slate-600 font-semibold mt-0.5">+91 9608022431</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">Quick responses for student queries & resource sharing.</p>
                </div>
            </a>

            <!-- Instagram -->
            <a href="https://instagram.com/indian_airforce_023" target="_blank" rel="noopener noreferrer" class="flex items-start gap-3.5 p-3 rounded-2xl hover:bg-pink-50/50 transition-colors group">
                <div class="w-10 h-10 rounded-2xl bg-pink-100 text-[#E1306C] flex items-center justify-center shrink-0 shadow-xs group-hover:scale-105 transition-transform">
                    <i data-lucide="instagram" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 group-hover:text-pink-700">Instagram</h3>
                    <p class="text-slate-600 font-semibold mt-0.5">@indian_airforce_023</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">Follow for community updates and announcements.</p>
                </div>
            </a>

            <!-- Email -->
            <a href="mailto:priyanshu22431@gmail.com" class="flex items-start gap-3.5 p-3 rounded-2xl hover:bg-blue-50/50 transition-colors group">
                <div class="w-10 h-10 rounded-2xl bg-blue-100 text-[#3B82F6] flex items-center justify-center shrink-0 shadow-xs group-hover:scale-105 transition-transform">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 group-hover:text-blue-700">Email Inquiries</h3>
                    <p class="text-slate-600 font-semibold mt-0.5">priyanshu22431@gmail.com</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">For collaborations, document removals, and support.</p>
                </div>
            </a>

        </div>

        <div class="p-4 bg-purple-50/60 rounded-2xl border border-purple-100 text-xs text-slate-600 leading-relaxed">
            For official university admission inquiries, exam forms, fee receipts, or administrative verification, please contact the Ramchandra Chandravanshi University (RCU) administration.
        </div>
    </div>
</div>
@endsection
