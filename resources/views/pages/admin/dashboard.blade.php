<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Admin') }}
    </x-slot>

    <div class="py-4">
        <!-- Welcome Message -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#2b3674] tracking-tight">
                Selamat Datang di Panel Admin Laras Banyuwangi
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Pantau destinasi, blog artikel dan hasil rekomendasi destinasi secara real-time.
            </p>
        </div>

        <!-- Stats Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Card 1: Total Destinasi -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-indigo-50/50 flex items-center transition-all duration-200 hover:shadow-md">
                <div class="w-12 h-12 rounded-2xl bg-[#E6F7FA] flex items-center justify-center text-[#3F5C7D] border border-[#CDEBF2] shrink-0">
                    <!-- Map Pin Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Total Blog Artikel</span>
                    <span class="text-2xl font-bold text-[#2b3674] mt-0.5 block">{{ $totalBlogArtikel ?? 0 }}</span>
                </div>
            </div>

            <!-- Card 3: Total Rekomendasi User -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-indigo-50/50 flex items-center transition-all duration-200 hover:shadow-md">
                <div class="w-12 h-12 rounded-2xl bg-[#ebf0fc] flex items-center justify-center text-[#89A8E0] border border-indigo-100/30 shrink-0">
                    <!-- Thumbs Up Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904M14.25 9h2.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                    </svg>
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
                <a href="#" class="flex items-center justify-center p-8 bg-[#3F5C7D] hover:bg-[#344d6b] text-white rounded-2xl shadow-md transition-all duration-300 transform hover:scale-[1.01] active:scale-[0.99] font-semibold text-lg">
                    <!-- Map Pin Plus Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 mr-3 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 3v4M21 5h-4" />
                    </svg>
                    <span>Tambah Destinasi</span>
                </a>

                <!-- Card 2: Tambah Blog Artikel -->
                <a href="{{ Route::has('admin.blog-artikel.create') ? route('admin.blog-artikel.create') : '#' }}" class="flex items-center justify-center p-8 bg-[#3F5C7D] hover:bg-[#344d6b] text-white rounded-2xl shadow-md transition-all duration-300 transform hover:scale-[1.01] active:scale-[0.99] font-semibold text-lg">
                    <!-- Document Text Plus Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 mr-3 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span>Tambah Blog Artikel</span>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
