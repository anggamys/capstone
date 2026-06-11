<x-app-layout>
    <x-slot name="header">
        {{ __('Riwayat Preferensi User | Detail') }}
    </x-slot>

    @php
        $mappedCategories = collect($history->categories)->map(fn($id) => $categoryMap[$id] ?? $id);
        $mappedActivities = collect($history->activities)->map(fn($id) => $activityMap[$id] ?? $id);
        $mappedVisitTimes = collect($history->visit_times)->map(fn($id) => $visitTimeMap[$id] ?? $id);

        $categoriesString = $mappedCategories->isNotEmpty() ? $mappedCategories->join(', ') : 'Semua Kategori';
        $travelTypeName = $history->travelType?->name ?? 'Kustom/Semua Gaya';
        $transportName = $history->transportation?->name ?? 'Semua Transportasi';
        $budgetText = $history->budget ?? 'hemat';
        
        $summarySentence = "Hasil rekomendasi ini didasarkan pada ketertarikan pengunjung terhadap kategori wisata <strong>" . e($categoriesString) . "</strong> dengan gaya perjalanan <strong>" . e($travelTypeName) . "</strong> menggunakan kendaraan <strong>" . e($transportName) . "</strong> serta anggaran bertipe <strong>" . e(ucfirst($budgetText)) . "</strong>.";
    @endphp

    <div class="py-2">
        <!-- Header Title & Action Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-[#2B3674]">Detail Riwayat Preferensi</h1>
                <p class="text-sm text-slate-400 mt-1 font-medium">Lihat rincian kustomisasi preferensi liburan dari pengunjung website.</p>
            </div>
            <div>
                <a href="{{ route('admin.riwayat-preferensi.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#3F5C7D]/30 text-[#3F5C7D] hover:bg-[#3F5C7D]/5 text-sm font-bold rounded-2xl transition-all duration-200 shadow-sm">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Detail Content Wrapper -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Side: Visitor Info & Primary Preferences -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Card 1: Informasi Pemohon & Preferensi Dasar -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10">
                    <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-4">
                        <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                            <x-lucide-user class="w-5 h-5" stroke-width="2.5" />
                        </span>
                        <h2 class="text-base font-bold text-[#2B3674]">Informasi Pemohon</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Pemohon</label>
                            <div class="px-5 py-4 bg-[#F4F7FE]/60 text-[#2B3674] font-bold rounded-2xl text-sm border-none">
                                @if($history->user)
                                    {{ $history->user->name }}
                                @else
                                    <span class="text-[#2B3674] font-bold">Guest #{{ substr($history->guest_token ?? 'Anonim', 0, 6) }}</span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Email Pemohon / Token</label>
                            <div class="px-5 py-4 bg-[#F4F7FE]/60 text-[#2B3674] rounded-2xl text-sm border-none font-sans">
                                @if($history->user)
                                    {{ $history->user->email }}
                                @else
                                    <span class="text-[#2B3674] font-semibold">Token: #{{ substr($history->guest_token ?? 'Anonim', 0, 6) }}</span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tanggal Pengajuan</label>
                            <div class="px-5 py-4 bg-[#F4F7FE]/60 text-slate-600 rounded-2xl text-sm border-none">
                                {{ $history->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                            </div>
                        </div>
                    </div>

                    <!-- Core Preference Sub-Grid -->
                    <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-4">
                        <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                            <x-lucide-sliders class="w-5 h-5" stroke-width="2.5" />
                        </span>
                        <h2 class="text-base font-bold text-[#2B3674]">Kombinasi Preferensi Utama</h2>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100/60">
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block">Gaya Perjalanan</span>
                            <span class="text-sm font-bold text-[#2B3674] mt-0.5 block">{{ $history->travelType?->name ?? 'Semua Gaya' }}</span>
                        </div>
                        <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100/60">
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block">Kendaraan Utama</span>
                            <span class="text-sm font-bold text-[#2B3674] mt-0.5 block">{{ $history->transportation?->name ?? 'Semua Kendaraan' }}</span>
                        </div>
                        <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100/60">
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block">Anggaran Tiket</span>
                            <span class="text-sm font-bold text-[#2B3674] mt-0.5 block capitalize">{{ $history->budget ?? 'hemat' }}</span>
                        </div>
                        <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100/60">
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block">Aksesibilitas</span>
                            <span class="text-sm font-bold text-[#2B3674] mt-0.5 block capitalize">{{ $history->access_level ?? 'sedang' }}</span>
                        </div>
                        <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100/60">
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block">Kepadatan Destinasi</span>
                            <span class="text-sm font-bold text-[#2B3674] mt-0.5 block capitalize">{{ $history->crowd_level ?? 'sedang' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Kategori & Aktivitas Pilihan -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10">
                    <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-4">
                        <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                            <x-lucide-tags class="w-5 h-5" stroke-width="2.5" />
                        </span>
                        <h2 class="text-base font-bold text-[#2B3674]">Pilihan Kategori & Aktivitas</h2>
                    </div>

                    <div class="space-y-6">
                        <!-- Kategori Wisata -->
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Kategori Wisata Pilihan</h4>
                            <div class="flex flex-wrap gap-2">
                                @forelse($mappedCategories as $cat)
                                    <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $cat }}</span>
                                @empty
                                    <span class="text-xs font-medium text-slate-400 italic">Semua Kategori</span>
                                @endforelse
                            </div>
                        </div>

                        <!-- Aktivitas Pilihan -->
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Aktivitas Liburan Pilihan</h4>
                            <div class="flex flex-wrap gap-2">
                                @forelse($mappedActivities as $act)
                                    <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $act }}</span>
                                @empty
                                    <span class="text-xs font-medium text-slate-400 italic">Semua Aktivitas</span>
                                @endforelse
                            </div>
                        </div>

                        <!-- Waktu Kunjungan -->
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Waktu Kunjungan</h4>
                            <div class="flex flex-wrap gap-2">
                                @forelse($mappedVisitTimes as $time)
                                    <span class="bg-[#E6F7FA]/50 text-[#3F5C7D] px-3.5 py-1.5 rounded-full text-xs font-semibold border border-[#CDEBF2]/60">{{ $time }}</span>
                                @empty
                                    <span class="text-xs font-medium text-slate-400 italic">Semua Waktu</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Recommended Destinations Generated -->
            <div class="space-y-6">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10 h-full flex flex-col">
                    <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-4 shrink-0">
                        <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                            <x-lucide-sparkles class="w-5 h-5 text-[#89A8E0]" stroke-width="2.5" />
                        </span>
                        <h2 class="text-base font-bold text-[#2B3674]">Hasil Rekomendasi (Top {{ count($history->recommendations ?? []) }})</h2>
                    </div>

                    <div class="flex-1 space-y-4">
                        @forelse($history->recommendations ?? [] as $index => $rec)
                            <div class="flex items-center gap-4 bg-[#F8FAFC] p-3.5 rounded-2xl border border-slate-100 hover:border-[#89A8E0]/45 hover:shadow-sm transition-all duration-200">
                                <!-- Photo next to number -->
                                <img src="{{ $destinationImageMap[$rec] ?? asset('images/bg-login.jpg') }}" 
                                     alt="{{ $rec }}" 
                                     class="w-16 h-16 rounded-xl object-cover shrink-0 shadow-sm border border-slate-200/50">
                                
                                <div class="flex-1">
                                    <!-- Number right next to title -->
                                    <span class="text-sm font-bold text-[#2B3674] block leading-tight">
                                        {{ $index + 1 }}. {{ $rec }}
                                    </span>
                                    <span class="text-[10px] text-[#89A8E0] font-semibold tracking-wide uppercase mt-1 block">Destinasi Rekomendasi</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-slate-400">
                                <x-lucide-compass class="w-12 h-12 text-slate-300 mx-auto mb-3" stroke-width="1.5" />
                                <span class="text-xs font-medium italic">Tidak ada data rekomendasi</span>
                            </div>
                        @endforelse
                    </div>

                    <!-- Summary Info Box -->
                    <div class="mt-6 pt-6 border-t border-slate-100 shrink-0">
                        <div class="flex items-start gap-3 bg-[#E6F7FA]/30 border border-[#CDEBF2]/50 p-4 rounded-2xl text-[#3F5C7D] text-xs leading-relaxed font-sans">
                            <x-lucide-info class="w-4 h-4 text-[#3F5C7D] shrink-0 mt-0.5" stroke-width="2.5" />
                            <div>
                                {!! $summarySentence !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
