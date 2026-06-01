<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Admin') }}
    </x-slot>

    <div class="py-2">
        <!-- Banner Section (Mount Ijen Panorama Background) -->
        <div class="relative bg-slate-900 rounded-[2rem] overflow-hidden shadow-md mb-8 py-10 px-6 md:py-14 md:px-12 flex flex-col items-center justify-center text-center min-h-[220px]">
            <!-- Background Image -->
            {!! '<' . 'style>.dashboard-banner-bg { background-image: url(' . asset('images/dashboard-banner.png') . '); }</' . 'style>' !!}
            <div class="absolute inset-0 bg-cover bg-center z-0 dashboard-banner-bg"></div>

            <!-- Banner Content -->
            <div class="relative z-10 text-white max-w-3xl">
                <h1 class="text-2xl md:text-3.5xl font-bold tracking-tight mb-2.5 leading-tight font-sans">
                    Selamat Datang di Panel Admin Laras Banyuwangi
                </h1>
                <p class="text-xs md:text-sm text-slate-100/90 leading-relaxed font-light font-sans max-w-xl mx-auto">
                    Pantau destinasi, blog dan hasil rekomendasi destinasi secara real-time.
                </p>
            </div>
        </div>

        <!-- Stats Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Card 1: Total Destinasi -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-indigo-50/50 flex items-center transition-all duration-200 hover:shadow-md">
                <div class="w-12 h-12 rounded-2xl bg-[#E6F7FA] flex items-center justify-center text-[#3F5C7D] border border-[#CDEBF2] shrink-0">
                    <!-- Map Pin Icon -->
                    <x-lucide-map-pin class="w-6 h-6" />
                </div>
                <div class="ml-4">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Total Destinasi</span>
                    <span class="text-2xl font-bold text-[#2b3674] mt-0.5 block">{{ $totalDestinasi ?? 0 }}</span>
                </div>
            </div>

            <!-- Card 2: Total Blog Artikel -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-indigo-50/50 flex items-center transition-all duration-200 hover:shadow-md">
                <div class="w-12 h-12 rounded-2xl bg-[#ebf0fc] flex items-center justify-center text-[#3F5C7D] border border-indigo-100/30 shrink-0">
                    <!-- Document Text Icon -->
                    <x-lucide-file-text class="w-6 h-6" />
                </div>
                <div class="ml-4">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Total Blog</span>
                    <span class="text-2xl font-bold text-[#2b3674] mt-0.5 block">{{ $totalBlogArtikel ?? 0 }}</span>
                </div>
            </div>

            <!-- Card 3: Total Rekomendasi User -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-indigo-50/50 flex items-center transition-all duration-200 hover:shadow-md">
                <div class="w-12 h-12 rounded-2xl bg-[#ebf0fc] flex items-center justify-center text-[#89A8E0] border border-indigo-100/30 shrink-0">
                    <!-- Thumbs Up Icon -->
                    <x-lucide-thumbs-up class="w-6 h-6" />
                </div>
                <div class="ml-4">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Total Rekomendasi User</span>
                    <span class="text-2xl font-bold text-[#2b3674] mt-0.5 block">{{ $totalRekomendasiUser ?? 0 }}</span>
                </div>
            </div>

        </div>

        <!-- Quick Access Section -->
        <div class="mt-10">
            <h2 class="text-xl font-bold text-[#2b3674]">Akses Cepat</h2>
            <div class="border-b border-indigo-100/40 my-4"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                
                <!-- Card 1: Tambah Destinasi -->
                <a href="{{ route('admin.destinasi.create') }}" class="flex items-center justify-center p-8 bg-[#3F5C7D] hover:bg-[#344d6b] text-white rounded-2xl shadow-md transition-all duration-300 transform hover:scale-[1.01] active:scale-[0.99] font-semibold text-lg">
                    <!-- Map Pin Plus Icon -->
                    <x-lucide-map-pin-plus class="w-6 h-6 mr-3 shrink-0" />
                    <span>Tambah Destinasi</span>
                </a>

                <!-- Card 2: Tambah Blog Artikel -->
                <a href="{{ Route::has('admin.blog.create') ? route('admin.blog.create') : '#' }}" class="flex items-center justify-center p-8 bg-[#3F5C7D] hover:bg-[#344d6b] text-white rounded-2xl shadow-md transition-all duration-300 transform hover:scale-[1.01] active:scale-[0.99] font-semibold text-lg">
                    <!-- Document Text Plus Icon -->
                    <x-lucide-file-plus class="w-6 h-6 mr-3 shrink-0" />
                    <span>Tambah Blog</span>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
