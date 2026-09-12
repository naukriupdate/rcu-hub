<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal Login — RCU Student Resource Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="h-full flex items-center justify-center p-4 selection:bg-blue-600 selection:text-white">
    <div class="max-w-md w-full space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center mx-auto shadow-lg shadow-blue-500/30">
                <i data-lucide="shield" class="w-8 h-8"></i>
            </div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">RCU Admin Panel</h1>
            <p class="text-xs text-slate-400">Administrative clearance required to access management portal.</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-7 shadow-2xl space-y-6">
            @if($errors->any())
                <div class="p-3.5 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl text-xs">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4 text-xs sm:text-sm">
                @csrf

                <div>
                    <label class="block font-semibold text-slate-300 mb-1.5">Administrative Email</label>
                    <div class="relative flex items-center">
                        <div class="absolute left-3.5 text-slate-500">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@rcu.edu"
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white text-xs sm:text-sm placeholder-slate-600">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 mb-1.5">Security Password</label>
                    <div class="relative flex items-center">
                        <div class="absolute left-3.5 text-slate-500">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </div>
                        <input type="password" name="password" required placeholder="••••••••"
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white text-xs sm:text-sm placeholder-slate-600">
                    </div>
                </div>

                <div class="flex items-center">
                    <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-400">
                        <input type="checkbox" name="remember" class="rounded bg-slate-950 border-slate-800 text-blue-600 focus:ring-blue-500">
                        <span>Keep administrator logged in</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-600/30 transition-all">
                        Authenticate & Access
                    </button>
                </div>
            </form>

            <div class="pt-4 border-t border-slate-800/80 text-center">
                <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-slate-300 transition-colors flex items-center justify-center gap-1">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back to Public Student Hub
                </a>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    </script>
</body>
</html>
