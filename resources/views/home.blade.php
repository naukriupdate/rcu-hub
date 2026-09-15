@extends('layouts.app')

@section('title', 'RCU Hub — Ramchandra Chandravanshi University Student Resource Portal')
@section('meta_description', 'Free study notes, previous year question papers (PYQs), courses, and official university notices for Ramchandra Chandravanshi University (RCU) students.')

@section('content')
<div class="w-full max-w-7xl mx-auto px-3.5 sm:px-6 lg:px-8 py-5 sm:py-7 space-y-7 sm:space-y-10 min-w-0 overflow-x-hidden">

    <!-- =========================================================================
         1. HERO SECTION: CAMPUS PHOTO CAROUSEL (Matching Mobile & Desktop References)
         ========================================================================= -->
    <section aria-label="Hero Carousel and Search" class="relative">
        <div x-data="{
            active: 0,
            slides: [
                '{{ asset('images/hero/campus-1.jpg') }}',
                '{{ asset('images/hero/campus-2.jpg') }}',
                '{{ asset('images/hero/campus-3.jpg') }}'
            ],
            touchStartX: 0,
            touchEndX: 0,
            timer: null,
            next() {
                this.active = (this.active + 1) % this.slides.length;
            },
            prev() {
                this.active = (this.active - 1 + this.slides.length) % this.slides.length;
            },
            startAutoplay() {
                this.timer = setInterval(() => { this.next(); }, 7000);
            },
            stopAutoplay() {
                if (this.timer) clearInterval(this.timer);
            }
        }" 
        x-init="startAutoplay()"
        @mouseenter="stopAutoplay()"
        @mouseleave="startAutoplay()"
        @touchstart="touchStartX = $event.changedTouches[0].screenX"
        @touchend="touchEndX = $event.changedTouches[0].screenX; if (touchStartX - touchEndX > 45) next(); if (touchEndX - touchStartX > 45) prev();"
        class="relative rounded-3xl sm:rounded-[2.5rem] overflow-hidden shadow-[0_20px_45px_-12px_rgba(15,23,42,0.25)] min-h-[340px] sm:min-h-[400px] lg:min-h-[440px] flex items-center bg-slate-900 border border-white/60">

            <!-- Background Slide Images -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="active === index" 
                     x-transition:enter="transition ease-out duration-700" 
                     x-transition:enter-start="opacity-0 scale-105" 
                     x-transition:enter-end="opacity-100 scale-100" 
                     x-transition:leave="transition ease-in duration-500" 
                     x-transition:leave-start="opacity-100 scale-100" 
                     x-transition:leave-end="opacity-0 scale-95" 
                     class="absolute inset-0 z-0">
                    <img :src="slide" alt="Ramchandra Chandravanshi University Campus" 
                         class="w-full h-full object-cover object-center"
                         :loading="index === 0 ? 'eager' : 'lazy'" width="1280" height="720">
                </div>
            </template>

            <!-- Premium Gradient Lighting Overlay for High Readability -->
            <div class="absolute inset-0 z-10 bg-gradient-to-r from-slate-950/90 via-slate-900/75 sm:via-slate-900/65 to-slate-900/30"></div>
            <div class="absolute inset-0 z-10 bg-gradient-to-t from-slate-950/85 via-transparent to-transparent sm:hidden"></div>

            <!-- Content Container -->
            <div class="relative z-20 w-full max-w-3xl px-5 sm:px-10 lg:px-14 py-8 sm:py-12 space-y-4 sm:space-y-6">
                
                <!-- Subtitle Badge -->
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-white text-[11px] sm:text-xs font-bold tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Welcome to RCU Hub</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-[1.15]">
                    Your College <br class="hidden sm:inline">
                    Resource <span class="text-[#A29BFE] underline decoration-[#6C5CE7]/60 decoration-wavy decoration-2">Portal</span>
                </h1>

                <!-- Short Supportive Description -->
                <p class="text-slate-200 text-xs sm:text-base leading-relaxed max-w-xl font-normal opacity-95">
                    Notes, PYQs, Courses, and important updates — all in one place for Ramchandra Chandravanshi University students.
                </p>

                <!-- Primary Search Bar (Matching Reference) -->
                <form action="{{ route('resources.index') }}" method="GET" class="pt-1 max-w-xl w-full">
                    <div class="relative flex items-center bg-white rounded-full p-1.5 sm:p-2 shadow-[0_15px_30px_rgba(0,0,0,0.25)] focus-within:ring-4 focus-within:ring-purple-300/60 transition-all">
                        <label for="heroSearchInput" class="sr-only">Search notes, previous year questions, and courses</label>
                        <div class="pl-3 sm:pl-4 text-slate-400 shrink-0">
                            <i data-lucide="search" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        </div>
                        <input id="heroSearchInput" type="text" name="q" placeholder="Search notes, PYQs, courses..." 
                            class="w-full min-w-0 bg-transparent border-0 px-2.5 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-0 font-medium">
                        <button type="submit" class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-tr from-[#6C5CE7] to-[#8C7CFF] hover:from-[#5641E5] hover:to-[#6C5CE7] text-white flex items-center justify-center shadow-md transition-transform active:scale-95" aria-label="Search">
                            <i data-lucide="arrow-right" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        </button>
                    </div>
                </form>

            </div>

            <!-- Previous / Next Slide Controls (Matching Reference) -->
            <button type="button" @click="prev()" 
                    class="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 z-30 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/35 hover:bg-black/60 text-white backdrop-blur-md flex items-center justify-center transition-all border border-white/20 active:scale-95 focus:outline-none" 
                    aria-label="Previous slide">
                <i data-lucide="chevron-left" class="w-4 h-4 sm:w-5 sm:h-5"></i>
            </button>
            <button type="button" @click="next()" 
                    class="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 z-30 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/35 hover:bg-black/60 text-white backdrop-blur-md flex items-center justify-center transition-all border border-white/20 active:scale-95 focus:outline-none" 
                    aria-label="Next slide">
                <i data-lucide="chevron-right" class="w-4 h-4 sm:w-5 sm:h-5"></i>
            </button>

            <!-- Pagination Dots (Bottom Right matching Reference) -->
            <div class="absolute right-5 sm:right-8 bottom-4 sm:bottom-6 z-30 flex items-center gap-1.5 bg-black/30 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/20">
                <template x-for="(slide, index) in slides" :key="index">
                    <button type="button" @click="active = index" 
                            class="transition-all rounded-full h-2 focus:outline-none"
                            :class="active === index ? 'w-5 bg-white' : 'w-2 bg-white/45 hover:bg-white/70'"
                            :aria-label="'Go to slide ' + (index + 1)"></button>
                </template>
            </div>

        </div>
    </section>


    <!-- =========================================================================
         2. QUICK ACCESS CARDS (Notes, PYQs, Courses, Notices matching Reference)
         ========================================================================= -->
    <section aria-label="Quick Access Categories">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 lg:gap-5">
            
            <!-- 1. Notes (Soft Lavender) -->
            <a href="{{ route('resources.index', ['type' => 'notes']) }}" 
               class="rounded-2xl sm:rounded-3xl p-4 sm:p-5 bg-gradient-to-br from-[#FAF8FF] to-[#EFEAFF] border border-white/90 shadow-[0_10px_25px_-8px_rgba(108,92,231,0.15)] hover:shadow-[0_16px_35px_-8px_rgba(108,92,231,0.25)] hover:-translate-y-1 transition-all group flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-white text-[#6C5CE7] flex items-center justify-center shadow-xs group-hover:scale-105 transition-transform">
                        <i data-lucide="file-text" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-purple-400 group-hover:translate-x-1 transition-transform"></i>
                </div>
                <div class="mt-4 sm:mt-6">
                    <h2 class="font-black text-slate-900 text-sm sm:text-base group-hover:text-[#6C5CE7] transition-colors">Notes</h2>
                    <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1 hidden sm:block">Class & subject notes</p>
                </div>
            </a>

            <!-- 2. PYQs (Soft Mint) -->
            <a href="{{ route('resources.index', ['type' => 'pyq']) }}" 
               class="rounded-2xl sm:rounded-3xl p-4 sm:p-5 bg-gradient-to-br from-[#F0FDF9] to-[#E0F7EF] border border-white/90 shadow-[0_10px_25px_-8px_rgba(0,184,148,0.15)] hover:shadow-[0_16px_35px_-8px_rgba(0,184,148,0.25)] hover:-translate-y-1 transition-all group flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-white text-[#00B894] flex items-center justify-center shadow-xs group-hover:scale-105 transition-transform">
                        <i data-lucide="file-check" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-emerald-400 group-hover:translate-x-1 transition-transform"></i>
                </div>
                <div class="mt-4 sm:mt-6">
                    <h2 class="font-black text-slate-900 text-sm sm:text-base group-hover:text-[#00B894] transition-colors">PYQs</h2>
                    <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1 hidden sm:block">Previous year papers</p>
                </div>
            </a>

            <!-- 3. Courses (Soft Peach/Orange) -->
            <a href="{{ route('courses.index') }}" 
               class="rounded-2xl sm:rounded-3xl p-4 sm:p-5 bg-gradient-to-br from-[#FFF8F3] to-[#FFEDE0] border border-white/90 shadow-[0_10px_25px_-8px_rgba(255,159,67,0.15)] hover:shadow-[0_16px_35px_-8px_rgba(255,159,67,0.25)] hover:-translate-y-1 transition-all group flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-white text-[#FF9F43] flex items-center justify-center shadow-xs group-hover:scale-105 transition-transform">
                        <i data-lucide="graduation-cap" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-orange-400 group-hover:translate-x-1 transition-transform"></i>
                </div>
                <div class="mt-4 sm:mt-6">
                    <h2 class="font-black text-slate-900 text-sm sm:text-base group-hover:text-[#FF9F43] transition-colors">Courses</h2>
                    <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1 hidden sm:block">Explore degree syllabi</p>
                </div>
            </a>

            <!-- 4. Notices (Soft Blue) -->
            <a href="{{ route('notices.index') }}" 
               class="rounded-2xl sm:rounded-3xl p-4 sm:p-5 bg-gradient-to-br from-[#F0F7FF] to-[#E1EFFF] border border-white/90 shadow-[0_10px_25px_-8px_rgba(9,132,227,0.15)] hover:shadow-[0_16px_35px_-8px_rgba(9,132,227,0.25)] hover:-translate-y-1 transition-all group flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-white text-[#0984E3] flex items-center justify-center shadow-xs group-hover:scale-105 transition-transform">
                        <i data-lucide="bell" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-blue-400 group-hover:translate-x-1 transition-transform"></i>
                </div>
                <div class="mt-4 sm:mt-6">
                    <h2 class="font-black text-slate-900 text-sm sm:text-base group-hover:text-[#0984E3] transition-colors">Notices</h2>
                    <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1 hidden sm:block">Exam & campus circulars</p>
                </div>
            </a>

        </div>
    </section>


    <!-- =========================================================================
         3. POPULAR RESOURCES (Real Dynamic Database Data + Text-Only "View All")
         ========================================================================= -->
    <section aria-label="Popular Resources">
        <div class="clay-card p-5 sm:p-7 bg-white/90 shadow-clay-card rounded-3xl border border-white/90 space-y-5">
            
            <!-- Section Header (Text-only "View All" with NO arrow) -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-2xl bg-purple-100 text-[#6C5CE7] flex items-center justify-center shadow-xs">
                        <i data-lucide="star" class="w-4 h-4 fill-[#6C5CE7]"></i>
                    </div>
                    <h2 class="font-black text-slate-900 text-base sm:text-xl tracking-tight">Popular Resources</h2>
                </div>
                <a href="{{ route('resources.index') }}" class="text-xs sm:text-sm font-bold text-[#6C5CE7] hover:text-[#5641E5] transition-colors">
                    View All
                </a>
            </div>

            <!-- Dynamic Resource Cards Grid (Matching Reference) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse($popularResources->take(4) as $res)
                    @php
                        // Detect file extension and assign appropriate badge color & label
                        $extension = strtolower(pathinfo($res->file_name ?: $res->file_path, PATHINFO_EXTENSION));
                        if (!$extension && $res->file_type) {
                            $extension = strtolower($res->file_type);
                        }
                        if (str_contains($extension, 'pdf')) {
                            $badgeColor = 'bg-rose-100 text-rose-600 border-rose-200';
                            $fileLabel = 'PDF';
                        } elseif (str_contains($extension, 'doc')) {
                            $badgeColor = 'bg-blue-100 text-blue-600 border-blue-200';
                            $fileLabel = 'DOC';
                        } elseif (str_contains($extension, 'ppt')) {
                            $badgeColor = 'bg-orange-100 text-orange-600 border-orange-200';
                            $fileLabel = 'PPT';
                        } elseif (str_contains($extension, 'xls')) {
                            $badgeColor = 'bg-emerald-100 text-emerald-600 border-emerald-200';
                            $fileLabel = 'XLS';
                        } else {
                            $badgeColor = 'bg-purple-100 text-purple-600 border-purple-200';
                            $fileLabel = strtoupper($extension ?: 'DOC');
                        }
                    @endphp

                    <a href="{{ route('resources.show', ['program' => $res->program?->slug ?? 'all', 'semester' => $res->semester?->slug ?? 'all', 'subject' => $res->subject?->slug ?? 'all', 'slug' => $res->slug]) }}" 
                       class="p-4 sm:p-5 rounded-2xl sm:rounded-3xl bg-white border border-purple-50/80 shadow-[0_4px_16px_rgba(108,92,231,0.06)] hover:shadow-[0_12px_28px_rgba(108,92,231,0.15)] hover:-translate-y-1 transition-all group flex flex-col justify-between">
                        
                        <div class="space-y-3">
                            <!-- File Type Badge -->
                            <div class="flex items-center justify-between">
                                <span class="px-2.5 py-1 rounded-lg text-[10px] font-black border uppercase tracking-wider {{ $badgeColor }}">
                                    {{ $fileLabel }}
                                </span>
                                <span class="text-[11px] font-medium text-slate-400">
                                    {{ $res->humanFileSize() }}
                                </span>
                            </div>

                            <!-- Title -->
                            <div>
                                <h3 class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-[#6C5CE7] transition-colors line-clamp-2 leading-snug">
                                    {{ $res->title }}
                                </h3>
                                <p class="text-[11px] text-slate-400 font-medium mt-1 truncate">
                                    {{ $res->program?->code ?? 'General' }} • Sem {{ $res->semester?->semester_number ?? 'All' }} • {{ $res->resourceType?->name ?? 'Notes' }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer with Uploader, Downloads, Date -->
                        <div class="mt-4 pt-3 border-t border-slate-100 space-y-2">
                            <div class="flex items-center gap-1.5 text-[11px] text-slate-500 font-medium truncate">
                                <i data-lucide="user" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                                <span class="truncate">{{ $res->uploader_name ?: ($res->user?->name ?? 'RCU Community') }}</span>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-slate-400 font-semibold">
                                <span class="flex items-center gap-1">
                                    <i data-lucide="download" class="w-3 h-3 text-slate-400"></i>
                                    {{ $res->downloads_count >= 1000 ? round($res->downloads_count/1000, 1).'k' : $res->downloads_count }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <i data-lucide="calendar" class="w-3 h-3 text-slate-400"></i>
                                    {{ $res->created_at->diffForHumans(null, true) }} ago
                                </span>
                            </div>
                        </div>

                    </a>
                @empty
                    <div class="col-span-full py-12 text-center text-slate-400 text-xs sm:text-sm">
                        No resources uploaded yet. Be the first to share!
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <!-- =========================================================================
         4. LATEST NOTICES (Immediately AFTER Popular Resources + Text-Only "View All")
         ========================================================================= -->
    <section aria-label="Latest Notices">
        <div class="clay-card p-5 sm:p-7 bg-white/90 shadow-clay-card rounded-3xl border border-white/90 space-y-5">
            
            <!-- Section Header (Text-only "View All" with NO arrow) -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-2xl bg-blue-100 text-[#0984E3] flex items-center justify-center shadow-xs">
                        <i data-lucide="bell" class="w-4 h-4 text-[#0984E3]"></i>
                    </div>
                    <h2 class="font-black text-slate-900 text-base sm:text-xl tracking-tight">Latest Notices</h2>
                </div>
                <a href="{{ route('notices.index') }}" class="text-xs sm:text-sm font-bold text-[#6C5CE7] hover:text-[#5641E5] transition-colors">
                    View All
                </a>
            </div>

            <!-- Notice Rows Card (Matching Reference) -->
            <div class="divide-y divide-purple-50/80 bg-white/80 rounded-2xl border border-purple-50 overflow-hidden">
                @forelse($latestNotices->take(4) as $notice)
                    @php
                        $titleLower = strtolower($notice->title);
                        if (str_contains($titleLower, 'exam') || str_contains($titleLower, 'form') || str_contains($titleLower, 'schedule')) {
                            $badgeText = 'NEW';
                            $badgeClass = 'bg-purple-100 text-[#6C5CE7]';
                        } elseif (str_contains($titleLower, 'holiday') || str_contains($titleLower, 'circular')) {
                            $badgeText = 'INFO';
                            $badgeClass = 'bg-emerald-100 text-emerald-700';
                        } else {
                            $badgeText = 'IMPORTANT';
                            $badgeClass = 'bg-amber-100 text-amber-700';
                        }
                    @endphp

                    <a href="{{ route('notices.show', $notice->slug) }}" 
                       class="p-3.5 sm:p-4 flex items-center justify-between gap-3 hover:bg-purple-50/50 transition-colors group">
                        
                        <div class="flex items-center gap-3 min-w-0">
                            <!-- Tag Badge -->
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider shrink-0 {{ $badgeClass }}">
                                {{ $badgeText }}
                            </span>
                            <!-- Title & Date -->
                            <div class="min-w-0">
                                <h3 class="font-bold text-xs sm:text-sm text-slate-800 group-hover:text-[#6C5CE7] truncate transition-colors">
                                    {{ $notice->title }}
                                </h3>
                                <p class="text-[11px] text-slate-400 mt-0.5 flex items-center gap-1">
                                    <i data-lucide="calendar" class="w-3 h-3"></i>
                                    <span>{{ $notice->published_at ? $notice->published_at->format('d M Y') : $notice->created_at->format('d M Y') }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Right Chevron -->
                        <div class="text-slate-300 group-hover:text-[#6C5CE7] group-hover:translate-x-1 transition-all shrink-0">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </div>
                    </a>
                @empty
                    <div class="py-8 text-center text-slate-400 text-xs">
                        No notices published currently.
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <!-- =========================================================================
         5. PLATFORM METRICS SUMMARY BAR
         ========================================================================= -->
    <section aria-label="Platform Metrics" class="clay-card p-5 sm:p-7 flex flex-col md:flex-row items-center justify-between gap-5 bg-white/85 rounded-3xl border border-white/90">
        <div class="grid grid-cols-3 gap-4 sm:gap-10 w-full md:w-auto text-center sm:text-left">
            <div class="space-y-0.5">
                <span class="block font-black text-lg sm:text-2xl text-slate-900">{{ number_format($totalResources) }}+</span>
                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Resources</span>
            </div>
            <div class="space-y-0.5">
                <span class="block font-black text-lg sm:text-2xl text-[#6C5CE7]">{{ number_format($totalUsers) }}+</span>
                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Students</span>
            </div>
            <div class="space-y-0.5">
                <span class="block font-black text-lg sm:text-2xl text-[#00B894]">{{ number_format($totalDownloads) }}+</span>
                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Downloads</span>
            </div>
        </div>

        <div class="font-handwriting text-[#6C5CE7] text-xl sm:text-2xl tracking-wide select-none shrink-0 text-center md:text-right">
            "Study Smarter, Build Your Future"
        </div>
    </section>

</div>
@endsection