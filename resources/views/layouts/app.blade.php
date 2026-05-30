<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-[#2b3674]">
        <div class="flex min-h-screen bg-[#F1F3FF]/40" x-data="{ sidebarOpen: false }">
            
            <!-- Admin Sidebar Component -->
            <x-admin-sidebar />

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden min-h-screen">
                
                <!-- Admin Navbar Component -->
                <x-admin-navbar :header="$header ?? null" />

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 md:p-8 flex flex-col justify-between">
                    <div class="flex-grow">
                        {{ $slot }}
                    </div>
                    <x-admin-footer />
                </main>
            </div>
        </div>

        <!-- Premium Floating Toast Notification -->
        <x-toast />
    </body>
</html>
