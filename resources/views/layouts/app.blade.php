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

    <!-- Tailwind CSS with Claymorphism Theme Config -->
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
                        clay: {
                            bg: '#F5F3FF',
                            canvas: '#FAF8FF',
                            purple: '#6C5CE7',
                            'purple-dark': '#5641E5',
                            'purple-light': '#8C7CFF',
                            lavender: '#E8E4FD',
                            'lavender-light': '#F1EFFF',
                            mint: '#00B894',
                            'mint-light': '#E3FAF3',
                            peach: '#FF7675',
                            'peach-light': '#FFEFEF',
                            coral: '#FD79A8',
                            orange: '#FF9F43',
                            'orange-light': '#FFF3E8',
                            blue: '#0984E3',
                            'blue-light': '#E4F2FD',
                            yellow: '#FDCB6E',
                            'yellow-light': '#FEF9E7',
                            text: '#2D3436',
                            muted: '#636E72',
                            subtle: '#A29BFE'
                        }
                    },
                    borderRadius: {
                        '3xl': '1.75rem',
                        '4xl': '2.25rem',
                        '5xl': '2.75rem'
                    },
                    boxShadow: {
                        'clay-card': '0 20px 40px -15px rgba(108, 92, 231, 0.08), 0 0 0 1px rgba(255, 255, 255, 0.9) inset, 0 -6px 12px -2px rgba(162, 155, 254, 0.12) inset, 0 10px 25px -5px rgba(0, 0, 0, 0.04)',
                        'clay-card-hover': '0 25px 50px -12px rgba(108, 92, 231, 0.16), 0 0 0 1px rgba(255, 255, 255, 1) inset, 0 -8px 16px -2px rgba(162, 155, 254, 0.18) inset, 0 15px 30px -5px rgba(0, 0, 0, 0.06)',
                        'clay-btn-primary': '0 10px 25px -5px rgba(108, 92, 231, 0.45), 0 2px 4px rgba(255, 255, 255, 0.4) inset, 0 -3px 6px rgba(0, 0, 0, 0.2) inset',
                        'clay-btn-hover': '0 14px 30px -4px rgba(108, 92, 231, 0.55), 0 2px 4px rgba(255, 255, 255, 0.5) inset, 0 -4px 8px rgba(0, 0, 0, 0.25) inset',
                        'clay-input': '0 3px 8px rgba(108, 92, 231, 0.06) inset, 0 1px 2px rgba(0, 0, 0, 0.04) inset, 0 8px 20px rgba(108, 92, 231, 0.04)',
                        'clay-bubble': '0 12px 24px -6px rgba(108, 92, 231, 0.22), 0 -4px 8px rgba(0, 0, 0, 0.08) inset, 0 3px 6px rgba(255, 255, 255, 0.6) inset',
                        'clay-float': '0 25px 50px -12px rgba(108, 92, 231, 0.25)'
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        
        /* Claymorphism Base Styling */
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #2D3436;
            background: linear-gradient(135deg, #F8F6FF 0%, #F1EEFD 50%, #F5F2FF 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Claymorphism Card Standard */
        .clay-card {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.95);
            border-radius: 1.75rem;
            box-shadow: 
                0 20px 40px -15px rgba(108, 92, 231, 0.08),
                0 8px 18px -6px rgba(0, 0, 0, 0.03),
                0 2px 4px rgba(255, 255, 255, 0.95) inset,
                0 -4px 10px rgba(162, 155, 254, 0.12) inset;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .clay-card:hover {
            transform: translateY(-4px);
            box-shadow: 
                0 26px 48px -12px rgba(108, 92, 231, 0.14),
                0 12px 24px -6px rgba(0, 0, 0, 0.04),
                0 2px 6px rgba(255, 255, 255, 1) inset,
                0 -5px 12px rgba(162, 155, 254, 0.16) inset;
        }

        /* Claymorphism Pastel Variations matching References */
        .clay-card-purple {
            background: linear-gradient(135deg, #FAF8FF 0%, #EFEAFF 100%);
            border: 1.5px solid #FFFFFF;
            border-radius: 1.75rem;
            box-shadow: 
                0 18px 36px -12px rgba(108, 92, 231, 0.15),
                0 3px 6px rgba(255, 255, 255, 0.9) inset,
                0 -6px 12px rgba(140, 124, 255, 0.15) inset;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .clay-card-purple:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 44px -10px rgba(108, 92, 231, 0.22), 0 3px 6px #FFF inset, 0 -8px 14px rgba(140, 124, 255, 0.2) inset;
        }

        .clay-card-mint {
            background: linear-gradient(135deg, #F3FDF9 0%, #E2F9F0 100%);
            border: 1.5px solid #FFFFFF;
            border-radius: 1.75rem;
            box-shadow: 
                0 18px 36px -12px rgba(0, 184, 148, 0.16),
                0 3px 6px rgba(255, 255, 255, 0.9) inset,
                0 -6px 12px rgba(0, 184, 148, 0.14) inset;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .clay-card-mint:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 44px -10px rgba(0, 184, 148, 0.22), 0 3px 6px #FFF inset, 0 -8px 14px rgba(0, 184, 148, 0.18) inset;
        }

        .clay-card-peach {
            background: linear-gradient(135deg, #FFF8F6 0%, #FFEBE6 100%);
            border: 1.5px solid #FFFFFF;
            border-radius: 1.75rem;
            box-shadow: 
                0 18px 36px -12px rgba(255, 118, 117, 0.16),
                0 3px 6px rgba(255, 255, 255, 0.9) inset,
                0 -6px 12px rgba(255, 118, 117, 0.14) inset;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .clay-card-peach:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 44px -10px rgba(255, 118, 117, 0.24), 0 3px 6px #FFF inset, 0 -8px 14px rgba(255, 118, 117, 0.18) inset;
        }

        .clay-card-blue {
            background: linear-gradient(135deg, #F5FAFF 0%, #E3F1FD 100%);
            border: 1.5px solid #FFFFFF;
            border-radius: 1.75rem;
            box-shadow: 
                0 18px 36px -12px rgba(9, 132, 227, 0.15),
                0 3px 6px rgba(255, 255, 255, 0.9) inset,
                0 -6px 12px rgba(9, 132, 227, 0.13) inset;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .clay-card-blue:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 44px -10px rgba(9, 132, 227, 0.22), 0 3px 6px #FFF inset, 0 -8px 14px rgba(9, 132, 227, 0.18) inset;
        }

        /* Clay Bubble Icons (Like the 3D rounded icons in reference) */
        .clay-bubble {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 1.25rem;
            box-shadow: 
                0 10px 20px -4px rgba(108, 92, 231, 0.25),
                0 3px 6px rgba(255, 255, 255, 0.7) inset,
                0 -4px 8px rgba(0, 0, 0, 0.15) inset;
            transition: transform 0.25s ease;
        }
        .clay-bubble:hover {
            transform: scale(1.06);
        }

        .clay-bubble-purple {
            background: linear-gradient(135deg, #9C88FF 0%, #6C5CE7 100%);
            box-shadow: 0 10px 20px -4px rgba(108, 92, 231, 0.35), 0 3px 6px rgba(255, 255, 255, 0.6) inset, 0 -4px 8px rgba(0, 0, 0, 0.2) inset;
        }
        .clay-bubble-mint {
            background: linear-gradient(135deg, #55EFC4 0%, #00B894 100%);
            box-shadow: 0 10px 20px -4px rgba(0, 184, 148, 0.35), 0 3px 6px rgba(255, 255, 255, 0.6) inset, 0 -4px 8px rgba(0, 0, 0, 0.2) inset;
        }
        .clay-bubble-peach {
            background: linear-gradient(135deg, #FF9F89 0%, #FF7675 100%);
            box-shadow: 0 10px 20px -4px rgba(255, 118, 117, 0.35), 0 3px 6px rgba(255, 255, 255, 0.6) inset, 0 -4px 8px rgba(0, 0, 0, 0.2) inset;
        }
        .clay-bubble-blue {
            background: linear-gradient(135deg, #74B9FF 0%, #0984E3 100%);
            box-shadow: 0 10px 20px -4px rgba(9, 132, 227, 0.35), 0 3px 6px rgba(255, 255, 255, 0.6) inset, 0 -4px 8px rgba(0, 0, 0, 0.2) inset;
        }

        /* Clay Buttons */
        .clay-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-weight: 600;
            border-radius: 9999px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            user-select: none;
        }
        .clay-btn:active {
            transform: scale(0.97) translateY(1px);
        }

        .clay-btn-primary {
            background: linear-gradient(135deg, #7C4DFF 0%, #6C5CE7 60%, #5641E5 100%);
            color: #FFFFFF;
            box-shadow: 
                0 10px 22px -4px rgba(108, 92, 231, 0.45),
                0 2px 4px rgba(255, 255, 255, 0.4) inset,
                0 -3px 6px rgba(0, 0, 0, 0.22) inset;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .clay-btn-primary:hover {
            box-shadow: 
                0 14px 28px -4px rgba(108, 92, 231, 0.55),
                0 2px 4px rgba(255, 255, 255, 0.5) inset,
                0 -4px 8px rgba(0, 0, 0, 0.25) inset;
            transform: translateY(-2px);
        }

        .clay-btn-secondary {
            background: rgba(255, 255, 255, 0.9);
            color: #6C5CE7;
            border: 1.5px solid #EAE6FD;
            box-shadow: 
                0 8px 20px -6px rgba(108, 92, 231, 0.12),
                0 2px 4px rgba(255, 255, 255, 0.9) inset,
                0 -2px 5px rgba(162, 155, 254, 0.15) inset;
        }
        .clay-btn-secondary:hover {
            background: #FFFFFF;
            color: #5641E5;
            border-color: #D6CEFD;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -5px rgba(108, 92, 231, 0.18);
        }

        /* Action Arrow Circle in Cards */
        .clay-arrow-btn {
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 9999px;
            background: rgba(255, 255, 255, 0.85);
            color: #6C5CE7;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 
                0 4px 10px rgba(108, 92, 231, 0.15),
                0 1px 2px rgba(255, 255, 255, 0.9) inset,
                0 -2px 4px rgba(162, 155, 254, 0.2) inset;
            transition: all 0.2s ease;
        }
        .clay-arrow-btn:hover {
            transform: scale(1.1) translateX(2px);
            background: #6C5CE7;
            color: #FFFFFF;
        }

        /* Clay Inputs */
        .clay-input {
            background: rgba(255, 255, 255, 0.92);
            border: 1.5px solid #EAE6FD;
            border-radius: 9999px;
            color: #2D3436;
            box-shadow: 
                0 4px 12px rgba(108, 92, 231, 0.05) inset,
                0 1px 3px rgba(0, 0, 0, 0.02) inset,
                0 8px 24px rgba(108, 92, 231, 0.04);
            transition: all 0.25s ease;
        }
        .clay-input:focus {
            outline: none;
            background: #FFFFFF;
            border-color: #7C4DFF;
            box-shadow: 
                0 0 0 4px rgba(108, 92, 231, 0.15),
                0 3px 8px rgba(108, 92, 231, 0.06) inset;
        }

        /* Clay Chips / Tags */
        .clay-chip {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.85rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            background: #EDE9FE;
            color: #6C5CE7;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 
                0 2px 5px rgba(108, 92, 231, 0.08),
                0 1px 2px rgba(255, 255, 255, 0.9) inset;
            transition: all 0.2s ease;
        }
        .clay-chip:hover {
            background: #6C5CE7;
            color: #FFFFFF;
            transform: translateY(-1px);
        }

        /* Clay Badges */
        .clay-badge-new {
            background: #FFE8E8;
            color: #E84118;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.6875rem;
            box-shadow: 0 1px 3px rgba(232, 65, 24, 0.12) inset;
        }
        .clay-badge-update {
            background: #E8F4FD;
            color: #0984E3;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.6875rem;
            box-shadow: 0 1px 3px rgba(9, 132, 227, 0.12) inset;
        }
        .clay-badge-info {
            background: #E6FAF3;
            color: #00B894;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.6875rem;
            box-shadow: 0 1px 3px rgba(0, 184, 148, 0.12) inset;
        }

        /* 3D Floating Blobs Background */
        .clay-blob-purple {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 35% 35%, #D6CEFD 0%, #A29BFE 65%, #6C5CE7 100%);
            box-shadow: 
                0 30px 60px -15px rgba(108, 92, 231, 0.35),
                0 -10px 20px rgba(0, 0, 0, 0.12) inset,
                0 10px 20px rgba(255, 255, 255, 0.5) inset;
            pointer-events: none;
            z-index: 0;
            animation: floatBlob 14s ease-in-out infinite alternate;
        }

        .clay-blob-mint {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 35% 35%, #A8F5E1 0%, #55EFC4 65%, #00B894 100%);
            box-shadow: 
                0 30px 60px -15px rgba(0, 184, 148, 0.3),
                0 -10px 20px rgba(0, 0, 0, 0.1) inset,
                0 10px 20px rgba(255, 255, 255, 0.5) inset;
            pointer-events: none;
            z-index: 0;
            animation: floatBlob 18s ease-in-out infinite alternate-reverse;
        }

        .clay-blob-yellow {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 35% 35%, #FFEAA7 0%, #FDCB6E 65%, #E17055 100%);
            box-shadow: 
                0 25px 50px -15px rgba(253, 203, 110, 0.35),
                0 -8px 16px rgba(0, 0, 0, 0.1) inset,
                0 8px 16px rgba(255, 255, 255, 0.5) inset;
            pointer-events: none;
            z-index: 0;
            animation: floatBlob 12s ease-in-out infinite alternate;
        }

        @keyframes floatBlob {
            0% { transform: translateY(0px) rotate(0deg) scale(1); }
            50% { transform: translateY(-18px) rotate(4deg) scale(1.04); }
            100% { transform: translateY(12px) rotate(-3deg) scale(0.98); }
        }

        /* Respect prefers-reduced-motion */
        @media (prefers-reduced-motion: reduce) {
            .clay-blob-purple, .clay-blob-mint, .clay-blob-yellow, .animate-float {
                animation: none !important;
            }
            .clay-card, .clay-btn, .clay-bubble {
                transition: none !important;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #F4F2FC; }
        ::-webkit-scrollbar-thumb { background: #C5BAF7; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #6C5CE7; }
    </style>
    @stack('styles')
</head>
<body class="flex flex-col min-h-full text-clay-text antialiased selection:bg-[#6C5CE7] selection:text-white pb-20 lg:pb-0">

    <!-- FLOATING BACKGROUND CLAY BLOBS (Matches the reference 3D environment) -->
    <div class="clay-blob-purple w-40 h-40 -top-10 -left-12 opacity-60"></div>
    <div class="clay-blob-mint w-32 h-32 top-80 -right-10 opacity-55"></div>
    <div class="clay-blob-yellow w-24 h-24 top-[48rem] -left-8 opacity-50"></div>
    <div class="clay-blob-purple w-48 h-48 bottom-40 -right-16 opacity-50"></div>

    <!-- TOP CLAY NAVIGATION BAR -->
    <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-xl border-b border-white/80 shadow-[0_10px_30px_-10px_rgba(108,92,231,0.08)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand Logo (Clay Style) -->
                <div class="flex items-center gap-3">
                    <button type="button" id="mobileMenuBtn" class="lg:hidden p-2 -ml-2 text-clay-muted hover:text-clay-purple focus:outline-none" aria-label="Open menu">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#8C7CFF] via-[#6C5CE7] to-[#5641E5] flex items-center justify-center text-white shadow-[0_10px_20px_-4px_rgba(108,92,231,0.45),0_2px_4px_rgba(255,255,255,0.6)_inset,0_-3px_6px_rgba(0,0,0,0.2)_inset] group-hover:scale-105 transition-transform">
                            <i data-lucide="graduation-cap" class="w-7 h-7"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <span class="font-extrabold text-2xl text-slate-900 tracking-tight">RCU</span>
                                <span class="font-extrabold text-2xl text-[#6C5CE7] tracking-tight">Hub</span>
                            </div>
                            <p class="text-[11px] tracking-wider text-[#A29BFE] font-bold">Learn • Grow • Succeed</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Top Nav -->
                <nav class="hidden lg:flex items-center gap-1.5 bg-[#F4F1FD]/80 p-1.5 rounded-full border border-white/90 shadow-[0_2px_6px_rgba(108,92,231,0.06)_inset]">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-full text-sm font-bold transition-all {{ request()->routeIs('home') ? 'bg-[#6C5CE7] text-white shadow-[0_6px_14px_rgba(108,92,231,0.35),0_2px_4px_rgba(255,255,255,0.4)_inset]' : 'text-slate-600 hover:text-[#6C5CE7] hover:bg-white/80' }}">
                        Home
                    </a>
                    <a href="{{ route('resources.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('resources.*') ? 'bg-[#6C5CE7] text-white shadow-[0_6px_14px_rgba(108,92,231,0.35)]' : 'text-slate-600 hover:text-[#6C5CE7] hover:bg-white/80' }}">
                        Resources
                    </a>
                    <a href="{{ route('courses.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('courses.*') ? 'bg-[#6C5CE7] text-white shadow-[0_6px_14px_rgba(108,92,231,0.35)]' : 'text-slate-600 hover:text-[#6C5CE7] hover:bg-white/80' }}">
                        Courses
                    </a>
                    <a href="{{ route('notices.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('notices.*') ? 'bg-[#6C5CE7] text-white shadow-[0_6px_14px_rgba(108,92,231,0.35)]' : 'text-slate-600 hover:text-[#6C5CE7] hover:bg-white/80' }}">
                        Notices
                    </a>
                    <a href="{{ route('about') }}" class="px-4 py-2 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('about') ? 'bg-[#6C5CE7] text-white shadow-[0_6px_14px_rgba(108,92,231,0.35)]' : 'text-slate-600 hover:text-[#6C5CE7] hover:bg-white/80' }}">
                        About
                    </a>
                </nav>

                <!-- Right Nav Elements: Search, Login / Register, User Menu -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('resources.index') }}" class="w-10 h-10 rounded-full bg-white/90 border border-purple-100 flex items-center justify-center text-slate-600 hover:text-[#6C5CE7] hover:bg-white shadow-[0_4px_10px_rgba(108,92,231,0.08)] transition-all" title="Search resources">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </a>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold text-amber-800 bg-amber-100/80 hover:bg-amber-100 border border-amber-200 rounded-full shadow-xs transition-colors">
                                <i data-lucide="shield" class="w-3.5 h-3.5 text-amber-700"></i>
                                Admin Panel
                            </a>
                        @endif

                        <!-- User Profile Dropdown -->
                        <div class="relative group">
                            <button type="button" class="flex items-center gap-2 p-1 rounded-full bg-white/90 border border-purple-100 text-slate-700 hover:shadow-md transition-all focus:outline-none">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#6C5CE7] to-[#8C7CFF] text-white flex items-center justify-center font-bold text-xs shadow-xs">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                                <span class="hidden md:inline text-sm font-bold text-slate-800 pr-1">{{ auth()->user()->name }}</span>
                                <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 hidden md:inline pr-2"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-60 bg-white/95 backdrop-blur-xl rounded-3xl shadow-[0_20px_45px_-10px_rgba(108,92,231,0.25)] border border-purple-100 p-2 hidden group-hover:block hover:block z-50 animate__animated animate__fadeIn animate__faster">
                                <div class="px-4 py-3 border-b border-slate-100">
                                    <p class="text-xs text-slate-400 font-medium">Signed in as</p>
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ auth()->user()->email }}</p>
                                    <span class="inline-block mt-1 px-2.5 py-0.5 text-[10px] font-bold rounded-full {{ auth()->user()->isAdmin() ? 'bg-amber-100 text-amber-800' : (auth()->user()->isVerifiedTeacher() ? 'bg-emerald-100 text-emerald-800' : 'bg-purple-100 text-purple-800') }}">
                                        {{ auth()->user()->isAdmin() ? 'Admin' : (auth()->user()->isVerifiedTeacher() ? '🏅 Verified Teacher' : ucfirst(auth()->user()->role)) }}
                                    </span>
                                </div>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm text-[#6C5CE7] bg-purple-50/60 hover:bg-purple-50 font-bold rounded-2xl my-1">
                                        <i data-lucide="shield" class="w-4 h-4 text-[#6C5CE7]"></i> Admin Panel
                                    </a>
                                @endif
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 rounded-2xl">
                                    <i data-lucide="user" class="w-4 h-4 text-slate-400"></i> My Account
                                </a>
                                <a href="{{ route('dashboard.my-uploads') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 rounded-2xl">
                                    <i data-lucide="folder" class="w-4 h-4 text-slate-400"></i> My Uploads
                                </a>
                                <a href="{{ route('upload.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 rounded-2xl">
                                    <i data-lucide="upload-cloud" class="w-4 h-4 text-slate-400"></i> Upload Resource
                                </a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-sm text-rose-600 hover:bg-rose-50 font-semibold rounded-2xl">
                                        <i data-lucide="log-out" class="w-4 h-4 text-rose-500"></i> Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-2.5">
                            <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-bold text-slate-700 hover:text-[#6C5CE7] transition-colors">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="clay-btn clay-btn-primary px-6 py-2.5 text-sm font-bold">
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

    <!-- MOBILE BOTTOM NAVIGATION DOCK (Pixel-perfect Claymorphism dock matching Mobile Reference) -->
    <nav class="lg:hidden fixed bottom-3 inset-x-4 bg-white/90 backdrop-blur-2xl border border-white/90 z-40 py-2.5 px-6 flex items-center justify-between rounded-full shadow-[0_15px_35px_-5px_rgba(108,92,231,0.2),0_1px_3px_rgba(255,255,255,0.9)_inset]">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 text-[11px] font-bold transition-all {{ request()->routeIs('home') ? 'text-[#6C5CE7] scale-105' : 'text-slate-400 hover:text-[#6C5CE7]' }}">
            <i data-lucide="home" class="w-5 h-5 stroke-[2.2]"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('resources.index') }}" class="flex flex-col items-center gap-1 text-[11px] font-semibold transition-all {{ request()->routeIs('resources.*') ? 'text-[#6C5CE7] font-bold scale-105' : 'text-slate-400 hover:text-[#6C5CE7]' }}">
            <i data-lucide="book-open" class="w-5 h-5 stroke-[2.2]"></i>
            <span>Resources</span>
        </a>
        <a href="{{ route('courses.index') }}" class="flex flex-col items-center gap-1 text-[11px] font-semibold transition-all {{ request()->routeIs('courses.*') ? 'text-[#6C5CE7] font-bold scale-105' : 'text-slate-400 hover:text-[#6C5CE7]' }}">
            <i data-lucide="graduation-cap" class="w-5 h-5 stroke-[2.2]"></i>
            <span>Courses</span>
        </a>
        <a href="{{ route('notices.index') }}" class="flex flex-col items-center gap-1 text-[11px] font-semibold transition-all {{ request()->routeIs('notices.*') ? 'text-[#6C5CE7] font-bold scale-105' : 'text-slate-400 hover:text-[#6C5CE7]' }}">
            <i data-lucide="bell" class="w-5 h-5 stroke-[2.2]"></i>
            <span>Notices</span>
        </a>
        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="flex flex-col items-center gap-1 text-[11px] font-semibold transition-all {{ request()->routeIs('dashboard*') || request()->routeIs('login') ? 'text-[#6C5CE7] font-bold scale-105' : 'text-slate-400 hover:text-[#6C5CE7]' }}">
            <i data-lucide="user" class="w-5 h-5 stroke-[2.2]"></i>
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
