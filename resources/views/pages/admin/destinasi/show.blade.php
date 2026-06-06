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
                <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="w-full h-full object-cover max-h-96">
            @else
                <div class="w-full h-64 bg-slate-50 flex flex-col items-center justify-center text-slate-400 font-bold border border-dashed border-slate-200">
                    <x-lucide-image class="w-12 h-12 text-slate-300 mb-2" stroke-width="1.5" />
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
                            <x-lucide-info class="w-5 h-5" stroke-width="2.5" />
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
                            <x-lucide-map-pin class="w-5 h-5" stroke-width="2.5" />
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
                                        <x-lucide-navigation class="w-4 h-4 mr-1" stroke-width="2" />
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
                            <x-lucide-clock class="w-5 h-5" stroke-width="2.5" />
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
                                <x-lucide-star class="w-4 h-4 text-amber-400 fill-amber-400" />
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
                            <x-lucide-sparkles class="w-5 h-5" stroke-width="2.5" />
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
