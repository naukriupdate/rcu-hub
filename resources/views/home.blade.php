@extends('layouts.app')

@section('title', 'RCU Student Resource Hub — Study Smarter. Find Everything You Need')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-8">

            <!-- HERO BANNER -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-950 via-blue-950 to-blue-900 text-white shadow-md border border-slate-800">

                <!-- Campus panorama as full hero background, all breakpoints, with fade overlays for legibility -->
                <div class="absolute inset-0 pointer-events-none overflow-hidden">
                    <img src="{{ asset('images/college-hero.jpg') }}"
                         alt="RCU Campus"
                         class="w-full h-full object-cover object-center opacity-90">

                    <!-- Mobile ONLY: single top-to-bottom fade, image stays clearly visible, text sits on the darker bottom half -->
                    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/35 via-slate-950/55 to-slate-950/90 md:hidden"></div>

                    <!-- Desktop ONLY: left-to-right fade so left-aligned text stays readable while photo shows through on the right -->
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/55 to-transparent hidden md:block"></div>
                </div>

                <div class="relative z-10 p-6 sm:p-10 lg:py-12 lg:px-12 flex flex-col md:flex-row items-center justify-between gap-8">
                    
                    <div class="max-w-xl space-y-4 text-center md:text-left">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-xs font-semibold backdrop-blur-xs border border-blue-400/20">
                            <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                            Your Study Partner
                        </div>
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white leading-tight">
                            RCU Student Resource Hub
                        </h1>
                        <p class="text-slate-300 text-xs sm:text-sm leading-relaxed max-w-lg">
                            Your one-stop platform for notes, papers, syllabus, previous year questions and latest updates. Build your future with better resources.
                        </p>

                        <!-- Search Form with Button -->
                        <form action="{{ route('resources.index') }}" method="GET" class="mt-4">
                            <div class="relative flex items-center bg-white rounded-xl p-1.5 shadow-xl text-slate-900">
                                <div class="pl-3 text-slate-400">
                                    <i data-lucide="search" class="w-5 h-5"></i>
                                </div>
                                <input type="text" name="q" placeholder="Search notes, papers, syllabus, subjects, or anything..." 
                                    class="w-full bg-transparent border-0 px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-0">
                                <button type="submit" class="shrink-0 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm rounded-lg shadow-xs transition-all">
                                    Search
                                </button>
                            </div>
                        </form>

                        <!-- Popular Searches Chips -->
                        <div class="flex flex-wrap items-center gap-1.5 pt-1 text-xs text-slate-300">
                            <span class="text-slate-400 font-medium">Popular searches:</span>
                            <a href="{{ route('resources.index', ['course' => 'bca']) }}" class="px-2.5 py-0.5 rounded-md bg-white/10 hover:bg-white/20 text-slate-200 transition-colors">BCA</a>
                            <a href="{{ route('resources.index', ['q' => 'Java']) }}" class="px-2.5 py-0.5 rounded-md bg-white/10 hover:bg-white/20 text-slate-200 transition-colors">Java</a>
                            <a href="{{ route('resources.index', ['type' => 'pyq']) }}" class="px-2.5 py-0.5 rounded-md bg-white/10 hover:bg-white/20 text-slate-200 transition-colors">PYQ</a>
                            <a href="{{ route('resources.index', ['q' => 'DBMS']) }}" class="px-2.5 py-0.5 rounded-md bg-white/10 hover:bg-white/20 text-slate-200 transition-colors">DBMS</a>
                            <a href="{{ route('resources.index', ['type' => 'syllabus']) }}" class="px-2.5 py-0.5 rounded-md bg-white/10 hover:bg-white/20 text-slate-200 transition-colors">Syllabus</a>
                            <a href="{{ route('resources.index', ['type' => 'notes']) }}" class="px-2.5 py-0.5 rounded-md bg-white/10 hover:bg-white/20 text-slate-200 transition-colors">Notes</a>
                        </div>
                    </div>

                    <!-- Right-side spacer column keeps text column width/wrap identical to before on desktop, now that the photo lives full-bleed behind the whole banner -->
                    <div class="hidden md:block shrink-0 w-64 lg:w-72" aria-hidden="true"></div>

                </div>
            </div>

            <!-- BROWSE BY COURSE (MOBILE PASTEL CARDS from Screen 1 of Mobile Reference Image) -->
            <div class="block lg:hidden space-y-3">
                <div class="flex items-center justify-between">
                    <h2 class="font-bold text-slate-900 text-base">Browse by Course</h2>
                    <a href="{{ route('courses.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">View All</a>
                </div>
                <div class="grid grid-cols-4 gap-2.5">
                    <a href="{{ route('resources.index', ['course' => 'bca']) }}" class="bg-blue-50/80 border border-blue-100 rounded-2xl p-3 text-center flex flex-col items-center justify-center gap-1.5 shadow-2xs hover:bg-blue-100 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center">
                            <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                        </div>
                        <span class="font-bold text-xs text-blue-900">BCA</span>
                    </a>
                    <a href="{{ route('resources.index', ['course' => 'bba']) }}" class="bg-emerald-50/80 border border-emerald-100 rounded-2xl p-3 text-center flex flex-col items-center justify-center gap-1.5 shadow-2xs hover:bg-emerald-100 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center">
                            <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                        </div>
                        <span class="font-bold text-xs text-emerald-900">BBA</span>
                    </a>
                    <a href="{{ route('resources.index', ['course' => 'ba']) }}" class="bg-amber-50/80 border border-amber-100 rounded-2xl p-3 text-center flex flex-col items-center justify-center gap-1.5 shadow-2xs hover:bg-amber-100 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-amber-500 text-white flex items-center justify-center">
                            <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                        </div>
                        <span class="font-bold text-xs text-amber-900">BA</span>
                    </a>
                    <a href="{{ route('resources.index', ['course' => 'bsc']) }}" class="bg-purple-50/80 border border-purple-100 rounded-2xl p-3 text-center flex flex-col items-center justify-center gap-1.5 shadow-2xs hover:bg-purple-100 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-purple-500 text-white flex items-center justify-center">
                            <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                        </div>
                        <span class="font-bold text-xs text-purple-900">B.Sc</span>
                    </a>
                </div>
            </div>

            <!-- TOP 5 RESOURCE CATEGORY CARDS -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3.5">
                
                <!-- Notes (Royal Blue) -->
                <a href="{{ route('resources.index', ['type' => 'notes']) }}" class="group bg-white rounded-2xl p-4 border border-slate-200/80 hover:border-blue-300 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-sm">Notes</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5">Study materials & notes</p>
                    <div class="mt-3 flex items-center text-xs font-semibold text-blue-600 gap-1 group-hover:translate-x-0.5 transition-transform">
                        View <span>&rarr;</span>
                    </div>
                </a>

                <!-- Previous Year Papers (Emerald Green) -->
                <a href="{{ route('resources.index', ['type' => 'pyq']) }}" class="group bg-white rounded-2xl p-4 border border-slate-200/80 hover:border-emerald-300 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i data-lucide="file-check" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-sm">Previous Year Papers</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5">PYQs & model papers</p>
                    <div class="mt-3 flex items-center text-xs font-semibold text-emerald-600 gap-1 group-hover:translate-x-0.5 transition-transform">
                        View <span>&rarr;</span>
                    </div>
                </a>

                <!-- Syllabus (Purple) -->
                <a href="{{ route('resources.index', ['type' => 'syllabus']) }}" class="group bg-white rounded-2xl p-4 border border-slate-200/80 hover:border-purple-300 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-sm">Syllabus</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5">Course-wise syllabus</p>
                    <div class="mt-3 flex items-center text-xs font-semibold text-purple-600 gap-1 group-hover:translate-x-0.5 transition-transform">
                        View <span>&rarr;</span>
                    </div>
                </a>

                <!-- Assignments (Amber/Orange) -->
                <a href="{{ route('resources.index', ['type' => 'assignments']) }}" class="group bg-white rounded-2xl p-4 border border-slate-200/80 hover:border-amber-300 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-sm">Assignments</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5">Assignments & projects</p>
                    <div class="mt-3 flex items-center text-xs font-semibold text-amber-600 gap-1 group-hover:translate-x-0.5 transition-transform">
                        View <span>&rarr;</span>
                    </div>
                </a>

                <!-- Question Banks (Cyan/Teal) -->
                <a href="{{ route('resources.index', ['type' => 'question-banks']) }}" class="group bg-white rounded-2xl p-4 border border-slate-200/80 hover:border-teal-300 hover:shadow-md transition-all col-span-2 sm:col-span-1">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i data-lucide="help-circle" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-sm">Question Banks</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5">Subject-wise questions</p>
                    <div class="mt-3 flex items-center text-xs font-semibold text-teal-600 gap-1 group-hover:translate-x-0.5 transition-transform">
                        View <span>&rarr;</span>
                    </div>
                </a>

            </div>

            <!-- THREE-COLUMN MID SECTION -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

<!-- COLUMN 2: Popular Resources (lg:col-span-4) -->
                <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <i data-lucide="flame" class="w-5 h-5 text-amber-500"></i>
                                <h2 class="font-bold text-slate-900 text-base">Popular Resources</h2>
                            </div>
                            <a href="{{ route('resources.index') }}" class="text-xs font-semibold text-blue-600 hover:underline flex items-center gap-1">
                                View All <span>&rarr;</span>
                            </a>
                        </div>

                        <div class="divide-y divide-slate-100">
                            @forelse($popularResources as $res)
                                <div class="py-3 flex items-center justify-between gap-3 group">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <!-- Red PDF icon matching screenshot -->
                                        <div class="w-9 h-9 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-2xs">
                                            <i data-lucide="file-text" class="w-5 h-5"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <a href="{{ route('resources.show', ['program' => $res->program->slug, 'semester' => $res->semester->slug, 'subject' => $res->subject->slug, 'slug' => $res->slug]) }}" 
                                               class="text-sm font-semibold text-slate-900 hover:text-blue-600 truncate block">
                                                {{ $res->title }}
                                            </a>
                                            <p class="text-[11px] text-slate-400 truncate">
                                                {{ $res->program->code }} • Sem {{ $res->semester->semester_number }} • {{ $res->resourceType->name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 shrink-0">
                                        <span class="text-xs font-semibold text-slate-500">
                                            {{ $res->downloads_count >= 1000 ? round($res->downloads_count / 1000, 1) . 'k' : $res->downloads_count }} downloads
                                        </span>
                                        <a href="{{ route('resources.download', $res->id) }}" 
                                           class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Download">
                                            <i data-lucide="download" class="w-4 h-4"></i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="py-8 text-center text-slate-400 text-xs">
                                    No resources uploaded yet.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- COLUMN 1: Latest RCU Notices (lg:col-span-5) -->
                <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <i data-lucide="megaphone" class="w-5 h-5 text-blue-600"></i>
                                <h2 class="font-bold text-slate-900 text-base">Latest RCU Notices</h2>
                            </div>
                            <a href="{{ route('notices.index') }}" class="text-xs font-semibold text-blue-600 hover:underline flex items-center gap-1">
                                View All <span>&rarr;</span>
                            </a>
                        </div>

                        <div class="divide-y divide-slate-100">
                            @forelse($latestNotices as $notice)
                                <a href="{{ route('notices.show', $notice->slug) }}" class="py-3.5 flex items-start gap-3 group hover:bg-slate-50/80 -mx-2 px-2 rounded-xl transition-colors">
                                    <!-- Date badge on left -->
                                    <div class="shrink-0 w-12 text-center bg-slate-100 rounded-xl p-1.5 group-hover:bg-blue-50 transition-colors">
                                        <span class="block text-xs font-extrabold text-slate-900 group-hover:text-blue-600">
                                            {{ $notice->published_at ? $notice->published_at->format('d') : '01' }}
                                        </span>
                                        <span class="block text-[10px] text-slate-500 uppercase font-medium">
                                            {{ $notice->published_at ? $notice->published_at->format('M') : 'Jan' }}
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            @if($notice->is_new)
                                                <span class="px-1.5 py-0.2 rounded bg-rose-500 text-white text-[9px] font-extrabold tracking-wider uppercase shrink-0">
                                                    NEW
                                                </span>
                                            @endif
                                            <h4 class="text-sm font-semibold text-slate-900 group-hover:text-blue-600 truncate">
                                                {{ $notice->title }}
                                            </h4>
                                        </div>
                                        <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">
                                            {{ $notice->excerpt ?: 'Official circular from RCU portal...' }}
                                        </p>
                                    </div>
                                    <span class="shrink-0 text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                        RCU Official
                                    </span>
                                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-blue-500 shrink-0 mt-1"></i>
                                </a>
                            @empty
                                <div class="py-8 text-center text-slate-400 text-xs">
                                    No official notices published yet.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                

                <!-- COLUMN 3: RCU Updates (REST API) + Access Features + Quick Links (lg:col-span-3) -->
                <div class="lg:col-span-3 space-y-4">
                    
                    <!-- RCU Official Updates Card with Interactive Tabs -->
                    <div x-data="{ activeTab: 'latest' }" class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-2xs">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="refresh-cw" class="w-4 h-4 text-blue-600"></i>
                                <h3 class="font-bold text-slate-900 text-xs">RCU Official Updates</h3>
                            </div>
                            <span class="text-[10px] text-slate-400">via REST API</span>
                        </div>

                        <!-- Category Filter Pills -->
                        <div class="flex items-center gap-1.5 py-2.5 overflow-x-auto text-[11px]">
                            <button type="button" @click="activeTab = 'latest'" 
                                    :class="activeTab === 'latest' ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-500 hover:bg-slate-100'"
                                    class="px-2.5 py-0.5 rounded-full transition-colors">
                                Latest
                            </button>
                            <button type="button" @click="activeTab = 'exams'" 
                                    :class="activeTab === 'exams' ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-500 hover:bg-slate-100'"
                                    class="px-2.5 py-0.5 rounded-full transition-colors">
                                Exams
                            </button>
                            <button type="button" @click="activeTab = 'results'" 
                                    :class="activeTab === 'results' ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-500 hover:bg-slate-100'"
                                    class="px-2.5 py-0.5 rounded-full transition-colors">
                                Results
                            </button>
                            <button type="button" @click="activeTab = 'others'" 
                                    :class="activeTab === 'others' ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-500 hover:bg-slate-100'"
                                    class="px-2.5 py-0.5 rounded-full transition-colors">
                                Others
                            </button>
                        </div>

                        <!-- Mini Feed: Latest -->
                        <div x-show="activeTab === 'latest'" class="divide-y divide-slate-100 text-xs space-y-1">
                            @forelse($latestNotices->take(4) as $not)
                                <a href="{{ route('notices.show', $not->slug) }}" class="py-2 block group">
                                    <div class="flex items-center gap-1.5">
                                        @if($not->is_new)
                                            <span class="px-1 py-0.2 rounded bg-rose-500 text-white text-[8px] font-bold uppercase shrink-0">NEW</span>
                                        @endif
                                        <p class="font-semibold text-slate-800 group-hover:text-blue-600 truncate">{{ $not->title }}</p>
                                    </div>
                                    <p class="text-[10px] text-slate-400 mt-0.5">{{ $not->published_at ? $not->published_at->format('d M Y') : 'Recent' }}</p>
                                </a>
                            @empty
                                <p class="py-4 text-center text-slate-400 text-xs">No recent updates.</p>
                            @endforelse
                        </div>

                        <!-- Mini Feed: Exams -->
                        <div x-show="activeTab === 'exams'" x-cloak class="divide-y divide-slate-100 text-xs space-y-1">
                            @forelse($examNotices->take(4) as $not)
                                <a href="{{ route('notices.show', $not->slug) }}" class="py-2 block group">
                                    <p class="font-semibold text-slate-800 group-hover:text-blue-600 truncate">{{ $not->title }}</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">{{ $not->published_at ? $not->published_at->format('d M Y') : 'Recent' }}</p>
                                </a>
                            @empty
                                <p class="py-4 text-center text-slate-400 text-xs">No examination notices currently.</p>
                            @endforelse
                        </div>

                        <!-- Mini Feed: Results -->
                        <div x-show="activeTab === 'results'" x-cloak class="divide-y divide-slate-100 text-xs space-y-1">
                            @forelse($resultNotices->take(4) as $not)
                                <a href="{{ route('notices.show', $not->slug) }}" class="py-2 block group">
                                    <p class="font-semibold text-slate-800 group-hover:text-blue-600 truncate">{{ $not->title }}</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">{{ $not->published_at ? $not->published_at->format('d M Y') : 'Recent' }}</p>
                                </a>
                            @empty
                                <div class="py-3 text-center text-slate-400 text-[11px] space-y-1">
                                    <p>No result circulars currently published.</p>
                                    <a href="https://www.rcu.edu.in/" target="_blank" rel="noopener" class="text-blue-600 font-semibold hover:underline block">Check rcu.edu.in &rarr;</a>
                                </div>
                            @endforelse
                        </div>

                        <!-- Mini Feed: Others -->
                        <div x-show="activeTab === 'others'" x-cloak class="divide-y divide-slate-100 text-xs space-y-1">
                            @forelse($otherNotices->take(4) as $not)
                                <a href="{{ route('notices.show', $not->slug) }}" class="py-2 block group">
                                    <p class="font-semibold text-slate-800 group-hover:text-blue-600 truncate">{{ $not->title }}</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">{{ $not->published_at ? $not->published_at->format('d M Y') : 'Recent' }}</p>
                                </a>
                            @empty
                                <p class="py-4 text-center text-slate-400 text-xs">No general notices currently.</p>
                            @endforelse
                        </div>

                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                            <a href="https://www.rcu.edu.in/" target="_blank" rel="noopener" class="hover:text-blue-600 flex items-center gap-1">
                                Source: rcu.edu.in <i data-lucide="external-link" class="w-3 h-3"></i>
                            </a>
                            <a href="{{ route('notices.index') }}" class="text-blue-600 hover:underline font-medium">View All</a>
                        </div>
                    </div>

                    <!-- "Access more features" Card -->
                    @guest
                        <div class="bg-gradient-to-br from-blue-50/70 to-indigo-50/70 rounded-2xl border border-blue-100 p-4 shadow-2xs text-center space-y-2">
                            <div class="w-9 h-9 mx-auto rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                <i data-lucide="user-plus" class="w-4 h-4"></i>
                            </div>
                            <h4 class="font-bold text-slate-900 text-xs">Access more features</h4>
                            <p class="text-[11px] text-slate-500 leading-tight">
                                Create an account to upload resources, bookmark and track your downloads.
                            </p>
                            <a href="{{ route('register') }}" class="inline-block w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-xs transition-all">
                                Login / Register
                            </a>
                        </div>
                    @endguest

                    <!-- Quick Links List -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-2xs space-y-2">
                        <div class="flex items-center gap-1.5 pb-2 border-b border-slate-100">
                            <i data-lucide="link" class="w-3.5 h-3.5 text-slate-500"></i>
                            <h3 class="font-bold text-slate-900 text-xs">Quick Links</h3>
                        </div>
                        <ul class="space-y-1.5 text-xs text-slate-600">
                            @foreach($quickLinks as $link)
                                <li>
                                    <a href="{{ $link->url }}" target="_blank" rel="noopener" class="flex items-center justify-between hover:text-blue-600 py-0.5">
                                        <span class="truncate">{{ $link->title }}</span>
                                        <i data-lucide="external-link" class="w-3 h-3 text-slate-400 shrink-0"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>

            <!-- BOTTOM UPLOAD CTA BANNER -->
            <div class="rounded-2xl bg-gradient-to-r from-emerald-600 via-emerald-700 to-teal-700 text-white p-6 sm:p-8 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4 text-center sm:text-left">
                    <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-xs flex items-center justify-center shrink-0 border border-white/20">
                        <i data-lucide="upload-cloud" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-white">Upload a Resource</h3>
                        <p class="text-xs sm:text-sm text-emerald-100 mt-0.5">
                            Help fellow students by sharing your notes, papers, or study material.
                        </p>
                    </div>
                </div>
                <a href="{{ route('upload.create') }}" class="shrink-0 px-6 py-3 bg-emerald-950/40 hover:bg-emerald-950/60 border border-white/20 text-white font-semibold text-xs sm:text-sm rounded-xl shadow-xs transition-all flex items-center gap-2">
                    Upload Now
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- FOOTER STATS BAR -->
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex flex-wrap items-center justify-around sm:justify-start gap-8 w-full md:w-auto">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <i data-lucide="book" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="block font-extrabold text-slate-900 text-base leading-none">{{ number_format($totalResources) }}+</span>
                            <span class="text-[11px] text-slate-400 font-medium">Total Resources</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <i data-lucide="users" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="block font-extrabold text-slate-900 text-base leading-none">{{ number_format($totalUsers) }}+</span>
                            <span class="text-[11px] text-slate-400 font-medium">Registered Users</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <i data-lucide="download-cloud" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="block font-extrabold text-slate-900 text-base leading-none">{{ number_format($totalDownloads) }}+</span>
                            <span class="text-[11px] text-slate-400 font-medium">Total Downloads</span>
                        </div>
                    </div>
                </div>

                <!-- Cursive Brand Signature Script -->
                <div class="font-handwriting text-slate-400 text-xl tracking-wider select-none shrink-0">
                    RCU Student Resource Hub
                </div>
            </div>

</div>
@endsection