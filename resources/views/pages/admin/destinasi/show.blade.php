<x-app-layout>
    <x-slot name="header">
        {{ __('Destinasi Wisata | Detail') }}
    </x-slot>

    <div class="py-2">
        <!-- Header Title & Action Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-[#2B3674]">Detail Destinasi Wisata</h1>
                <p class="text-sm text-slate-400 mt-1 font-medium">Lihat rincian lengkap mengenai destinasi wisata tersebut</p>
            </div>
            <div>
                <a href="{{ route('admin.destinasi.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#3F5C7D]/30 text-[#3F5C7D] hover:bg-[#3F5C7D]/5 text-sm font-bold rounded-2xl transition-all duration-200 shadow-sm">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Banner / Image Showcase -->
        <div class="mb-8 relative rounded-3xl overflow-hidden max-h-96 shadow-md border border-slate-100">
            @if($destination->main_image)
                <img src="{{ asset('storage/' . $destination->main_image) }}" alt="{{ $destination->name }}" class="w-full h-full object-cover max-h-96">
            @else
                <div class="w-full h-64 bg-slate-50 flex flex-col items-center justify-center text-slate-400 font-bold border border-dashed border-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-slate-300 mb-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    Belum ada Gambar Utama
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Side: Detail Specs (2 cols) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Box 1: Informasi Umum -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10">
                    <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
                        <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 1 1 1.085 1.085l-.04.04m-2.137.882a.5.5 0 0 0-.276.182l-.4.5a.5.5 0 0 0 .117.708l.5.4a.5.5 0 0 0 .708-.117l.4-.5a.5.5 0 0 0-.117-.708l-.5-.4a.5.5 0 0 0-.276-.117m-1.724-6.38a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </span>
                        <h2 class="text-base font-bold text-[#2B3674]">Informasi Umum</h2>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Nama Wisata</span>
                            <p class="text-lg font-bold text-[#2B3674]">{{ $destination->name }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Kategori / Subkategori</span>
                            <p class="text-sm font-semibold text-[#2B3674]">
                                {{ $destination->category->name }}
                                @if($destination->subcategory)
                                    / {{ $destination->subcategory->name }}
                                @endif
                            </p>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Deskripsi</span>
                            <div class="text-sm font-medium text-slate-600 leading-relaxed whitespace-pre-line">
                                {{ $destination->description ?? 'Tidak ada deskripsi.' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Box 2: Detail Lokasi -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10">
                    <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
                        <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </span>
                        <h2 class="text-base font-bold text-[#2B3674]">Detail Lokasi</h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
                        <!-- Left Side: Address Details -->
                        <div class="flex flex-col space-y-6">
                            <div class="space-y-6">
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
                                <div class="pt-2">
                                    <a href="{{ $destination->google_maps_url }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 border border-[#3F5C7D]/30 text-[#3F5C7D] hover:bg-[#3F5C7D]/5 text-sm font-bold rounded-xl transition-all duration-200 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.446 1.202-.601a2.25 2.25 0 0 0 1.207-2.011V6.985a2.25 2.25 0 0 0-1.207-2.01l-1.202-.6a2.25 2.25 0 0 0-1.79 0l-3.038 1.519a2.25 2.25 0 0 1-1.79 0l-3.037-1.518a2.25 2.25 0 0 0-1.79 0L3.986 5.976A2.25 2.25 0 0 0 3 7.986v10.403a2.25 2.25 0 0 0 1.207 2.01l1.203.601a2.25 2.25 0 0 0 1.79 0l3.038-1.519a2.25 2.25 0 0 1 1.79 0l3.037 1.518a2.25 2.25 0 0 0 1.79 0Z" />
                                        </svg>
                                        View on Google Maps
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Right Side: Interactive Map Preview -->
                        <div class="relative min-h-[280px] rounded-3xl overflow-hidden border border-slate-100 shadow-sm bg-slate-50 flex flex-col items-stretch">
                            <!-- Google Maps Search Iframe Embed -->
                            <iframe class="absolute inset-0 w-full h-full z-10 border-0" 
                                    src="https://maps.google.com/maps?q={{ urlencode($destination->name . ($destination->district ? ', ' . $destination->district : '') . ', Banyuwangi') }}&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                                    allowfullscreen 
                                    loading="lazy">
                            </iframe>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Visit Info & Recommendations (1 col) -->
            <div class="space-y-6">
                <!-- Box 3: Detail Kunjungan -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10">
                    <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
                        <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </span>
                        <h2 class="text-base font-bold text-[#2B3674]">Informasi Kunjungan</h2>
                    </div>
                    <div class="space-y-6">
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-slate-400 uppercase">Harga Tiket</span>
                            <span class="text-sm font-semibold text-slate-700">
                                @if($destination->ticket_price == 0)
                                    <span class="text-emerald-600 font-semibold bg-emerald-50 px-2.5 py-1 rounded-lg text-xs border border-emerald-100">Gratis</span>
                                @else
                                    Rp {{ number_format($destination->ticket_price, 0, ',', '.') }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-slate-400 uppercase">Jam Operasional</span>
                            <span class="text-sm font-semibold text-slate-700">{{ $destination->operational_hours ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-slate-400 uppercase">Estimasi Durasi</span>
                            <span class="text-sm font-semibold text-slate-700">{{ $destination->visit_duration_hours ? $destination->visit_duration_hours . ' Jam' : '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-slate-400 uppercase">Rating</span>
                            <span class="inline-flex items-center gap-1 text-sm font-semibold text-slate-700">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-amber-400">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                </svg>
                                {{ number_format($destination->rating, 1) }} / 5.0
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-slate-400 uppercase">Akses Perjalanan</span>
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-[#E6F7FA]/50 text-[#3F5C7D] border border-[#CDEBF2]/60">
                                {{ $destination->access_level }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-slate-400 uppercase">Status Keaktifan</span>
                            @if($destination->status === 'active')
                                <span class="inline-flex items-center gap-1.5 text-emerald-600 text-xs font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-rose-600 text-xs font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                    Tidak Aktif
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Box 4: Kriteria Rekomendasi -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10">
                    <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
                        <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 21l-.813-5.096L3 15l5.096-.813L9 9l.813 5.096L15 15l-5.187.904ZM18.097 5.196 17.5 10l-.597-4.804L12 4.5l4.903-.597L17.5 0l.597 4.097L22.5 4.5l-4.403.696Z" />
                            </svg>
                        </span>
                        <h2 class="text-base font-bold text-[#2B3674]">Kriteria Rekomendasi</h2>
                    </div>
                    <div class="space-y-6">
                        <!-- Aktivitas -->
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Aktivitas</span>
                            <div class="flex flex-wrap gap-1.5">
                                @forelse($destination->activities as $act)
                                    <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $act->name }}</span>
                                @empty
                                    <span class="text-xs text-slate-400 italic">Belum ada aktivitas.</span>
                                @endforelse
                            </div>
                        </div>

                        <!-- Fasilitas -->
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Fasilitas</span>
                            <div class="flex flex-wrap gap-1.5">
                                @forelse($destination->facilities as $fac)
                                    <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $fac->name }}</span>
                                @empty
                                    <span class="text-xs text-slate-400 italic">Belum ada fasilitas.</span>
                                @endforelse
                            </div>
                        </div>

                        <!-- Tipe Perjalanan -->
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Tipe Perjalanan</span>
                            <div class="flex flex-wrap gap-1.5">
                                @forelse($destination->travelTypes as $type)
                                    <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $type->name }}</span>
                                @empty
                                    <span class="text-xs text-slate-400 italic">Belum ada tipe perjalanan.</span>
                                @endforelse
                            </div>
                        </div>

                        <!-- Waktu Kunjungan -->
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Waktu Kunjungan</span>
                            <div class="flex flex-wrap gap-1.5">
                                @forelse($destination->visitTimes as $time)
                                    <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $time->name }}</span>
                                @empty
                                    <span class="text-xs text-slate-400 italic">Belum ada waktu kunjungan.</span>
                                @endforelse
                            </div>
                        </div>

                        <!-- Transportasi -->
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Transportasi</span>
                            <div class="flex flex-wrap gap-1.5">
                                @forelse($destination->transportations as $trans)
                                    <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $trans->name }}</span>
                                @empty
                                    <span class="text-xs text-slate-400 italic">Belum ada transportasi.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
