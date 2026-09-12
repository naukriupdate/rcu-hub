<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f8f9fa]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'RCU Student Resource Hub — Study Smarter. Find Everything You Need')</title>
    <meta name="description" content="@yield('meta_description', 'Free notes, previous year question papers (PYQs), syllabi, and official notices for Rani Channamma University (RCU) students.')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'RCU Student Resource Hub')">
    <meta property="og:description" content="@yield('meta_description', 'Free academic resources and official notices for RCU students.')">

    <!-- Google Fonts: Inter & Caveat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Caveat:wght@600&display=swap" rel="stylesheet">

    <!-- Animate.css for smooth entrance and interactive animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js for lightweight UI interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <!-- Tailwind CSS with Modern #487FFF Inter Theme Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Inter"', 'system-ui', '-apple-system', '"Segoe UI"', 'Roboto', 'sans-serif'],
                        heading: ['"Inter"', 'sans-serif'],
                        handwriting: ['"Caveat"', 'cursive'],
                    },
                    colors: {
                        /* Modern Theme Palette */
                        blue: {
                            50:  '#E4F1FF',
                            100: '#BFDCFF',
                            200: '#95C7FF',
                            300: '#6BB1FF',
                            400: '#519FFF',
                            500: '#458EFF',
                            600: '#487FFF', // Main primary: #487FFF
                            700: '#486CEA',
                            800: '#4759D6',
                            900: '#4536B6',
                            950: '#1E1B4B',
                        },
                        indigo: {
                            50:  '#E4F1FF',
                            100: '#BFDCFF',
                            500: '#487FFF',
                            600: '#486CEA',
                            700: '#4759D6',
                            800: '#4536B6',
                            900: '#3A28A8',
                            950: '#1E1B4B',
                        },
                        brand: {
                            50:  '#E4F1FF',
                            100: '#BFDCFF',
                            200: '#95C7FF',
                            300: '#6BB1FF',
                            400: '#519FFF',
                            500: '#458EFF',
                            600: '#487FFF',
                            700: '#486CEA',
                            800: '#4759D6',
                            900: '#4536B6',
                            950: '#1E1B4B',
                        },
                        slate: {
                            50:  '#F5F6FA',
                            100: '#ECF1F9',
                            200: '#E6E6E6',
                            300: '#CCCCCC',
                            400: '#999999',
                            500: '#808080',
                            600: '#666666',
                            700: '#4D4D4D',
                            800: '#333333',
                            900: '#1A1A1A',
                            950: '#0D0D0D',
                        },
                        success: {
                            50:  '#F0FDF4',
                            100: '#DCFCE7',
                            200: '#BBF7D0',
                            500: '#22C55E',
                            600: '#16A34A',
                            700: '#15803D',
                            900: '#14532D',
                        },
                        danger: {
                            50:  '#FEF2F2',
                            100: '#FEE2E2',
                            200: '#FECACA',
                            500: '#EF4444',
                            600: '#DC2626',
                            700: '#B91C1C',
                            900: '#7F1D1D',
                        },
                        warning: {
                            50:  '#FEFCE8',
                            100: '#FEF9C3',
                            200: '#FEF08A',
                            500: '#FACC15',
                            600: '#FF9F29',
                            700: '#F39016',
                            900: '#D77907',
                        },
                        purple: {
                            50:  '#dab1fa',
                            100: '#d39efc',
                            600: '#8C01F9',
                        }
                    },
                    boxShadow: {
                        'xs': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
                        'sm': '0px 4px 12px 0px rgba(0, 0, 0, 0.06)',
                        'md': '0px 4px 24px 0px rgba(0, 0, 0, 0.06)',
                        'lg': '0px 8px 24px 0px rgba(0, 0, 0, 0.08)',
                        'xl': '0 24px 24px 0 rgba(0, 0, 0, 0.1)',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #4D4D4D;
            background-color: #F5F6FA;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Inter', sans-serif;
            color: #1A1A1A;
        }
        /* Custom Modern Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #F5F6FA; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 50px; }
        ::-webkit-scrollbar-thumb:hover { background: #487FFF; }
        /* Smooth transitions */
        a, button { transition: all 0.2s linear; }
    </style>
    @stack('styles')
</head>
<body class="flex flex-col min-h-full text-[#4D4D4D] bg-[#F5F6FA] antialiased selection:bg-[#487FFF] selection:text-white pb-16 lg:pb-0">

    <!-- TOP DESKTOP & MOBILE HEADER -->
    <header class="sticky top-0 z-40 bg-white border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Brand Logo -->
                <div class="flex items-center gap-3">
                    <button type="button" id="mobileMenuBtn" class="lg:hidden p-2 -ml-2 text-slate-600 hover:text-blue-600 focus:outline-none">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center text-white shadow-sm shadow-blue-500/20 group-hover:scale-105 transition-transform">
                            <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <span class="font-extrabold text-xl text-slate-900 tracking-tight">RCU</span>
                                <span class="text-sm font-semibold text-slate-600">Student Resource Hub</span>
                            </div>
                            <p class="text-[10px] tracking-wider text-slate-400 font-medium hidden sm:block">Learn • Share • Grow</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Top Nav -->
                <nav class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-3.5 py-1.5 rounded-full text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Home
                    </a>
                    <a href="{{ route('notices.index') }}" class="px-3.5 py-1.5 rounded-full text-sm font-medium transition-colors {{ request()->routeIs('notices.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Notices
                    </a>
                    <a href="{{ route('resources.index') }}" class="px-3.5 py-1.5 rounded-full text-sm font-medium transition-colors {{ request()->routeIs('resources.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Resources
                    </a>
                    <a href="{{ route('courses.index') }}" class="px-3.5 py-1.5 rounded-full text-sm font-medium transition-colors {{ request()->routeIs('courses.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Courses
                    </a>
                    <a href="{{ route('upload.create') }}" class="px-3.5 py-1.5 rounded-full text-sm font-medium transition-colors {{ request()->routeIs('upload.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Upload
                    </a>
                    <a href="{{ route('links.index') }}" class="px-3.5 py-1.5 rounded-full text-sm font-medium transition-colors {{ request()->routeIs('links.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Important Links
                    </a>
                    <a href="{{ route('about') }}" class="px-3.5 py-1.5 rounded-full text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        About
                    </a>
                    <a href="{{ route('contact') }}" class="px-3.5 py-1.5 rounded-full text-sm font-medium transition-colors {{ request()->routeIs('contact') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Contact
                    </a>
                </nav>

                <!-- Right Nav Elements: Search icon, Notifications, User Menu / Login -->
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('resources.index') }}" class="p-2 text-slate-500 hover:text-blue-600 hover:bg-slate-100 rounded-lg transition-colors" title="Search resources">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </a>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-lg transition-colors">
                                <i data-lucide="shield" class="w-3.5 h-3.5"></i>
                                Admin Panel
                            </a>
                        @endif

                        <!-- User Profile Dropdown -->
                        <div class="relative group">
                            <button type="button" class="flex items-center gap-2 p-1.5 rounded-full hover:bg-slate-100 text-slate-700 transition-colors focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-xs">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                                <span class="hidden md:inline text-sm font-medium text-slate-800">{{ auth()->user()->name }}</span>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 hidden md:inline"></i>
                            </button>
                            <div class="absolute right-0 mt-1 w-56 bg-white rounded-xl shadow-lg border border-slate-100 py-2 hidden group-hover:block hover:block z-50">
                                <div class="px-4 py-2 border-b border-slate-100">
                                    <p class="text-xs text-slate-500">Signed in as</p>
                                    <p class="text-sm font-semibold text-slate-900 truncate">{{ auth()->user()->email }}</p>
                                    <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-semibold rounded-full {{ auth()->user()->isAdmin() ? 'bg-amber-100 text-amber-800' : (auth()->user()->isVerifiedTeacher() ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800') }}">
                                        {{ auth()->user()->isAdmin() ? 'Admin' : (auth()->user()->isVerifiedTeacher() ? '🏅 Verified Teacher' : ucfirst(auth()->user()->role)) }}
                                    </span>
                                </div>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-blue-700 bg-blue-50/50 hover:bg-blue-100/50 font-bold border-b border-slate-100">
                                        <i data-lucide="shield" class="w-4 h-4 text-blue-600"></i> Admin Panel
                                    </a>
                                @endif
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                    <i data-lucide="user" class="w-4 h-4 text-slate-400"></i> My Account
                                </a>
                                <a href="{{ route('dashboard.my-uploads') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                    <i data-lucide="folder" class="w-4 h-4 text-slate-400"></i> My Uploads
                                </a>
                                <a href="{{ route('upload.create') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                    <i data-lucide="upload-cloud" class="w-4 h-4 text-slate-400"></i> Upload Resource
                                </a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 font-medium">
                                        <i data-lucide="log-out" class="w-4 h-4 text-rose-500"></i> Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 hover:bg-slate-100 rounded-lg transition-colors">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-xs shadow-blue-500/20 transition-all">
                                Register
                            </a>
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </header>

    <!-- SLIDE-OUT MOBILE DRAWER (Screen 8 from Reference Image 1) -->
    <div id="mobileDrawerBackdrop" class="fixed inset-0 bg-slate-900/60 z-50 hidden transition-opacity"></div>
    <aside id="mobileDrawer" class="fixed inset-y-0 left-0 w-80 max-w-full bg-white z-50 shadow-2xl transform -translate-x-full transition-transform duration-300 flex flex-col justify-between">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold">
                    <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="font-bold text-slate-900 text-base">RCU</h2>
                    <p class="text-[11px] text-slate-500">Student Resource Hub</p>
                </div>
            </div>
            <button id="closeMobileDrawerBtn" class="p-1.5 text-slate-400 hover:text-slate-700 rounded-lg">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-1">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3.5 py-2.5 text-sm font-medium rounded-xl {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-100' }}">
                <i data-lucide="home" class="w-4 h-4"></i> Home
            </a>
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 text-sm font-bold rounded-xl bg-blue-50 text-blue-700 border border-blue-200">
                    <i data-lucide="shield" class="w-4 h-4 text-blue-600"></i> Admin Panel
                </a>
            @endif
            <a href="{{ route('notices.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 text-sm font-medium rounded-xl {{ request()->routeIs('notices.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-100' }}">
                <i data-lucide="bell" class="w-4 h-4"></i> Notices
            </a>
            
            <!-- Collapsible Resources -->
            <div>
                <a href="{{ route('resources.index') }}" class="flex items-center justify-between px-3.5 py-2.5 text-sm font-medium rounded-xl text-slate-700 hover:bg-slate-100">
                    <span class="flex items-center gap-3">
                        <i data-lucide="book-open" class="w-4 h-4"></i> Resources
                    </span>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                </a>
                <div class="pl-10 pr-3 py-1 space-y-1 text-xs text-slate-600">
                    <a href="{{ route('resources.index', ['type' => 'notes']) }}" class="block py-1 hover:text-blue-600">• Notes</a>
                    <a href="{{ route('resources.index', ['type' => 'pyq']) }}" class="block py-1 hover:text-blue-600">• Previous Year Papers</a>
                    <a href="{{ route('resources.index', ['type' => 'question-banks']) }}" class="block py-1 hover:text-blue-600">• Question Banks</a>
                    <a href="{{ route('resources.index', ['type' => 'syllabus']) }}" class="block py-1 hover:text-blue-600">• Syllabus</a>
                    <a href="{{ route('resources.index', ['type' => 'assignments']) }}" class="block py-1 hover:text-blue-600">• Assignments</a>
                </div>
            </div>

            <!-- Collapsible Courses -->
            <div>
                <a href="{{ route('courses.index') }}" class="flex items-center justify-between px-3.5 py-2.5 text-sm font-medium rounded-xl text-slate-700 hover:bg-slate-100">
                    <span class="flex items-center gap-3">
                        <i data-lucide="layout-grid" class="w-4 h-4"></i> Courses
                    </span>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                </a>
                <div class="pl-10 pr-3 py-1 space-y-1 text-xs text-slate-600">
                    <a href="{{ route('resources.index', ['course' => 'bca']) }}" class="block py-1 hover:text-blue-600">• BCA</a>
                    <a href="{{ route('resources.index', ['course' => 'bba']) }}" class="block py-1 hover:text-blue-600">• BBA</a>
                    <a href="{{ route('resources.index', ['course' => 'ba']) }}" class="block py-1 hover:text-blue-600">• BA</a>
                    <a href="{{ route('resources.index', ['course' => 'bsc']) }}" class="block py-1 hover:text-blue-600">• B.Sc</a>
                </div>
            </div>

            <a href="{{ route('upload.create') }}" class="flex items-center gap-3 px-3.5 py-2.5 text-sm font-medium rounded-xl text-slate-700 hover:bg-slate-100">
                <i data-lucide="upload-cloud" class="w-4 h-4"></i> Upload Resource
            </a>
            <a href="{{ route('links.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 text-sm font-medium rounded-xl text-slate-700 hover:bg-slate-100">
                <i data-lucide="link" class="w-4 h-4"></i> Important Links
            </a>
            <a href="{{ route('about') }}" class="flex items-center gap-3 px-3.5 py-2.5 text-sm font-medium rounded-xl text-slate-700 hover:bg-slate-100">
                <i data-lucide="info" class="w-4 h-4"></i> About Us
            </a>
            <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3.5 py-2.5 text-sm font-medium rounded-xl text-slate-700 hover:bg-slate-100">
                <i data-lucide="phone" class="w-4 h-4"></i> Contact
            </a>
        </div>

        <!-- Drawer Footer with Social Icons -->
        <div class="p-5 bg-slate-900 text-white text-xs">
            <p class="font-bold text-slate-200">RCU Student Resource Hub</p>
            <p class="text-[11px] text-slate-400 mt-0.5">Not affiliated with RCU. For student use only.</p>
            <div class="flex items-center gap-4 mt-4 text-slate-400">
                <a href="#" class="hover:text-white"><i data-lucide="facebook" class="w-4 h-4"></i></a>
                <a href="#" class="hover:text-white"><i data-lucide="send" class="w-4 h-4"></i></a>
                <a href="#" class="hover:text-white"><i data-lucide="message-circle" class="w-4 h-4"></i></a>
                <a href="#" class="hover:text-white"><i data-lucide="instagram" class="w-4 h-4"></i></a>
            </div>
        </div>
    </aside>

    <!-- FLASH MESSAGES -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 shadow-xs">
                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                <div class="flex-1 text-sm font-medium">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    @if(session('error') || $errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-3 shadow-xs">
                <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5"></i>
                <div class="flex-1 text-sm">
                    @if(session('error'))
                        <div class="font-medium">{{ session('error') }}</div>
                    @endif
                    @if($errors->any())
                        <ul class="list-disc list-inside mt-1 space-y-0.5 text-xs">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- MAIN BODY CONTENT -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Brand col -->
                <div class="md:col-span-1 space-y-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold">
                            <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                        </div>
                        <span class="font-bold text-lg text-slate-900">RCU Hub</span>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        An independent, open community platform built for Ramchandra Chandravanshi University (RCU) students and teachers to collaborate, discover study materials, and access latest notices.
                    </p>
                </div>

                <!-- Academic -->
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-3">Academic Programs</h3>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="{{ route('resources.index', ['course' => 'bca']) }}" class="hover:text-blue-600">BCA Notes & PYQs</a></li>
                        <li><a href="{{ route('resources.index', ['course' => 'bba']) }}" class="hover:text-blue-600">BBA Resources</a></li>
                        <li><a href="{{ route('resources.index', ['course' => 'ba']) }}" class="hover:text-blue-600">BA Materials</a></li>
                        <li><a href="{{ route('resources.index', ['course' => 'bsc']) }}" class="hover:text-blue-600">B.Sc Question Papers</a></li>
                    </ul>
                </div>

                <!-- Official Portal Links -->
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-3">Official Portals</h3>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="https://www.rcu.edu.in/" target="_blank" rel="noopener" class="hover:text-blue-600 flex items-center gap-1.5">RCU Official Website <i data-lucide="external-link" class="w-3 h-3 text-slate-400"></i></a></li>
                        <li><a href="{{ route('notices.index') }}" class="hover:text-blue-600">Official RCU Notices</a></li>
                        <li><a href="{{ route('links.index') }}" class="hover:text-blue-600">Important Portals Directory</a></li>
                        <li><a href="{{ route('upload.create') }}" class="hover:text-blue-600">Contribute Material</a></li>
                    </ul>
                </div>

                <!-- Legal / Safety -->
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-3">Legal & Support</h3>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="{{ route('about') }}" class="hover:text-blue-600">About RCU Hub</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-blue-600">Contact Us</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-blue-600">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-blue-600">Terms & Conditions</a></li>
                        <li><a href="{{ route('disclaimer') }}" class="hover:text-blue-600">Disclaimer</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} RCU Student Resource Hub. Independent student resource portal.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('disclaimer') }}" class="hover:text-slate-800">Not Affiliated with RCU</a>
                    <a href="{{ route('admin.login') }}" class="hover:text-blue-600">Admin Login</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- MOBILE BOTTOM NAVIGATION BAR (Fixed at bottom on mobile, matches Screen 1 from Reference Image 1) -->
    <nav class="lg:hidden fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-md border-t border-slate-200 z-40 py-2 px-3 flex items-center justify-around shadow-lg">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 text-xs {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : 'text-slate-500 hover:text-slate-900' }}">
            <i data-lucide="home" class="w-5 h-5"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('resources.index') }}" class="flex flex-col items-center gap-1 text-xs {{ request()->routeIs('resources.*') ? 'text-blue-600 font-semibold' : 'text-slate-500 hover:text-slate-900' }}">
            <i data-lucide="book-open" class="w-5 h-5"></i>
            <span>Resources</span>
        </a>
        <a href="{{ route('upload.create') }}" class="flex flex-col items-center gap-1 text-xs {{ request()->routeIs('upload.*') ? 'text-blue-600 font-semibold' : 'text-slate-500 hover:text-slate-900' }}">
            <div class="w-9 h-9 -mt-3 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-500/30">
                <i data-lucide="upload" class="w-5 h-5"></i>
            </div>
            <span>Upload</span>
        </a>
        <a href="{{ route('notices.index') }}" class="flex flex-col items-center gap-1 text-xs {{ request()->routeIs('notices.*') ? 'text-blue-600 font-semibold' : 'text-slate-500 hover:text-slate-900' }}">
            <i data-lucide="bell" class="w-5 h-5"></i>
            <span>Notices</span>
        </a>
        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="flex flex-col items-center gap-1 text-xs {{ request()->routeIs('dashboard*') || request()->routeIs('login') ? 'text-blue-600 font-semibold' : 'text-slate-500 hover:text-slate-900' }}">
            <i data-lucide="user" class="w-5 h-5"></i>
            <span>{{ auth()->check() ? 'Profile' : 'Login' }}</span>
        </a>
    </nav>

    <!-- Scripts -->
    <script>
        // Initialize Lucide Icons
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        // Mobile drawer toggles
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeMobileDrawerBtn = document.getElementById('closeMobileDrawerBtn');
        const mobileDrawer = document.getElementById('mobileDrawer');
        const mobileDrawerBackdrop = document.getElementById('mobileDrawerBackdrop');

        function toggleDrawer(show) {
            if (show) {
                mobileDrawerBackdrop.classList.remove('hidden');
                mobileDrawer.classList.remove('-translate-x-full');
            } else {
                mobileDrawerBackdrop.classList.add('hidden');
                mobileDrawer.classList.add('-translate-x-full');
            }
        }

        if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', () => toggleDrawer(true));
        if (closeMobileDrawerBtn) closeMobileDrawerBtn.addEventListener('click', () => toggleDrawer(false));
        if (mobileDrawerBackdrop) mobileDrawerBackdrop.addEventListener('click', () => toggleDrawer(false));
    </script>
    @stack('scripts')
</body>
</html>
