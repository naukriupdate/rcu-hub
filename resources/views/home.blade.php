@extends('layouts.app')

@section('title', 'RCU Student Resource Hub — Study Smarter. Find Everything You Need')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-10">

    <!-- =========================================================================
         1. HERO SECTION (Claymorphism: Desktop Image 1 & Mobile Image 2)
         ========================================================================= -->
    <div class="relative overflow-hidden rounded-3xl lg:rounded-[2.75rem] bg-gradient-to-br from-[#FAF8FF] via-[#F4F0FF] to-[#EFEAFF] p-6 sm:p-10 lg:p-14 border border-white shadow-[0_25px_50px_-12px_rgba(108,92,231,0.12),0_2px_4px_rgba(255,255,255,0.95)_inset,0_-8px_16px_rgba(162,155,254,0.15)_inset]">
        
        <!-- Subtle Cloud & Blob Lighting Effects inside the Hero -->
        <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-gradient-to-br from-[#D6CEFD]/40 to-[#A29BFE]/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 rounded-full bg-gradient-to-tr from-[#FFEAA7]/30 to-[#55EFC4]/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Hero Left Text & Search Area (lg:col-span-7) -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                
                <!-- Pill Badge "Welcome to RCU Hub" -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#EDE9FE] text-[#6C5CE7] text-xs font-bold shadow-[0_2px_6px_rgba(108,92,231,0.12),0_1px_2px_rgba(255,255,255,0.9)_inset] border border-white/80">
                    <i data-lucide="zap" class="w-3.5 h-3.5 text-[#6C5CE7] fill-[#6C5CE7]"></i>
                    <span>Welcome to RCU Hub</span>
                </div>

                <!-- Hero Main Heading -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-slate-900 leading-[1.18]">
                    Your Learning <br class="hidden sm:inline">
                    Journey <span class="bg-gradient-to-r from-[#6C5CE7] to-[#8C7CFF] bg-clip-text text-transparent">Starts Here</span>
                </h1>

                <!-- Supportive Subtitle -->
                <p class="text-slate-500 text-sm sm:text-base leading-relaxed max-w-xl mx-auto lg:mx-0 font-medium">
                    Access notes, PYQs, courses, and important updates — all in one place. Build your future with RCU Hub.
                </p>

                <!-- Claymorphism Search Input & Submit Button -->
                <form action="{{ route('resources.index') }}" method="GET" class="mt-4 max-w-xl mx-auto lg:mx-0 w-full">
                    <div class="relative flex items-center bg-white/95 rounded-full p-1.5 sm:p-2 shadow-[0_12px_28px_-6px_rgba(108,92,231,0.14),0_2px_4px_rgba(255,255,255,1)_inset,0_-3px_8px_rgba(162,155,254,0.15)_inset] border border-purple-100 focus-within:ring-4 focus-within:ring-purple-200/70 transition-all">
                        <div class="pl-3 sm:pl-4 text-purple-400 shrink-0">
                            <i data-lucide="search" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        </div>
                        <input type="text" name="q" placeholder="Search notes, PYQs, courses..." 
                            class="w-full min-w-0 bg-transparent border-0 px-2.5 sm:px-3.5 py-2 sm:py-2.5 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-0 font-medium">
                        <button type="submit" class="shrink-0 px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-[#7C4DFF] to-[#6C5CE7] hover:from-[#6C5CE7] hover:to-[#5641E5] text-white font-bold text-xs sm:text-sm rounded-full shadow-[0_8px_20px_-4px_rgba(108,92,231,0.5),0_2px_4px_rgba(255,255,255,0.4)_inset,0_-3px_6px_rgba(0,0,0,0.2)_inset] transition-all flex items-center gap-1 sm:gap-1.5">
                            <span>Search</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                        </button>
                    </div>
                </form>

                <!-- Popular Search Chips -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-2 pt-1 text-xs">
                    <span class="text-slate-400 font-bold mr-1">Popular:</span>
                    <a href="{{ route('resources.index', ['course' => 'bca']) }}" class="clay-chip">BCA</a>
                    <a href="{{ route('resources.index', ['type' => 'pyq']) }}" class="clay-chip">PYQs</a>
                    <a href="{{ route('resources.index', ['type' => 'notes']) }}" class="clay-chip">Notes</a>
                    <a href="{{ route('resources.index', ['q' => 'Semester']) }}" class="clay-chip">Semester</a>
                    <a href="{{ route('resources.index', ['q' => 'Exam']) }}" class="clay-chip">Exam</a>
                </div>

            </div>

            <!-- Hero Right 3D Educational Clay Illustration (lg:col-span-5) -->
            <div class="lg:col-span-5 flex items-center justify-center relative">
                
                <!-- 3D Clay Stack Illustration Container -->
                <div class="relative w-full max-w-md aspect-square flex items-center justify-center">
                    
                    <!-- Floating Background Orbs -->
                    <div class="absolute -top-4 right-10 w-12 h-12 rounded-full bg-gradient-to-br from-[#FFEAA7] to-[#FDCB6E] shadow-[0_8px_16px_rgba(253,203,110,0.4),0_2px_4px_#FFF_inset,0_-3px_6px_rgba(0,0,0,0.15)_inset] animate-bounce duration-1000"></div>
                    <div class="absolute bottom-6 left-6 w-10 h-10 rounded-full bg-gradient-to-br from-[#A8F5E1] to-[#00B894] shadow-[0_8px_16px_rgba(0,184,148,0.35),0_2px_4px_#FFF_inset,0_-3px_6px_rgba(0,0,0,0.15)_inset]"></div>
                    <div class="absolute top-1/2 -right-4 w-8 h-8 rounded-full bg-gradient-to-br from-[#D6CEFD] to-[#6C5CE7] shadow-[0_6px_12px_rgba(108,92,231,0.35),0_2px_4px_#FFF_inset]"></div>

                    <!-- SVG 3D Clay Art: Laptop, Books, Graduation Cap, Notepad -->
                    <svg viewBox="0 0 500 450" class="w-full h-auto drop-shadow-[0_25px_35px_rgba(108,92,231,0.22)] select-none" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <!-- Linear and Radial Clay Lighting Gradients -->
                            <linearGradient id="laptopScreen" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#FFFFFF" />
                                <stop offset="100%" stop-color="#EDE9FE" />
                            </linearGradient>
                            <linearGradient id="laptopBody" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#F1EFFE" />
                                <stop offset="100%" stop-color="#C5BAF7" />
                            </linearGradient>
                            <linearGradient id="book1Grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#8C7CFF" />
                                <stop offset="50%" stop-color="#6C5CE7" />
                                <stop offset="100%" stop-color="#5641E5" />
                            </linearGradient>
                            <linearGradient id="book2Grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#55EFC4" />
                                <stop offset="50%" stop-color="#00B894" />
                                <stop offset="100%" stop-color="#009475" />
                            </linearGradient>
                            <linearGradient id="book3Grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#FFEAA7" />
                                <stop offset="50%" stop-color="#FDCB6E" />
                                <stop offset="100%" stop-color="#E17055" />
                            </linearGradient>
                            <linearGradient id="notepadGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#FFFFFF" />
                                <stop offset="100%" stop-color="#F9F8FE" />
                            </linearGradient>
                            <filter id="clayGlow" x="-10%" y="-10%" width="120%" height="120%">
                                <feDropShadow dx="0" dy="12" stdDeviation="10" flood-color="#6C5CE7" flood-opacity="0.18" />
                            </filter>
                        </defs>

                        <!-- Soft 3D Cloud Platform Base -->
                        <ellipse cx="250" cy="400" rx="190" ry="24" fill="#E8E2FD" opacity="0.7" />
                        <ellipse cx="250" cy="395" rx="160" ry="18" fill="#D6CEFD" opacity="0.6" />

                        <!-- Bottom Book Stack (Yellow/Peach Spine) -->
                        <rect x="110" y="360" width="280" height="34" rx="12" fill="url(#book3Grad)" />
                        <rect x="112" y="362" width="276" height="6" rx="3" fill="#FFF" opacity="0.5" />
                        <rect x="125" y="372" width="250" height="12" rx="4" fill="#FFF" opacity="0.85" />

                        <!-- Middle Book (Mint Green Spine) -->
                        <rect x="130" y="325" width="250" height="32" rx="10" fill="url(#book2Grad)" />
                        <rect x="132" y="327" width="246" height="5" rx="2" fill="#FFF" opacity="0.55" />
                        <rect x="145" y="336" width="220" height="10" rx="3" fill="#FFF" opacity="0.9" />

                        <!-- Top Book (Clay Purple Spine) -->
                        <rect x="145" y="292" width="230" height="30" rx="9" fill="url(#book1Grad)" />
                        <rect x="147" y="294" width="226" height="5" rx="2" fill="#FFF" opacity="0.5" />
                        <rect x="160" y="303" width="200" height="9" rx="3" fill="#FFF" opacity="0.85" />

                        <!-- 3D Laptop Display Screen -->
                        <rect x="170" y="110" width="210" height="145" rx="18" fill="#5641E5" />
                        <rect x="172" y="112" width="206" height="6" rx="3" fill="#FFF" opacity="0.4" />
                        <rect x="180" y="120" width="190" height="125" rx="12" fill="url(#laptopScreen)" />
                        
                        <!-- RCU Hub Logo on Laptop Screen -->
                        <circle cx="275" cy="165" r="22" fill="#6C5CE7" />
                        <path d="M263 162 L275 154 L287 162 L275 170 Z" fill="#FFFFFF" />
                        <path d="M266 165 L266 172 Q275 178 284 172 L284 165" stroke="#FFFFFF" stroke-width="2.5" fill="none" stroke-linecap="round" />
                        <text x="275" y="202" font-family="'Inter', sans-serif" font-weight="800" font-size="14" fill="#2D3436" text-anchor="middle">RCU Hub</text>

                        <!-- Laptop Keyboard Base (Slanted Perspective) -->
                        <path d="M140 255 L410 255 L385 292 L165 292 Z" fill="url(#laptopBody)" />
                        <path d="M142 256 L408 256" stroke="#FFFFFF" stroke-width="2" />
                        <!-- Keyboard keys subtle grid -->
                        <rect x="185" y="260" width="180" height="18" rx="5" fill="#6C5CE7" opacity="0.75" />
                        <rect x="235" y="280" width="80" height="8" rx="3" fill="#C5BAF7" />

                        <!-- Pen Stand on Left with Colorful Clay Pens -->
                        <rect x="110" y="245" width="42" height="50" rx="10" fill="#FFFFFF" />
                        <rect x="110" y="245" width="42" height="50" rx="10" stroke="#E8E4FD" stroke-width="2" />
                        <!-- Pens inside stand -->
                        <rect x="116" y="215" width="7" height="40" rx="3" fill="#FF7675" transform="rotate(-8 116 215)" />
                        <rect x="126" y="205" width="8" height="50" rx="3" fill="#6C5CE7" />
                        <rect x="138" y="218" width="7" height="38" rx="3" fill="#00B894" transform="rotate(10 138 218)" />

                        <!-- Notepad on Right (Clay Note with Spiral Binding) -->
                        <g transform="translate(370, 190) rotate(8)">
                            <rect x="0" y="0" width="75" height="105" rx="12" fill="url(#notepadGrad)" stroke="#EAE6FD" stroke-width="1.5" />
                            <!-- Spiral bindings -->
                            <circle cx="8" cy="15" r="3.5" fill="#C5BAF7" />
                            <circle cx="8" cy="30" r="3.5" fill="#C5BAF7" />
                            <circle cx="8" cy="45" r="3.5" fill="#C5BAF7" />
                            <circle cx="8" cy="60" r="3.5" fill="#C5BAF7" />
                            <circle cx="8" cy="75" r="3.5" fill="#C5BAF7" />
                            <circle cx="8" cy="90" r="3.5" fill="#C5BAF7" />
                            <!-- Motivational text lines on note -->
                            <text x="42" y="38" font-family="'Caveat', cursive" font-weight="700" font-size="12" fill="#6C5CE7" text-anchor="middle">Better</text>
                            <text x="42" y="54" font-family="'Caveat', cursive" font-weight="700" font-size="12" fill="#6C5CE7" text-anchor="middle">Learning</text>
                            <text x="42" y="70" font-family="'Caveat', cursive" font-weight="700" font-size="12" fill="#6C5CE7" text-anchor="middle">Brighter</text>
                            <text x="42" y="86" font-family="'Caveat', cursive" font-weight="700" font-size="12" fill="#6C5CE7" text-anchor="middle">Future ☺</text>
                        </g>

                        <!-- Floating Light Bulb (Idea / Inspiration) -->
                        <g transform="translate(425, 75)">
                            <ellipse cx="18" cy="18" rx="16" ry="16" fill="url(#book3Grad)" />
                            <circle cx="14" cy="12" r="4" fill="#FFF" opacity="0.6" />
                            <rect x="12" y="32" width="12" height="6" rx="2" fill="#B2BEC3" />
                            <!-- Ray accents -->
                            <path d="M18 0 L18 -6 M36 18 L42 18 M-4 18 L2 18" stroke="#FDCB6E" stroke-width="3" stroke-linecap="round" />
                        </g>
                    </svg>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================================
         2. QUICK ACCESS 4 PRIMARY CARDS (Desktop 4-col, Mobile 2-col)
         ========================================================================= -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Quick Access</h2>
            <a href="{{ route('resources.index') }}" class="text-xs sm:text-sm font-bold text-[#6C5CE7] hover:underline flex items-center gap-1">
                <span>See All</span>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            
            <!-- 1. Notes Card (Soft Lavender / Purple) -->
            <a href="{{ route('resources.index', ['type' => 'notes']) }}" class="clay-card-purple p-5 sm:p-6 flex flex-col justify-between group">
                <div>
                    <div class="clay-bubble clay-bubble-purple w-12 h-12 mb-4">
                        <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base sm:text-lg">Notes</h3>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1 line-clamp-2">Well structured study materials for better preparation.</p>
                </div>
                <div class="mt-6 flex items-center justify-between pt-2">
                    <span class="text-xs font-bold text-[#6C5CE7] hidden sm:inline">Explore</span>
                    <div class="clay-arrow-btn">
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </div>
                </div>
            </a>

            <!-- 2. PYQs Card (Soft Mint / Green) -->
            <a href="{{ route('resources.index', ['type' => 'pyq']) }}" class="clay-card-mint p-5 sm:p-6 flex flex-col justify-between group">
                <div>
                    <div class="clay-bubble clay-bubble-mint w-12 h-12 mb-4">
                        <i data-lucide="file-check" class="w-6 h-6 text-white"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base sm:text-lg">PYQs</h3>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1 line-clamp-2">Previous year questions with solutions & model papers.</p>
                </div>
                <div class="mt-6 flex items-center justify-between pt-2">
                    <span class="text-xs font-bold text-[#00B894] hidden sm:inline">Browse</span>
                    <div class="clay-arrow-btn text-[#00B894] hover:bg-[#00B894]">
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </div>
                </div>
            </a>

            <!-- 3. Courses Card (Soft Peach / Orange) -->
            <a href="{{ route('courses.index') }}" class="clay-card-peach p-5 sm:p-6 flex flex-col justify-between group">
                <div>
                    <div class="clay-bubble clay-bubble-peach w-12 h-12 mb-4">
                        <i data-lucide="graduation-cap" class="w-6 h-6 text-white"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base sm:text-lg">Courses</h3>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1 line-clamp-2">Complete course details, curriculum and resources.</p>
                </div>
                <div class="mt-6 flex items-center justify-between pt-2">
                    <span class="text-xs font-bold text-[#FF7675] hidden sm:inline">View Courses</span>
                    <div class="clay-arrow-btn text-[#FF7675] hover:bg-[#FF7675]">
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </div>
                </div>
            </a>

            <!-- 4. Notices Card (Soft Blue / Sky) -->
            <a href="{{ route('notices.index') }}" class="clay-card-blue p-5 sm:p-6 flex flex-col justify-between group">
                <div>
                    <div class="clay-bubble clay-bubble-blue w-12 h-12 mb-4">
                        <i data-lucide="bell" class="w-6 h-6 text-white"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base sm:text-lg">Notices</h3>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1 line-clamp-2">Stay updated with latest announcements & timetables.</p>
                </div>
                <div class="mt-6 flex items-center justify-between pt-2">
                    <span class="text-xs font-bold text-[#0984E3] hidden sm:inline">Circulars</span>
                    <div class="clay-arrow-btn text-[#0984E3] hover:bg-[#0984E3]">
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </div>
                </div>
            </a>

        </div>
    </div>


    <!-- =========================================================================
         3. DUAL SECTION: LATEST NOTICES + QUICK ACCESS / POPULAR (Desktop & Mobile)
         ========================================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- LEFT: Latest Notices (lg:col-span-7) -->
        <div class="lg:col-span-7 clay-card p-6 sm:p-8 space-y-6">
            
            <div class="flex items-center justify-between pb-4 border-b border-purple-50">
                <div class="flex items-center gap-3">
                    <div class="clay-bubble clay-bubble-purple w-10 h-10">
                        <i data-lucide="megaphone" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h2 class="font-black text-slate-900 text-lg sm:text-xl">Latest Notices</h2>
                        <p class="text-xs text-slate-400">Synchronized circulars from RCU official portal</p>
                    </div>
                </div>
                <a href="{{ route('notices.index') }}" class="clay-chip hover:bg-[#6C5CE7] hover:text-white">
                    <span>View All</span>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 ml-1"></i>
                </a>
            </div>

            <!-- Dynamic Notices Feed -->
            <div class="space-y-3">
                @forelse($latestNotices->take(4) as $notice)
                    <a href="{{ route('notices.show', $notice->slug) }}" class="flex items-center justify-between p-3.5 sm:p-4 rounded-2xl bg-white/70 hover:bg-white border border-purple-50 hover:border-purple-200 shadow-[0_4px_12px_rgba(108,92,231,0.04)] hover:shadow-[0_8px_20px_rgba(108,92,231,0.1)] transition-all group">
                        <div class="flex items-center gap-3 min-w-0">
                            <!-- Category Badge: New, Update, Info -->
                            @if($notice->is_new)
                                <span class="clay-badge-new shrink-0">New</span>
                            @elseif(str_contains(strtolower($notice->title), 'exam') || str_contains(strtolower($notice->title), 'schedule'))
                                <span class="clay-badge-update shrink-0">Update</span>
                            @else
                                <span class="clay-badge-info shrink-0">Info</span>
                            @endif

                            <div class="min-w-0">
                                <h3 class="font-bold text-xs sm:text-sm text-slate-800 group-hover:text-[#6C5CE7] truncate transition-colors">
                                    {{ $notice->title }}
                                </h3>
                                <p class="text-[11px] text-slate-400 mt-0.5 line-clamp-1">
                                    {{ $notice->excerpt ?: 'Official university notification and circular details.' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 shrink-0 ml-3">
                            <span class="text-[11px] font-semibold text-slate-400 hidden sm:inline">
                                {{ $notice->published_at ? $notice->published_at->format('d M Y') : 'Recent' }}
                            </span>
                            <div class="w-8 h-8 rounded-full bg-purple-50 group-hover:bg-[#6C5CE7] text-purple-600 group-hover:text-white flex items-center justify-center transition-all">
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="py-10 text-center text-slate-400 text-xs">
                        No notices published currently.
                    </div>
                @endforelse
            </div>

        </div>

        <!-- RIGHT: Quick Access Widgets & Visual Clay Accent (lg:col-span-5) -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Quick Access Widget Box -->
            <div class="clay-card p-6 sm:p-8 space-y-5">
                <div class="flex items-center gap-2.5 pb-3 border-b border-purple-50">
                    <i data-lucide="zap" class="w-5 h-5 text-[#6C5CE7]"></i>
                    <h3 class="font-black text-slate-900 text-base sm:text-lg">Quick Access</h3>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('resources.index', ['type' => 'syllabus']) }}" class="p-3.5 rounded-2xl bg-gradient-to-br from-[#FAF8FF] to-[#EFEAFF] border border-white hover:border-purple-200 shadow-sm flex items-center gap-3 group transition-all">
                        <div class="w-9 h-9 rounded-xl bg-purple-100 text-[#6C5CE7] flex items-center justify-center shrink-0">
                            <i data-lucide="book-open" class="w-4 h-4"></i>
                        </div>
                        <span class="font-bold text-xs text-slate-800 group-hover:text-[#6C5CE7]">BCA Syllabus</span>
                    </a>

                    <a href="{{ route('resources.index') }}" class="p-3.5 rounded-2xl bg-gradient-to-br from-[#F3FDF9] to-[#E2F9F0] border border-white hover:border-emerald-200 shadow-sm flex items-center gap-3 group transition-all">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-[#00B894] flex items-center justify-center shrink-0">
                            <i data-lucide="folder" class="w-4 h-4"></i>
                        </div>
                        <span class="font-bold text-xs text-slate-800 group-hover:text-[#00B894]">Study Materials</span>
                    </a>

                    <a href="{{ route('resources.index', ['type' => 'pyq']) }}" class="p-3.5 rounded-2xl bg-gradient-to-br from-[#FFF8F6] to-[#FFEBE6] border border-white hover:border-rose-200 shadow-sm flex items-center gap-3 group transition-all">
                        <div class="w-9 h-9 rounded-xl bg-rose-100 text-[#FF7675] flex items-center justify-center shrink-0">
                            <i data-lucide="target" class="w-4 h-4"></i>
                        </div>
                        <span class="font-bold text-xs text-slate-800 group-hover:text-[#FF7675]">Exam Prep</span>
                    </a>

                    <a href="{{ route('links.index') }}" class="p-3.5 rounded-2xl bg-gradient-to-br from-[#F5FAFF] to-[#E3F1FD] border border-white hover:border-blue-200 shadow-sm flex items-center gap-3 group transition-all">
                        <div class="w-9 h-9 rounded-xl bg-blue-100 text-[#0984E3] flex items-center justify-center shrink-0">
                            <i data-lucide="link" class="w-4 h-4"></i>
                        </div>
                        <span class="font-bold text-xs text-slate-800 group-hover:text-[#0984E3]">Helpful Links</span>
                    </a>
                </div>

                <!-- Small Steps Big Dreams Cursive Script Decor (From Desktop Reference) -->
                <div class="pt-4 flex items-center justify-between">
                    <div class="font-handwriting text-2xl text-[#6C5CE7] tracking-wide leading-tight select-none">
                        "Small Steps, Big Dreams"
                    </div>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#6C5CE7] to-[#8C7CFF] text-white flex items-center justify-center shadow-md">
                        <i data-lucide="send" class="w-4 h-4"></i>
                    </div>
                </div>
            </div>

            <!-- Upload CTA Banner (Clay Style) -->
            <div class="rounded-3xl bg-gradient-to-br from-[#6C5CE7] via-[#5641E5] to-[#4536B6] p-6 text-white shadow-[0_20px_40px_-10px_rgba(108,92,231,0.4),0_2px_4px_rgba(255,255,255,0.4)_inset,0_-4px_8px_rgba(0,0,0,0.25)_inset] flex items-center justify-between gap-4">
                <div>
                    <h3 class="font-extrabold text-lg text-white">Share Your Resources</h3>
                    <p class="text-xs text-purple-200 mt-1">Upload verified notes & help fellow RCU students.</p>
                </div>
                <a href="{{ route('upload.create') }}" class="shrink-0 px-5 py-2.5 rounded-full bg-white text-[#6C5CE7] hover:bg-purple-50 font-bold text-xs shadow-md transition-all">
                    Upload Now
                </a>
            </div>

        </div>

    </div>


    <!-- =========================================================================
         4. POPULAR RESOURCES (Matching Mobile Reference Screen 2 & Desktop Grid)
         ========================================================================= -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="clay-bubble clay-bubble-peach w-9 h-9">
                    <i data-lucide="flame" class="w-5 h-5 text-white"></i>
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Popular Resources</h2>
            </div>
            <a href="{{ route('resources.index') }}" class="text-xs sm:text-sm font-bold text-[#6C5CE7] hover:underline flex items-center gap-1">
                <span>See All</span>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($popularResources->take(6) as $res)
                <div class="clay-card p-5 flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="clay-chip text-[11px] font-bold">
                                {{ $res->resourceType->name }}
                            </span>
                            <span class="text-xs font-semibold text-slate-400">
                                {{ number_format($res->downloads_count) }} downloads
                            </span>
                        </div>

                        <div class="flex items-start gap-3 pt-1">
                            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-purple-100 to-indigo-100 text-[#6C5CE7] flex items-center justify-center shrink-0 shadow-xs">
                                <i data-lucide="book-open" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0">
                                <a href="{{ route('resources.show', ['program' => $res->program->slug, 'semester' => $res->semester->slug, 'subject' => $res->subject->slug, 'slug' => $res->slug]) }}" 
                                   class="font-bold text-sm sm:text-base text-slate-900 group-hover:text-[#6C5CE7] transition-colors truncate block">
                                    {{ $res->title }}
                                </a>
                                <p class="text-xs text-slate-400 mt-0.5 truncate">
                                    {{ $res->program->code }} • Semester {{ $res->semester->semester_number }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-3 border-t border-purple-50 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-400">
                            {{ $res->humanFileSize() }}
                        </span>
                        <a href="{{ route('resources.download', $res->id) }}" class="clay-arrow-btn text-[#6C5CE7] hover:bg-[#6C5CE7] hover:text-white" title="Download">
                            <i data-lucide="download" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-400 text-xs">
                    No resources uploaded yet.
                </div>
            @endforelse
        </div>
    </div>


    <!-- =========================================================================
         5. PLATFORM METRICS STATS BAR (Claymorphism Style)
         ========================================================================= -->
    <div class="clay-card p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="grid grid-cols-3 gap-6 sm:gap-12 w-full md:w-auto text-center sm:text-left">
            
            <div class="space-y-1">
                <span class="block font-black text-2xl sm:text-3xl text-slate-900">{{ number_format($totalResources) }}+</span>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Resources</span>
            </div>

            <div class="space-y-1">
                <span class="block font-black text-2xl sm:text-3xl text-[#6C5CE7]">{{ number_format($totalUsers) }}+</span>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Registered Users</span>
            </div>

            <div class="space-y-1">
                <span class="block font-black text-2xl sm:text-3xl text-[#00B894]">{{ number_format($totalDownloads) }}+</span>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Downloads</span>
            </div>

        </div>

        <div class="font-handwriting text-[#A29BFE] text-2xl tracking-wider select-none shrink-0 text-center md:text-right">
            Together for a Better Tomorrow
        </div>
    </div>

</div>
@endsection