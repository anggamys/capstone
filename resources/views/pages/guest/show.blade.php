<x-guest-portal-layout>
    <x-slot name="title">{{ $destination->name }} - Detail Wisata</x-slot>

    <div x-data="{ imageModalOpen: false }">

    <!-- Breadcrumbs Section -->
    <div class="bg-white border-b border-slate-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2.5 text-xs text-slate-500 font-sans">
                <a href="/" class="hover:text-[#3F5C7D] transition-colors flex items-center gap-1 font-medium">
                    <x-lucide-home class="w-3.5 h-3.5 text-slate-400" />
                    Home
                </a>
                <x-lucide-chevron-right class="w-2.5 h-2.5 text-slate-300" stroke-width="3" />
                <a href="/explore" class="hover:text-[#3F5C7D] transition-colors font-medium">Jelajah Destinasi</a>
                <x-lucide-chevron-right class="w-2.5 h-2.5 text-slate-300" stroke-width="3" />
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
                            <x-lucide-check-circle class="w-4 h-4 text-emerald-400 shrink-0" />
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
                    <x-lucide-map-pin class="w-4 h-4 text-rose-400 shrink-0" stroke-width="2.5" />
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
                                <x-lucide-info class="w-5 h-5" stroke-width="2.5" />
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
                                        <x-lucide-zoom-in class="w-4 h-4" stroke-width="2.5" />
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
                                <x-lucide-map-pin class="w-5 h-5" stroke-width="2.5" />
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
                                            <x-lucide-navigation class="w-4 h-4 mr-1" stroke-width="2.5" />
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
                                <x-lucide-clock class="w-5 h-5" stroke-width="2.5" />
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
                                    <x-lucide-star class="w-4 h-4 text-amber-400 fill-amber-400" />
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
                                <x-lucide-sparkles class="w-5 h-5" stroke-width="2.5" />
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
                <x-lucide-x class="w-5 h-5" stroke-width="2.5" />
            </button>

            <!-- Image container -->
            <div class="w-full h-full flex items-center justify-center p-2">
                <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="max-w-full max-h-[80vh] object-contain rounded-2xl">
            </div>
        </div>
    </div>
</x-guest-portal-layout>
