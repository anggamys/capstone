@php
    $dashboardActive = request()->routeIs('dashboard');
    $homeActive = request()->routeIs('home');
    $blogKategoriActive = request()->routeIs('admin.kategori-blog-artikel.*');
    $blogArtikelActive = request()->routeIs('admin.blog-artikel.*');
    
    // For placeholders/others
    $kategoriActive = request()->is('admin/kategori-destinasi*');
    $subKategoriActive = request()->is('admin/sub-kategori-destinasi*');
    $aktivitasActive = request()->is('admin/aktivitas*');
    $fasilitasActive = request()->is('admin/fasilitas*');
    $tipePerjalananActive = request()->is('admin/tipe-perjalanan*');
    $waktuKunjunganActive = request()->is('admin/waktu-kunjungan*');
    $transportasiActive = request()->is('admin/transportasi*');
    $dataDestinasiActive = request()->is('admin/destinasi*');
    $riwayatActive = request()->is('admin/riwayat-preferensi*');

    $activeClass = 'flex items-center px-6 py-3 text-sm font-semibold text-white bg-[#89A8E0] rounded-xl shadow-lg shadow-[#89A8E0]/30 transition-all duration-200';
    $inactiveClass = 'flex items-center px-6 py-3 text-sm font-medium text-[#3F5C7D] hover:bg-[#3F5C7D]/10 hover:text-[#3F5C7D] rounded-xl transition-all duration-200';
    
    $activeSubClass = 'flex items-center py-2 pr-4 pl-14 text-sm font-semibold text-[#3F5C7D] bg-[#3F5C7D]/10 rounded-lg transition-all duration-200';
    $inactiveSubClass = 'flex items-center py-2 pr-4 pl-14 text-sm font-medium text-[#3F5C7D]/85 hover:bg-[#3F5C7D]/5 hover:text-[#3F5C7D] rounded-lg transition-all duration-200';
@endphp

<!-- Mobile Backdrop -->
<div x-show="sidebarOpen" 
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 md:hidden"
     @click="sidebarOpen = false"
     style="display: none;">
</div>

<!-- Sidebar Container (Responsive: drawer on mobile, sticky sidebar on desktop) -->
<div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
     class="fixed inset-y-0 left-0 z-50 w-72 shrink-0 bg-[#F1F3FF] flex flex-col justify-between border-r border-indigo-100/10 transition-transform duration-300 md:translate-x-0 md:static md:h-screen md:sticky md:top-0"
     x-data="{ 
         openDestinasi: {{ request()->is('admin/kategori-destinasi*', 'admin/sub-kategori-destinasi*', 'admin/aktivitas*', 'admin/fasilitas*', 'admin/tipe-perjalanan*', 'admin/waktu-kunjungan*', 'admin/transportasi*', 'admin/destinasi*') ? 'true' : 'true' }},
         openBlog: {{ request()->routeIs('admin.kategori-blog-artikel.*', 'admin.blog-artikel.*') ? 'true' : 'true' }},
         openLainnya: {{ request()->is('admin/riwayat-preferensi*') ? 'true' : 'true' }}
     }">
    
    <!-- Sidebar Scrollable Content -->
    <div class="flex-1 overflow-y-auto px-6 py-6 scrollbar-thin scrollbar-thumb-gray-200">
        
        <!-- Logo Header -->
        <div class="flex flex-col pb-4 mb-4 border-b border-indigo-100/30">
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center pl-2 w-full pr-4">
                    <img src="{{ asset('images/logo-laras.png') }}" alt="Laras Banyuwangi" class="h-16 md:h-18 w-auto object-contain">
                </a>
                <!-- Mobile Close Button inside sidebar -->
                <button @click="sidebarOpen = false" class="md:hidden p-2 rounded-lg text-[#3F5C7D] hover:bg-[#3F5C7D]/10 focus:outline-none transition-colors duration-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="space-y-1">
            
            <!-- Home User Link -->
            <a href="{{ route('home') }}" class="{{ $homeActive ? $activeClass : $inactiveClass }}">
                <!-- Temple/Home Icon -->
                <svg class="w-6 h-6 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V11M5 21V11M10 21V11M14 21V11M2 11h20M12 3L2 11h20L12 3zM3 21h18"></path>
                </svg>
                <span>Home User</span>
            </a>

            <!-- Dashboard Admin Link -->
            <a href="{{ route('dashboard') }}" class="{{ $dashboardActive ? $activeClass : $inactiveClass }}">
                <!-- 2x2 Grid Icon -->
                <svg class="w-6 h-6 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span>Dashboard Admin</span>
            </a>

            <!-- ================= GROUP 1: Manajemen Destinasi ================= -->
            <div class="space-y-1">
                <button @click="openDestinasi = !openDestinasi" 
                        class="w-full flex items-center justify-between px-6 mt-3.5 mb-1 py-2 text-left focus:outline-none group">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 shrink-0 text-[#89A8E0]/80 transition-colors group-hover:text-[#3F5C7D]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        <span class="text-[11px] font-bold tracking-wider text-[#89A8E0]/80 uppercase transition-colors group-hover:text-[#3F5C7D]">
                            Manajemen Destinasi
                        </span>
                    </div>
                    <svg class="h-4 w-4 text-[#89A8E0]/80 transition-transform duration-200 group-hover:text-[#3F5C7D]" 
                         :class="openDestinasi ? '' : '-rotate-90'" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <div x-show="openDestinasi" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="space-y-1">
                    
                    <a href="{{ Route::has('admin.kategori-destinasi.index') ? route('admin.kategori-destinasi.index') : '#' }}" class="{{ $kategoriActive ? $activeSubClass : $inactiveSubClass }}">Kategori</a>
                    <a href="{{ Route::has('admin.sub-kategori-destinasi.index') ? route('admin.sub-kategori-destinasi.index') : '#' }}" class="{{ $subKategoriActive ? $activeSubClass : $inactiveSubClass }}">Subkategori</a>
                    <a href="{{ Route::has('admin.aktivitas.index') ? route('admin.aktivitas.index') : '#' }}" class="{{ $aktivitasActive ? $activeSubClass : $inactiveSubClass }}">Aktivitas</a>
                    <a href="{{ Route::has('admin.fasilitas.index') ? route('admin.fasilitas.index') : '#' }}" class="{{ $fasilitasActive ? $activeSubClass : $inactiveSubClass }}">Fasilitas</a>
                    <a href="{{ Route::has('admin.tipe-perjalanan.index') ? route('admin.tipe-perjalanan.index') : '#' }}" class="{{ $tipePerjalananActive ? $activeSubClass : $inactiveSubClass }}">Tipe Perjalanan</a>
                    <a href="{{ Route::has('admin.waktu-kunjungan.index') ? route('admin.waktu-kunjungan.index') : '#' }}" class="{{ $waktuKunjunganActive ? $activeSubClass : $inactiveSubClass }}">Waktu Kunjungan</a>
                    <a href="{{ Route::has('admin.transportasi.index') ? route('admin.transportasi.index') : '#' }}" class="{{ $transportasiActive ? $activeSubClass : $inactiveSubClass }}">Transportasi</a>
                    <a href="{{ Route::has('admin.destinasi.index') ? route('admin.destinasi.index') : '#' }}" class="{{ $dataDestinasiActive ? $activeSubClass : $inactiveSubClass }}">Data Destinasi</a>
                </div>
            </div>

            <!-- ================= GROUP 2: Manajemen Blog Artikel ================= -->
            <div class="space-y-1">
                <button @click="openBlog = !openBlog" 
                        class="w-full flex items-center justify-between px-6 mt-3.5 mb-1 py-2 text-left focus:outline-none group">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 shrink-0 text-[#89A8E0]/80 transition-colors group-hover:text-[#3F5C7D]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <span class="text-[11px] font-bold tracking-wider text-[#89A8E0]/80 uppercase transition-colors group-hover:text-[#3F5C7D]">
                            Manajemen Blog Artikel
                        </span>
                    </div>
                    <svg class="h-4 w-4 text-[#89A8E0]/80 transition-transform duration-200 group-hover:text-[#3F5C7D]" 
                         :class="openBlog ? '' : '-rotate-90'" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <div x-show="openBlog" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="space-y-1">
                    
                    <a href="{{ Route::has('admin.kategori-blog-artikel.index') ? route('admin.kategori-blog-artikel.index') : '#' }}" 
                       class="{{ $blogKategoriActive ? $activeSubClass : $inactiveSubClass }}">
                        Kategori Blog Artikel
                    </a>
                    
                    <a href="{{ Route::has('admin.blog-artikel.index') ? route('admin.blog-artikel.index') : '#' }}" 
                       class="{{ $blogArtikelActive ? $activeSubClass : $inactiveSubClass }}">
                        Data Blog Artikel
                    </a>
                </div>
            </div>

            <!-- ================= GROUP 3: Lain-lainnya ================= -->
            <div class="space-y-1">
                <button @click="openLainnya = !openLainnya" 
                        class="w-full flex items-center justify-between px-6 mt-3.5 mb-1 py-2 text-left focus:outline-none group">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 shrink-0 text-[#89A8E0]/80 transition-colors group-hover:text-[#3F5C7D]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-[11px] font-bold tracking-wider text-[#89A8E0]/80 uppercase transition-colors group-hover:text-[#3F5C7D]">
                            Lain-lainnya
                        </span>
                    </div>
                    <svg class="h-4 w-4 text-[#89A8E0]/80 transition-transform duration-200 group-hover:text-[#3F5C7D]" 
                         :class="openLainnya ? '' : '-rotate-90'" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <div x-show="openLainnya" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="space-y-1">
                    
                    <a href="#" class="{{ $riwayatActive ? $activeSubClass : $inactiveSubClass }}">
                        Riwayat Preferensi User
                    </a>
                </div>
            </div>

        </nav>
    </div>
</div>
