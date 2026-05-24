<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 50)"
     :class="{ 
         'bg-white border-b border-slate-100 shadow-sm text-slate-800': !{{ request()->is('/') ? 'true' : 'false' }} || scrolled || open, 
         'bg-transparent border-b border-white/10 shadow-none text-white': {{ request()->is('/') ? 'true' : 'false' }} && !scrolled && !open 
     }" 
     class="fixed top-0 left-0 right-0 z-50 h-20 transition-all duration-300 flex items-center">
    
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Left: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/">
                    <!-- White Logo (Only on homepage, when transparent/not scrolled/not open) -->
                    <img class="h-12 w-auto object-contain transition-all duration-300" 
                         :class="{ 'hidden': !({{ request()->is('/') ? 'true' : 'false' }} && !scrolled && !open) }"
                         src="{{ asset('images/logo-laras-white.png') }}" 
                         alt="Laras Banyuwangi Logo">
                    <!-- Colored Logo (In all other states) -->
                    <img class="h-12 w-auto object-contain transition-all duration-300" 
                         :class="{ 'hidden': {{ request()->is('/') ? 'true' : 'false' }} && !scrolled && !open }"
                         src="{{ asset('images/logo-laras.png') }}" 
                         alt="Laras Banyuwangi Logo">
                </a>
            </div>

            <!-- Middle: Menu Links (Desktop) -->
            <div class="hidden md:flex space-x-8 items-center">
                <!-- Home Link -->
                @if(request()->is('/'))
                    <a href="/" 
                       :class="scrolled || open ? 'text-[#3F5C7D] border-[#3F5C7D]' : 'text-white border-white'"
                       class="px-1 py-2 text-sm font-semibold border-b-2 transition-colors">
                        Home
                    </a>
                @else
                    <a href="/" class="text-slate-600 hover:text-[#3F5C7D] px-1 py-2 text-sm font-medium transition-colors">
                        Home
                    </a>
                @endif

                <!-- jelajah Link -->
                @if(request()->is('explore*'))
                    <a href="/explore" class="text-[#3F5C7D] font-semibold border-b-2 border-[#3F5C7D] px-1 py-2 text-sm transition-colors">
                        Jelajah Destinasi
                    </a>
                @else
                    <a href="/explore" 
                       :class="{ 'text-slate-600 hover:text-[#3F5C7D]': !{{ request()->is('/') ? 'true' : 'false' }} || scrolled || open, 'text-white/85 hover:text-white': {{ request()->is('/') ? 'true' : 'false' }} && !scrolled && !open }"
                       class="px-1 py-2 text-sm font-medium transition-colors">
                        Jelajah Destinasi
                    </a>
                @endif

                <!-- AI Planner Link -->
                @if(request()->is('planner*'))
                    <a href="/planner" class="text-[#3F5C7D] font-semibold border-b-2 border-[#3F5C7D] px-1 py-2 text-sm transition-colors">
                        AI Planner
                    </a>
                @else
                    <a href="/planner" 
                       :class="{ 'text-slate-600 hover:text-[#3F5C7D]': !{{ request()->is('/') ? 'true' : 'false' }} || scrolled || open, 'text-white/85 hover:text-white': {{ request()->is('/') ? 'true' : 'false' }} && !scrolled && !open }"
                       class="px-1 py-2 text-sm font-medium transition-colors">
                        AI Planner
                    </a>
                @endif

                <!-- Blog Link -->
                @if(request()->is('blog*'))
                    <a href="/blog" class="text-[#3F5C7D] font-semibold border-b-2 border-[#3F5C7D] px-1 py-2 text-sm transition-colors">
                        Blog
                    </a>
                @else
                    <a href="/blog" 
                       :class="{ 'text-slate-600 hover:text-[#3F5C7D]': !{{ request()->is('/') ? 'true' : 'false' }} || scrolled || open, 'text-white/85 hover:text-white': {{ request()->is('/') ? 'true' : 'false' }} && !scrolled && !open }"
                       class="px-1 py-2 text-sm font-medium transition-colors">
                        Blog
                    </a>
                @endif

                <!-- Tentang Kami Link -->
                @if(request()->is('about*'))
                    <a href="/about" class="text-[#3F5C7D] font-semibold border-b-2 border-[#3F5C7D] px-1 py-2 text-sm transition-colors">
                        Tentang Kami
                    </a>
                @else
                    <a href="/about" 
                       :class="{ 'text-slate-600 hover:text-[#3F5C7D]': !{{ request()->is('/') ? 'true' : 'false' }} || scrolled || open, 'text-white/85 hover:text-white': {{ request()->is('/') ? 'true' : 'false' }} && !scrolled && !open }"
                       class="px-1 py-2 text-sm font-medium transition-colors">
                        Tentang Kami
                    </a>
                @endif
            </div>

            <!-- Right: Admin Icon (Desktop) -->
            <div class="hidden md:flex items-center">

                <!-- Admin Dashboard/Login Icon -->
                @auth
                    <a href="/dashboard" title="Admin Dashboard" 
                       :class="{ 'text-slate-600 hover:text-[#3F5C7D]': !{{ request()->is('/') ? 'true' : 'false' }} || scrolled || open, 'text-white/85 hover:text-white': {{ request()->is('/') ? 'true' : 'false' }} && !scrolled && !open }" 
                       class="transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            <circle cx="12" cy="11" r="2.5" />
                            <path d="M12 13.5v3" stroke-linecap="round" />
                        </svg>
                    </a>
                @else
                    <a href="/login" title="Login Admin" 
                       :class="{ 'text-slate-600 hover:text-[#3F5C7D]': !{{ request()->is('/') ? 'true' : 'false' }} || scrolled || open, 'text-white/85 hover:text-white': {{ request()->is('/') ? 'true' : 'false' }} && !scrolled && !open }" 
                       class="transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            <circle cx="12" cy="11" r="2.5" />
                            <path d="M12 13.5v3" stroke-linecap="round" />
                        </svg>
                    </a>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" 
                        :class="{ 'text-slate-600 hover:text-slate-800': !{{ request()->is('/') ? 'true' : 'false' }} || scrolled || open, 'text-white hover:text-white/80': {{ request()->is('/') ? 'true' : 'false' }} && !scrolled && !open }"
                        class="focus:outline-none transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden bg-white border-t border-slate-100 shadow-lg absolute top-20 left-0 right-0 z-40 transition-all duration-300">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('/') ? 'text-[#3F5C7D] bg-slate-50' : 'text-slate-600 hover:text-slate-900' }}">
                Home
            </a>
            <a href="/explore" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('explore*') ? 'text-[#3F5C7D] bg-slate-50' : 'text-slate-600 hover:text-slate-900' }}">
                Jelajah Destinasi
            </a>
            <a href="/planner" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('planner*') ? 'text-[#3F5C7D] bg-slate-50' : 'text-slate-600 hover:text-slate-900' }}">
                AI Planner
            </a>
            <a href="/blog" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('blog*') ? 'text-[#3F5C7D] bg-slate-50' : 'text-slate-600 hover:text-slate-900' }}">
                Blog
            </a>
            <a href="/about" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('about*') ? 'text-[#3F5C7D] bg-slate-50' : 'text-slate-600 hover:text-slate-900' }}">
                Tentang Kami
            </a>
            @auth
                <a href="/dashboard" class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 hover:text-slate-900">
                    Dashboard Admin
                </a>
            @else
                <a href="/login" class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 hover:text-slate-900">
                    Login Admin
                </a>
            @endauth
        </div>
    </div>
</nav>
