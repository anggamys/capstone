<x-guest-portal-layout>
    <x-slot name="title">{{ $destination->name }} - Detail Wisata</x-slot>

    <div x-data="{ imageModalOpen: false }">

    <!-- Breadcrumbs Section -->
    <div class="bg-white border-b border-slate-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2.5 text-xs text-slate-500 font-sans">
                <a href="/" class="hover:text-[#3F5C7D] transition-colors flex items-center gap-1 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Home
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-2.5 h-2.5 text-slate-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
                <a href="/explore" class="hover:text-[#3F5C7D] transition-colors font-medium">Jelajah Destinasi</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-2.5 h-2.5 text-slate-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-[#3F5C7D] font-semibold truncate max-w-[150px] sm:max-w-none">{{ $destination->name }}</span>
            </nav>
        </div>
    </div>

    <!-- Header Banner Section with Dynamic CSS variable to avoid linter errors -->
    {!! '<' . 'style>.guest-banner-bg { background-image: url(' . $destination->image_url . '); }</' . 'style>' !!}
    <div class="relative bg-slate-900 bg-cover bg-center overflow-hidden py-24 md:py-32 flex items-center guest-banner-bg">
        <!-- Dark blue gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#12263f]/90 via-[#12263f]/60 to-[#12263f]/30 z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 text-white w-full text-left">
            <div class="max-w-4xl">
                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mb-4">
                    @if($destination->status === 'active')
                        <span class="inline-flex items-center gap-1.5 bg-emerald-500/10 backdrop-blur-sm text-emerald-400 text-xs font-semibold px-3.5 py-1.5 rounded-full border border-emerald-500/25">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-400 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Active
                        </span>
                    @endif
                    <span class="bg-white/10 backdrop-blur-sm text-slate-100 text-xs font-semibold px-3.5 py-1.5 rounded-full border border-white/20">
                        {{ $destination->category->name }}
                    </span>
                    @if($destination->subcategory)
                        <span class="bg-white/10 backdrop-blur-sm text-slate-100 text-xs font-semibold px-3.5 py-1.5 rounded-full border border-white/20">
                            {{ $destination->subcategory->name }}
                        </span>
                    @endif
                </div>

                <!-- Destination Title -->
                <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-4 leading-tight font-sans">
                    {{ $destination->name }}
                </h1>

                <!-- Location subtitle: Kecamatan + Banyuwangi -->
                <div class="flex items-center gap-2 text-slate-200 text-sm md:text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-rose-400 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <span class="font-sans font-light">{{ $destination->district }}, Banyuwangi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column: Tentang Destinasi & Detail Lokasi (2/3 width) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- 1. Tentang Destinasi Card -->
                    <div class="bg-white rounded-[2rem] p-8 shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-slate-100">
                        <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
                            <span class="p-2 bg-[#E6F7FA] text-[#3F5C7D] rounded-xl border border-[#CDEBF2]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 1 1 1.085 1.085l-.04.04m-2.137.882a.5.5 0 0 0-.276.182l-.4.5a.5.5 0 0 0 .117.708l.5.4a.5.5 0 0 0 .708-.117l.4-.5a.5.5 0 0 0-.117-.708l-.5-.4a.5.5 0 0 0-.276-.117m-1.724-6.38a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </span>
                            <h2 class="text-lg font-bold text-[#3F5C7D] font-sans">Tentang Destinasi</h2>
                        </div>
                        
                        <!-- Clickable Image Preview inside card -->
                        <div class="mb-6">
                            <button @click="imageModalOpen = true" type="button" class="group block w-full overflow-hidden rounded-2xl md:rounded-3xl border border-slate-100 shadow-sm relative text-left focus:outline-none">
                                <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="w-full max-h-[350px] md:max-h-[400px] object-cover transition-transform duration-500 group-hover:scale-102">
                                <!-- Hover overlay -->
                                <div class="absolute inset-0 bg-[#12263f]/25 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                                    <span class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-xs font-semibold border border-white/30 flex items-center gap-1.5 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                                        </svg>
                                        Lihat Foto Penuh
                                    </span>
                                </div>
                            </button>
                        </div>

                        <div class="text-sm text-slate-500 leading-relaxed font-light font-sans whitespace-pre-line">
                            {{ $destination->description ?? 'Deskripsi tidak tersedia.' }}
                        </div>
                    </div>

                    <!-- 2. Detail Lokasi Card -->
                    <div class="bg-white rounded-[2rem] p-8 shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-slate-100">
                        <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
                            <span class="p-2 bg-[#E6F7FA] text-[#3F5C7D] rounded-xl border border-[#CDEBF2]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                            </span>
                            <h2 class="text-lg font-bold text-[#3F5C7D] font-sans">Detail Lokasi</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                            <div class="flex flex-col justify-between h-full space-y-6">
                                <div class="space-y-4 font-sans">
                                    <div>
                                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Alamat Lengkap</span>
                                        <p class="text-sm font-semibold text-slate-700 leading-relaxed">{{ $destination->address ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Kecamatan</span>
                                        <p class="text-sm font-semibold text-slate-700 leading-relaxed">{{ $destination->district ?? '-' }}</p>
                                    </div>
                                </div>

                                @if($destination->google_maps_url)
                                    <div>
                                        <a href="{{ $destination->google_maps_url }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-3 border border-[#3F5C7D]/20 text-[#3F5C7D] hover:bg-[#3F5C7D] hover:text-white text-xs font-bold uppercase tracking-wider rounded-xl transition-all duration-300 shadow-sm font-sans">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.446 1.202-.601a2.25 2.25 0 0 0 1.207-2.011V6.985a2.25 2.25 0 0 0-1.207-2.01l-1.202-.6a2.25 2.25 0 0 0-1.79 0l-3.038 1.519a2.25 2.25 0 0 1-1.79 0l-3.037-1.518a2.25 2.25 0 0 0-1.79 0L3.986 5.976A2.25 2.25 0 0 0 3 7.986v10.403a2.25 2.25 0 0 0 1.207 2.01l1.203.601a2.25 2.25 0 0 0 1.79 0l3.038-1.519a2.25 2.25 0 0 1 1.79 0l3.037 1.518a2.25 2.25 0 0 0 1.79 0Z" />
                                            </svg>
                                            Petunjuk Arah (Maps)
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- Embedded Map preview -->
                            <div class="relative min-h-[220px] rounded-2xl overflow-hidden border border-slate-100 shadow-sm bg-slate-50 w-full">
                                <iframe class="absolute inset-0 w-full h-full border-0" 
                                        src="https://maps.google.com/maps?q={{ urlencode($destination->name . ($destination->district ? ', ' . $destination->district : '') . ', Banyuwangi') }}&t=&z=14&ie=UTF8&iwloc=&output=embed" 
                                        allowfullscreen 
                                        loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Informasi Kunjungan & Kriteria Rekomendasi (1/3 width) -->
                <div class="space-y-8">
                    <!-- 3. Informasi Kunjungan Card -->
                    <div class="bg-white rounded-[2rem] p-8 shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-slate-100">
                        <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
                            <span class="p-2 bg-[#E6F7FA] text-[#3F5C7D] rounded-xl border border-[#CDEBF2]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </span>
                            <h2 class="text-lg font-bold text-[#3F5C7D] font-sans">Informasi Kunjungan</h2>
                        </div>

                        <div class="space-y-4 font-sans">
                            <div class="flex justify-between items-center py-2 border-b border-slate-50">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Harga Tiket</span>
                                <span class="text-sm font-semibold text-slate-700">
                                    @if($destination->ticket_price == 0)
                                        <span class="text-emerald-600 font-semibold bg-emerald-50 px-2.5 py-1 rounded-lg text-xs border border-emerald-100">Gratis</span>
                                    @else
                                        Rp {{ number_format($destination->ticket_price, 0, ',', '.') }}
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-50">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jam Operasional</span>
                                <span class="text-sm font-semibold text-slate-700">{{ $destination->operational_hours ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-50">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Estimasi Durasi</span>
                                <span class="text-sm font-semibold text-slate-700">{{ $destination->visit_duration_hours ? $destination->visit_duration_hours . ' Jam' : '-' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-50">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Rating Destinasi</span>
                                <span class="inline-flex items-center gap-1 text-sm font-semibold text-slate-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-amber-400">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                    </svg>
                                    {{ number_format($destination->rating, 1) }} / 5.0
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Aksesibilitas</span>
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-[#E6F7FA]/50 text-[#3F5C7D] border border-[#CDEBF2]/60">
                                    {{ $destination->access_level }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Kriteria Rekomendasi Card -->
                    <div class="bg-white rounded-[2rem] p-8 shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-slate-100">
                        <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
                            <span class="p-2 bg-[#E6F7FA] text-[#3F5C7D] rounded-xl border border-[#CDEBF2]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 21l-.813-5.096L3 15l5.096-.813L9 9l.813 5.096L15 15l-5.187.904ZM18.097 5.196 17.5 10l-.597-4.804L12 4.5l4.903-.597L17.5 0l.597 4.097L22.5 4.5l-4.403.696Z" />
                                </svg>
                            </span>
                            <h2 class="text-lg font-bold text-[#3F5C7D] font-sans">Kriteria Rekomendasi</h2>
                        </div>

                        <div class="space-y-5 font-sans">
                            <!-- Aktivitas -->
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Aktivitas Wisata</span>
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($destination->activities as $act)
                                        <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $act->name }}</span>
                                    @empty
                                        <span class="text-xs text-slate-400 italic font-light">Belum ada aktivitas.</span>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Fasilitas -->
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Fasilitas Pendukung</span>
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($destination->facilities as $fac)
                                        <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $fac->name }}</span>
                                    @empty
                                        <span class="text-xs text-slate-400 italic font-light">Belum ada fasilitas.</span>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Tipe Perjalanan -->
                            @if($destination->travelTypes->isNotEmpty())
                                <div>
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Cocok Untuk</span>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($destination->travelTypes as $type)
                                            <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $type->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Transportasi -->
                            @if($destination->transportations->isNotEmpty())
                                <div>
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Akses Transportasi</span>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($destination->transportations as $trans)
                                            <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $trans->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
    </div>

    <!-- Lightbox Modal -->
    <div 
        x-show="imageModalOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keydown.escape.window="imageModalOpen = false"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 md:p-10 bg-slate-950/80 backdrop-blur-sm"
        x-cloak
    >
        <!-- Modal Content Wrapper -->
        <div 
            @click.away="imageModalOpen = false" 
            class="relative bg-white rounded-[2rem] p-3 sm:p-4 shadow-2xl max-w-5xl w-full max-h-[90vh] flex flex-col items-center justify-center overflow-hidden border border-slate-100"
            x-show="imageModalOpen"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
        >
            <!-- Close Button -->
            <button 
                @click="imageModalOpen = false" 
                class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2 bg-slate-50 hover:bg-slate-100 rounded-full transition-colors z-20"
                aria-label="Close modal"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Image container -->
            <div class="w-full h-full flex items-center justify-center p-2">
                <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="max-w-full max-h-[80vh] object-contain rounded-2xl">
            </div>
        </div>
    </div>
</x-guest-portal-layout>
