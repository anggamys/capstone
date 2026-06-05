<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Laras Banyuwangi' }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts and Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        #cursor-glow {
            background: 
                radial-gradient(180px circle at var(--x, 0px) var(--y, 0px), rgba(142, 211, 216, 0.15), transparent 80%),
                radial-gradient(450px circle at var(--x, 0px) var(--y, 0px), rgba(137, 168, 224, 0.08), transparent 80%);
        }
    </style>
</head>
<body class="antialiased min-h-screen bg-slate-50 flex flex-col justify-between text-slate-800">

    <!-- Cursor Glow Effect Overlay -->
    <div id="cursor-glow" class="pointer-events-none fixed inset-0 z-[9999] opacity-0 transition-opacity duration-300 hidden md:block"></div>

    <!-- Navbar Component -->
    <x-guest-navbar />

    <!-- Main Content -->
    <main class="flex-grow {{ request()->is('/') ? '' : 'pt-20' }}">
        {{ $slot }}
    </main>

    <!-- Footer Component -->
    <x-guest-footer />

    <!-- Script for Cursor Glow Effect -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const glow = document.getElementById('cursor-glow');
            if (!glow) return;

            if (window.matchMedia('(pointer: fine)').matches) {
                document.addEventListener('mousemove', (e) => {
                    glow.style.setProperty('--x', `${e.clientX}px`);
                    glow.style.setProperty('--y', `${e.clientY}px`);
                });

                document.addEventListener('mouseenter', () => {
                    glow.style.opacity = '1';
                });

                document.addEventListener('mouseleave', () => {
                    glow.style.opacity = '0';
                });

                document.addEventListener('mousemove', () => {
                    glow.style.opacity = '1';
                }, { once: true });
            }
        });
    </script>
</body>
</html>
