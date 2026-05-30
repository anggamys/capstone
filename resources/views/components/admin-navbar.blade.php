@props(['header'])

<header class="bg-white/80 backdrop-blur-md border-b border-indigo-100/20 sticky top-0 z-40 px-6 md:px-8 py-5 flex items-center justify-between">
    <!-- Left Section: Menu Toggle & Title -->
    <div class="flex items-center">
        <!-- Hamburger Menu for Mobile (Visible on <md) -->
        <button @click="sidebarOpen = true" class="md:hidden mr-4 p-2 rounded-lg text-[#3F5C7D] hover:bg-[#3F5C7D]/10 focus:outline-none transition-colors duration-200">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Page Header Title (Breadcrumbs) -->
        @isset($header)
            @php
                $headerStr = (string) $header;
                $parts = array_map('trim', explode('|', $headerStr));
            @endphp
            <nav class="flex items-center gap-2 text-base md:text-lg font-bold" aria-label="Breadcrumb">
                @if (count($parts) > 1)
                    @foreach ($parts as $index => $part)
                        @if ($index > 0)
                            <x-lucide-chevron-right class="w-4 h-4 text-slate-300 shrink-0" stroke-width="3" />
                        @endif
                        @if ($index === count($parts) - 1)
                            <span class="text-[#3F5C7D] tracking-tight">{{ $part }}</span>
                        @else
                            <span class="text-slate-400 hover:text-slate-500 transition-colors duration-150">{{ $part }}</span>
                        @endif
                    @endforeach
                @else
                    <span class="text-[#3F5C7D] tracking-tight">{{ $headerStr }}</span>
                @endif
            </nav>
        @endisset
    </div>

    <!-- Right Section: User Profile Dropdown -->
    <div class="flex items-center">
        <x-dropdown align="right" width="48" contentClasses="py-1 bg-white rounded-xl border border-indigo-100/20 shadow-xl shadow-indigo-100/10 mt-1">
            <x-slot name="trigger">
                <button class="flex items-center space-x-3 text-left focus:outline-none group">
                    <!-- Unisex Profile Avatar -->
                    <div class="w-10 h-10 rounded-full bg-[#3F5C7D]/10 border border-white flex items-center justify-center text-[#3F5C7D] shadow-sm overflow-hidden transition-transform duration-200 group-hover:scale-105">
                        <svg class="w-6 h-6 text-[#3F5C7D]/85" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>

                    <!-- User Info Text -->
                    <div class="hidden sm:block">
                        <div class="text-sm font-bold text-[#3F5C7D] leading-none group-hover:text-[#89A8E0] transition-colors duration-150">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="text-[11px] font-medium text-slate-400 mt-1 leading-none">
                            Administrator
                        </div>
                    </div>

                    <!-- Dual Chevron Selector Icon -->
                    <svg class="h-4 w-4 text-slate-400 group-hover:text-[#3F5C7D] transition-colors duration-150 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="px-1.5 py-1.5 space-y-0.5">
                    <!-- Profile Link -->
                    <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2.5 text-start text-sm font-semibold text-[#3F5C7D] hover:bg-[#3F5C7D]/10 hover:text-[#3F5C7D] rounded-lg transition-all duration-200">
                        {{ __('Profile') }}
                    </a>

                    <!-- Authentication / Log Out -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2.5 text-start text-sm font-semibold text-[#3F5C7D] hover:bg-red-50 hover:text-red-600 rounded-lg transition-all duration-200">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </x-slot>
        </x-dropdown>
    </div>
</header>
