<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login Admin - Laras Banyuwangi</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <!-- Scripts and Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
{!! '<' . 'style>.login-bg { background-image: url(' . asset('images/bg-login.jpg') . '); }</' . 'style>' !!}
<body class="antialiased min-h-screen relative flex flex-col justify-between items-center py-6 px-4 bg-cover bg-center bg-no-repeat bg-fixed overflow-x-hidden login-bg">
    
    <!-- Blue gradient overlay matching the mockup color tones -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#153050]/80 via-[#0e2136]/55 to-[#081524]/90 z-0 pointer-events-none"></div>

    <!-- Spacer for top balance -->
    <div class="h-6 z-10"></div>

    <!-- Login Card Container -->
    <div class="w-full max-w-[440px] px-8 py-10 rounded-[2.5rem] bg-white/10 backdrop-blur-2xl border border-white/20 shadow-[0_25px_60px_rgba(0,0,0,0.35)] flex flex-col items-center z-10 transition-all duration-300 hover:shadow-[0_30px_70px_rgba(0,0,0,0.45)] hover:border-white/30 hover:scale-[1.01]"
         style="transform: translateZ(0); backface-visibility: hidden; will-change: transform;">
        
        <!-- Header -->
        <h1 class="text-white text-[2.5rem] font-semibold tracking-wide mb-1">Login Laras</h1>
        <p class="text-white/80 text-sm mb-8 font-light">Masuk sebagai Admin</p>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="w-full" x-data="{ loading: false, showPassword: false }" @submit="loading = true">
            @csrf

            <!-- Email Input -->
            <div class="mb-4 relative">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Email"
                       class="w-full pl-5 pr-12 py-4 rounded-2xl bg-white border-0 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/50 text-base shadow-inner transition-all duration-200" />
                <span class="absolute right-4 top-[18px] text-slate-400 pointer-events-none">
                    <x-lucide-user class="h-5 w-5" />
                </span>
                @error('email')
                    <span class="text-xs text-red-300 mt-1 pl-2 block font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-6 relative">
                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" placeholder="Password"
                       class="w-full pl-5 pr-12 py-4 rounded-2xl bg-white border-0 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/50 text-base shadow-inner transition-all duration-200" />
                
                <!-- Eye Toggle Button -->
                <button type="button" @click="showPassword = !showPassword" 
                        class="absolute right-4 top-[18px] text-slate-400 hover:text-slate-600 transition-colors focus:outline-none">
                    <!-- Eye Off Icon (when showPassword is false - meaning password is hidden) -->
                    <x-lucide-eye-off x-show="!showPassword" class="h-5 w-5" />
                    <!-- Eye Icon (when showPassword is true - meaning password is visible) -->
                    <x-lucide-eye x-show="showPassword" class="h-5 w-5" style="display: none;" />
                </button>

                @error('password')
                    <span class="text-xs text-red-300 mt-1 pl-2 block font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" :disabled="loading"
                    class="w-full py-4 rounded-2xl bg-[#345275] hover:bg-[#2d4766] disabled:opacity-80 disabled:cursor-not-allowed text-white font-semibold text-base transition-all duration-200 shadow-md hover:shadow-lg active:translate-y-[1px] flex items-center justify-center gap-2.5">
                <svg x-show="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span x-text="loading ? 'Sedang masuk...' : 'Log In'">Log In</span>
            </button>
        </form>

        <!-- Logo Section -->
        <div class="mt-8 flex flex-col items-center w-full">
            <!-- Brand Logo -->
            <div class="flex items-center justify-center">
                <img src="{{ asset('images/logo-laras-white.png') }}" alt="Logo Laras Banyuwangi" class="h-[70px] w-auto object-contain" />
            </div>

            <!-- Footer warning -->
            <p class="text-white/50 text-[11px] text-center mt-6 font-light max-w-[280px] leading-relaxed">
                Mohon maaf, hanya admin yang bisa akses
            </p>
        </div>

    </div>

    <!-- Back to Overview Link -->
    <a href="/" class="flex items-center gap-2 text-white/80 hover:text-white transition-all duration-200 text-sm font-medium z-10 hover:underline drop-shadow-sm mt-6">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Kembali ke Overview
    </a>

</body>
</html>
