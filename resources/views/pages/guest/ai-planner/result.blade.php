<x-guest-portal-layout>
    <x-slot name="title">Rekomendasi AI Planner - Laras Banyuwangi</x-slot>

    @php
        // Fetch selected model objects dynamically from the database to render search criteria badges
        $categoriesList = \App\Models\DestinationCategory::whereIn('id', (array)$selectedCategories)->get();
        $travelTypeObj = \App\Models\TravelType::find($selectedTravelType);
        $transportationObj = \App\Models\Transportation::find($selectedTrans);
        $visitTimeList = \App\Models\VisitTime::whereIn('id', (array)$selectedVisit)->get();

        $selectedBudgetKey = is_string($selectedBudget) || is_int($selectedBudget) ? (string)$selectedBudget : '';
        $selectedAccessKey = is_string($selectedAccess) || is_int($selectedAccess) ? (string)$selectedAccess : '';
        $selectedCrowdKey = is_string($selectedCrowd) || is_int($selectedCrowd) ? (string)$selectedCrowd : '';

        $budgetMap = [
            'hemat' => '💵 Hemat (< Rp 15rb)',
            'sedang' => '💳 Sedang (Rp 15rb - Rp 50rb)',
            'mewah' => '💎 Mewah (> Rp 50rb)'
        ];

        $accessMap = [
            'mudah' => '🟢 Akses Mudah',
            'sedang' => '🟡 Akses Sedang',
            'menantang' => '🔴 Akses Menantang'
        ];

        $crowdMap = [
            'sepi' => '🤫 Sepi & Tenang',
            'sedang' => '⚖️ Sedang / Normal',
            'ramai' => '🔥 Ramai / Populer'
        ];
    @endphp

    <!-- Header Section -->
    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="max-w-3xl">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-[#3F5C7D] font-sans tracking-tight mb-2">Rekomendasi Wisata untukmu</h1>
                    <p class="text-slate-500 text-sm md:text-base font-light leading-relaxed font-sans">
                        Berikut destinasi Banyuwangi yang paling selaras dengan preferensi perjalananmu. Algoritma harmoni kami telah menyusun rencana terbaik untuk eksplorasimu.
                    </p>
                </div>
                <div class="shrink-0 flex items-center gap-3">
                    <!-- Download PDF Button -->
                    <button id="download-pdf-btn" type="button" class="px-5 py-3 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold uppercase tracking-wider rounded-xl transition-all duration-300 shadow-sm flex items-center gap-2 cursor-pointer font-sans">
                        <x-lucide-file-down class="h-4 w-4 text-slate-500" stroke-width="2.5" />
                        Unduh PDF
                    </button>

                    <!-- Cari Lagi Button -->
                    <a href="{{ route('planner') }}" class="px-5 py-3 bg-[#3F5C7D] hover:bg-[#344d6b] text-white text-xs font-semibold uppercase tracking-wider rounded-xl transition-all duration-300 shadow-md flex items-center gap-2 cursor-pointer font-sans border-none">
                        <x-lucide-rotate-ccw class="h-4 w-4" stroke-width="2.5" />
                        Cari Lagi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid Section -->
    <div class="pb-16 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
                
                <!-- Left Sidebar: Profil Perjalananmu Card -->
                <div class="lg:col-span-1 bg-white rounded-[2rem] border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.01)] p-6 flex flex-col gap-6">
                    <div>
                        <h2 class="text-xl font-bold text-[#3F5C7D] font-sans leading-tight">Profil Perjalananmu</h2>
                    </div>
                    
                    <!-- Gaya Wisata Section -->
                    <div class="flex flex-col gap-2">
                        <span class="text-[10px] tracking-wider uppercase text-slate-400 font-bold font-sans">GAYA WISATA</span>
                        <div class="flex flex-wrap gap-1.5">
                            <!-- Travel Style (Gaya Travel) -->
                            @if($travelTypeObj)
                                <span class="px-2.5 py-1.5 bg-[#E6F7FA] text-[#3F5C7D] text-[11px] font-semibold rounded-lg border border-[#CDEBF2]">{{ $travelTypeObj->name }}</span>
                            @endif
                            <!-- Categories Selected -->
                            @foreach($categoriesList as $cat)
                                <span class="px-2.5 py-1.5 bg-[#E6F7FA] text-[#3F5C7D] text-[11px] font-semibold rounded-lg border border-[#CDEBF2]">{{ $cat->name }}</span>
                            @endforeach
                            @if(!$travelTypeObj && $categoriesList->isEmpty())
                                <span class="px-2.5 py-1.5 bg-slate-100 text-slate-500 text-[11px] font-semibold rounded-lg border border-slate-200">Kustom</span>
                            @endif
                        </div>
                    </div>

                    <!-- Durasi & Anggaran Section -->
                    <div class="flex flex-col gap-2">
                        <span class="text-[10px] tracking-wider uppercase text-slate-400 font-bold font-sans">DURASI & ANGGARAN</span>
                        <span class="text-sm font-bold text-slate-700 font-sans">
                            {{ $visitTimeList->isNotEmpty() ? $visitTimeList->pluck('name')->join(' & ') : 'Fleksibel' }} • {{ isset($budgetMap[$selectedBudgetKey]) ? str_replace(['💵 ', '💳 ', '💎 '], '', explode(' (', $budgetMap[$selectedBudgetKey])[0]) : 'Hemat' }}
                        </span>
                    </div>

                    <!-- Kebutuhan Khusus Section -->
                    <div class="flex flex-col gap-2">
                        <span class="text-[10px] tracking-wider uppercase text-slate-400 font-bold font-sans">KEBUTUHAN KHUSUS</span>
                        <div class="flex flex-col gap-2.5">
                            <!-- Transportation -->
                            @if($transportationObj)
                                <div class="flex items-center gap-2 text-slate-600 text-xs font-sans">
                                    <x-lucide-car class="w-4 h-4 text-slate-400 shrink-0" stroke-width="2" />
                                    <span>{{ $transportationObj->name }}</span>
                                </div>
                            @endif
                            <!-- Crowd -->
                            <div class="flex items-center gap-2 text-slate-600 text-xs font-sans">
                                <x-lucide-users class="w-4 h-4 text-slate-400 shrink-0" stroke-width="2" />
                                <span>{{ $selectedCrowdKey === 'sepi' ? 'Suasana Tenang' : ($selectedCrowdKey === 'ramai' ? 'Suasana Ramai' : 'Suasana Sedang') }}</span>
                            </div>
                            <!-- Physical Activity / Access level -->
                            <div class="flex items-center gap-2 text-slate-600 text-xs font-sans">
                                <x-lucide-accessibility class="w-4 h-4 text-slate-400 shrink-0" stroke-width="2" />
                                <span>{{ $selectedAccessKey === 'mudah' ? 'Aktivitas Fisik: Rendah' : ($selectedAccessKey === 'menantang' ? 'Aktivitas Fisik: Tinggi' : 'Aktivitas Fisik: Sedang') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Notes based on selection -->
                    @if($categoriesList->isNotEmpty())
                        <div class="bg-[#E6F7FA]/30 rounded-2xl p-4 border border-[#CDEBF2]/50 text-xs text-[#3F5C7D] leading-relaxed font-sans mt-2">
                            <div class="flex items-start gap-1.5">
                                <x-lucide-info class="w-4 h-4 text-[#3F5C7D] shrink-0 mt-0.5" stroke-width="2" />
                                <span>Hasil ini didasarkan pada ketertarikanmu pada kategori wisata {{ strtolower($categoriesList->pluck('name')->join(', ')) }}.</span>
                            </div>
                        </div>
                    @endif

               </div>

               <!-- Right Column: Destinations Grid -->
               <div class="lg:col-span-3">
                   @if(count($recommendations) > 0)
                       <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                           @foreach($recommendations as $rec)
                               <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-[0_10px_25px_rgba(0,0,0,0.02)] hover:shadow-xl transition-[box-shadow] duration-500 overflow-hidden flex flex-col justify-between h-full isolate">
                                   
                                   <!-- Top Part: Image & Tags -->
                                   <div>
                                       <div class="relative overflow-hidden aspect-[16/10] bg-slate-100 transform-gpu">
                                           <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out transform-gpu will-change-transform" src="{{ $rec['image'] }}" alt="{{ $rec['name'] }}">
                                           
                                           <!-- Match Score Badge overlay (Akurasi di Kiri Atas) -->
                                           <span class="absolute top-4 left-4 bg-[#3F5C7D]/85 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1.5 rounded-full border border-white/10 flex items-center gap-1.5 shadow-sm font-sans">
                                               <x-lucide-zap class="h-3.5 w-3.5 fill-amber-400 text-amber-400 shrink-0" stroke-width="2" />
                                               {{ $rec['match_score'] }}% Cocok
                                           </span>

                                           <!-- Category Badge overlay (Kategori di Kanan Atas) -->
                                           <span class="absolute top-4 right-4 bg-[#E6F7FA] text-[#3F5C7D] text-[10px] font-bold px-3 py-1.5 rounded-full border border-[#CDEBF2] shadow-sm font-sans">
                                               {{ $rec['category'] }}
                                           </span>
                                       </div>

                                       <!-- Destination Title & Price -->
                                       <div class="px-6 pt-5 flex items-start justify-between gap-4">
                                           <h3 class="text-lg font-bold text-[#3F5C7D] font-sans leading-tight line-clamp-2">
                                               {{ $rec['name'] }}
                                           </h3>
                                           <span class="text-sm font-semibold text-[#8ED3D8] shrink-0 font-sans">
                                               {{ $rec['budget'] }}
                                           </span>
                                       </div>

                                        <!-- Location -->
                                        <div class="px-6 mt-2 flex items-center gap-1 text-slate-400 text-xs font-light font-sans">
                                            <x-lucide-map-pin class="h-3.5 w-3.5 text-slate-400 shrink-0" stroke-width="2" />
                                            <span>{{ $rec['district'] }}, Banyuwangi</span>
                                        </div>

                                       <!-- Specs Container (4-grid layout) -->
                                       <div class="px-6 py-4 mt-4 grid grid-cols-2 gap-x-4 gap-y-3 border-y border-slate-50 text-xs">
                                           <!-- Spec 1: Access Level -->
                                           <div class="flex items-center gap-2 text-slate-500 font-sans">
                                               <x-lucide-accessibility class="w-4 h-4 text-slate-400 shrink-0" stroke-width="2" />
                                               <span class="font-light truncate">Akses {{ ucfirst($rec['access_level']) }}</span>
                                           </div>
                                           <!-- Spec 2: Open Hours -->
                                           <div class="flex items-center gap-2 text-slate-500 font-sans">
                                               <x-lucide-clock class="w-4 h-4 text-slate-400 shrink-0" stroke-width="2" />
                                               <span class="font-light truncate">{{ $rec['best_time'] }}</span>
                                           </div>
                                           <!-- Spec 3: Activities -->
                                           <div class="flex items-center gap-2 text-slate-500 font-sans">
                                               <x-lucide-compass class="w-4 h-4 text-slate-400 shrink-0" stroke-width="2" />
                                               <span class="font-light truncate" title="{{ $rec['activities'] ?: 'Rekreasi' }}">{{ $rec['activities'] ?: 'Rekreasi' }}</span>
                                           </div>
                                           <!-- Spec 4: Facilities -->
                                           <div class="flex items-center gap-2 text-slate-500 font-sans">
                                               <x-lucide-building class="w-4 h-4 text-slate-400 shrink-0" stroke-width="2" />
                                               <span class="font-light truncate" title="{{ $rec['facilities'] ?: 'Toilet, Parkir' }}">{{ $rec['facilities'] ?: 'Toilet, Parkir' }}</span>
                                           </div>
                                       </div>

                                       <!-- AI Recommendation Reason -->
                                       <div class="px-6 pt-4">
                                           <div class="p-4 bg-[#E6F7FA]/30 border border-[#CDEBF2]/40 rounded-2xl text-xs text-slate-600 leading-relaxed font-light font-sans relative">
                                               <span class="absolute top-2 left-2 text-[#8ED3D8] font-serif text-lg leading-none opacity-80">“</span>
                                               <p class="pl-3 italic">{{ $rec['reason'] }}</p>
                                           </div>
                                       </div>
                                   </div>

                                   <!-- Bottom Part: CTA Buttons -->
                                   <div class="p-6 flex gap-3">
                                       @if(!empty($rec['google_maps_url']))
                                           <a href="{{ $rec['google_maps_url'] }}" target="_blank" class="flex-1 px-4 py-3 bg-white border border-[#3F5C7D]/20 hover:bg-slate-50 text-[#3F5C7D] font-semibold text-xs rounded-xl transition-all flex items-center justify-center gap-2 font-sans shadow-sm">
                                               <x-lucide-map class="w-3.5 h-3.5" stroke-width="2" />
                                               Buka di Maps
                                           </a>
                                       @endif
                                       <a href="{{ route('explore.show', $rec['slug']) }}" class="{{ !empty($rec['google_maps_url']) ? 'flex-1' : 'w-full' }} px-5 py-3 bg-[#3F5C7D] hover:bg-[#344d6b] text-white font-semibold text-xs rounded-xl transition-all flex items-center justify-center gap-2 font-sans shadow-sm">
                                           Lihat Detail <x-lucide-arrow-right class="w-3.5 h-3.5" stroke-width="2.5" />
                                       </a>
                                   </div>

                               </div>
                           @endforeach
                       </div>
                   @else
                       <!-- No Recommendations Found -->
                       <div class="bg-white border border-slate-100 p-12 rounded-[2rem] text-center shadow-sm max-w-md mx-auto">
                           <div class="w-16 h-16 rounded-2xl bg-[#E6F7FA] text-[#89A8E0] flex items-center justify-center mx-auto mb-5 border border-[#CDEBF2]">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                               </svg>
                           </div>
                           <h3 class="text-xl font-bold text-[#3F5C7D] mb-2 font-sans">Destinasi Tidak Ditemukan</h3>
                           <p class="text-slate-400 font-sans font-light leading-relaxed mb-6 text-sm">
                               Maaf, kami tidak menemukan destinasi aktif yang cocok dengan kriteria pencarian Anda saat ini.
                           </p>
                           <a href="{{ route('planner') }}" class="px-5 py-2.5 bg-[#3F5C7D] hover:bg-[#344d6b] text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-md transition-all font-sans inline-block">
                               Sesuaikan Ulang
                           </a>
                       </div>
                   @endif
               </div>

           </div>
       </div>
    </div>

    <!-- Hidden DOM element to pass data to JS safely without mixing Blade and JS syntax -->
    <div id="ai-planner-data" class="hidden"
         data-categories="{{ json_encode($categoriesList->pluck('name')->toArray()) }}"
         data-travel-type="{{ $travelTypeObj?->name ?? 'Kustom' }}"
         data-selected-categories="{{ json_encode((array)$selectedCategories) }}"
         data-selected-visit="{{ json_encode((array)$selectedVisit) }}"
         data-selected-travel-type="{{ $selectedTravelType ?? '' }}"
         data-selected-trans="{{ $selectedTrans ?? '' }}"
         data-selected-budget="{{ $selectedBudget ?? '' }}"
         data-selected-access="{{ $selectedAccess ?? '' }}"
         data-selected-crowd="{{ $selectedCrowd ?? '' }}"
         data-result-url="{{ route('planner.result') }}"
         data-destinations="{{ json_encode(collect($recommendations)->pluck('name')->toArray()) }}">
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <!-- Hidden PDF Template specially designed for export -->
    <div id="pdf-template" class="hidden">
        <div class="p-8 bg-white text-slate-800 font-sans" style="font-family: 'Inter', sans-serif; width: 750px; margin: 0 auto;">
            <!-- Banner Image with Title overlay -->
            <div class="relative rounded-2xl overflow-hidden h-[180px] mb-8 bg-slate-900" style="position: relative; overflow: hidden; height: 180px; margin-bottom: 2rem;">
                @if(isset($recommendations[0]))
                    <img src="{{ $recommendations[0]['image'] }}" class="absolute inset-0 w-full h-full object-cover" style="position: absolute; width: 100%; height: 100%; object-fit: cover; opacity: 0.55;" alt="Banner Image">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-900/20 to-transparent" style="position: absolute; inset: 0; background: linear-gradient(0deg, rgba(2, 6, 23, 0.8) 0%, rgba(15, 23, 42, 0.2) 60%, transparent 100%);"></div>
                <div class="absolute bottom-6 left-6 text-white" style="position: absolute; bottom: 1.5rem; left: 1.5rem; color: #ffffff;">
                    <h1 class="text-2xl font-bold mb-1" style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem;">Petualangan Banyuwangi Bersama AI</h1>
                    <div class="flex items-center gap-4 text-xs font-light text-slate-200" style="display: flex; gap: 1rem; font-size: 0.75rem; color: #e2e8f0;">
                        <span style="display: inline-flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 4px; color: #a5b4fc;"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            <span id="pdf-download-date">{{ date('d M Y') }}</span>
                        </span>
                        <span style="display: inline-flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 4px; color: #f43f5e;"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            Banyuwangi, Indonesia
                        </span>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Penting -->
            <div class="mb-8" style="margin-bottom: 2rem;">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2" style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.5rem; margin-bottom: 1rem;">Ringkasan Penting</h3>
                <table style="width: 100%; border-collapse: collapse; font-size: 0.75rem; color: #334155;">
                    <tr>
                        <td style="width: 33.3%; padding: 0.5rem 0; vertical-align: top;">
                            <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background-color: #f1f5f9; border-radius: 6px; margin-top: 2px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #3F5C7D;"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </span>
                                <div>
                                    <p style="color: #94a3b8; font-weight: 500; margin: 0;">Gaya Perjalanan</p>
                                    <p style="font-weight: 700; color: #1e293b; margin: 0.125rem 0 0 0;">{{ $travelTypeObj?->name ?? 'Kustom' }}</p>
                                </div>
                            </div>
                        </td>
                        <td style="width: 33.3%; padding: 0.5rem 0; vertical-align: top;">
                            <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background-color: #ecfdf5; border-radius: 6px; margin-top: 2px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #10b981;"><rect width="20" height="12" x="2" y="6" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/></svg>
                                </span>
                                <div>
                                    <p style="color: #94a3b8; font-weight: 500; margin: 0;">Anggaran</p>
                                    <p style="font-weight: 700; color: #1e293b; margin: 0.125rem 0 0 0;">{{ isset($budgetMap[$selectedBudgetKey]) ? str_replace(['💵 ', '💳 ', '💎 '], '', explode(' (', $budgetMap[$selectedBudgetKey])[0]) : 'Hemat' }}</p>
                                </div>
                            </div>
                        </td>
                        <td style="width: 33.3%; padding: 0.5rem 0; vertical-align: top;">
                            <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background-color: #f8fafc; border-radius: 6px; margin-top: 2px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #64748b;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </span>
                                <div>
                                    <p style="color: #94a3b8; font-weight: 500; margin: 0;">Waktu Kunjungan</p>
                                    <p style="font-weight: 700; color: #1e293b; margin: 0.125rem 0 0 0;">{{ $visitTimeList->isNotEmpty() ? $visitTimeList->pluck('name')->join(', ') : 'Fleksibel' }}</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 1rem 0 0.5rem 0; vertical-align: top;">
                            <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background-color: #eff6ff; border-radius: 6px; margin-top: 2px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/></svg>
                                </span>
                                <div>
                                    <p style="color: #94a3b8; font-weight: 500; margin: 0;">Transportasi</p>
                                    <p style="font-weight: 700; color: #1e293b; margin: 0.125rem 0 0 0;">{{ $transportationObj?->name ?? 'Fleksibel' }}</p>
                                </div>
                            </div>
                        </td>
                        <td colspan="2" style="padding: 1rem 0 0.5rem 0; vertical-align: top;">
                            <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background-color: #f0fdf4; border-radius: 6px; margin-top: 2px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #22c55e;"><path d="M10 22v-6.5M14 22v-4M4.5 14H19.5L12 3z"/></svg>
                                </span>
                                <div>
                                    <p style="color: #94a3b8; font-weight: 500; margin: 0;">Minat & Kategori</p>
                                    <p style="font-weight: 700; color: #1e293b; margin: 0.125rem 0 0 0;">{{ $categoriesList->isNotEmpty() ? $categoriesList->pluck('name')->join(', ') : 'Semua Destinasi' }}</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Cuaca Section -->
            <div class="mb-8" style="margin-bottom: 2rem;">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2" style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.5rem; margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
                    <span>Prakiraan Cuaca</span>
                    <span style="font-size: 0.65rem; color: #94a3b8; font-weight: normal; text-transform: none; letter-spacing: normal;">*Catatan: Prakiraan cuaca hari ini</span>
                </h3>
                <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
                    @if($visitTimeList->isEmpty() || $visitTimeList->contains('slug', 'pagi-hari'))
                        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.75rem;">
                            <span id="weather-icon-pagi" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
                            </span>
                            <div>
                                <p style="color: #94a3b8; font-weight: 500; margin: 0;">Hari Wisata (Pagi)</p>
                                <p id="weather-text-pagi" style="font-weight: 700; color: #1e293b; margin: 0;">Cerah • 23°C - 26°C</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($visitTimeList->isEmpty() || $visitTimeList->contains('slug', 'siang-hari'))
                        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.75rem;">
                            <span id="weather-icon-day" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
                            </span>
                            <div>
                                <p style="color: #94a3b8; font-weight: 500; margin: 0;">Hari Wisata (Siang)</p>
                                <p id="weather-text-day" style="font-weight: 700; color: #1e293b; margin: 0;">Cerah Berawan • 27°C - 31°C</p>
                            </div>
                        </div>
                    @endif

                    @if($visitTimeList->isEmpty() || $visitTimeList->contains('slug', 'sore-hari'))
                        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.75rem;">
                            <span id="weather-icon-sore" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;"><path d="M12 2v2M4.93 4.93l1.41 1.41M20 12h2M19.07 4.93l-1.41 1.41"/><path d="M15.9 16A5 5 0 0 0 12 9c-2.3 0-4.3 1.6-4.8 3.8A4.2 4.2 0 0 0 3 17c0 2.2 1.8 4 4 4h9c2.2 0 4-1.8 4-4s-1.8-4-4-4Z"/></svg>
                            </span>
                            <div>
                                <p style="color: #94a3b8; font-weight: 500; margin: 0;">Hari Wisata (Sore)</p>
                                <p id="weather-text-sore" style="font-weight: 700; color: #1e293b; margin: 0;">Cerah Berawan • 25°C - 28°C</p>
                            </div>
                        </div>
                    @endif

                    @if($visitTimeList->isEmpty() || $visitTimeList->contains('slug', 'malam-hari'))
                        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.75rem;">
                            <span id="weather-icon-night" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #38bdf8;"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242M16 14v6M8 14v6M12 16v6"/></svg>
                            </span>
                            <div>
                                <p style="color: #94a3b8; font-weight: 500; margin: 0;">Hari Wisata (Malam)</p>
                                <p id="weather-text-night" style="font-weight: 700; color: #1e293b; margin: 0;">Berawan • 22°C - 25°C</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pengantar -->
            <div class="mb-8" style="margin-bottom: 2.5rem; padding: 1rem; background-color: rgba(230, 247, 250, 0.4); border: 1px solid rgba(205, 235, 242, 0.6); border-radius: 0.75rem; font-size: 0.75rem; color: #475569; line-height: 1.6; font-style: italic;">
                "Bersiaplah untuk petualangan seru di Banyuwangi bersama rekomendasi AI Laras Banyuwangi! Nikmati destinasi terbaik yang selaras dengan minat Anda pada {{ strtolower($categoriesList->pluck('name')->join(', ')) }}."
            </div>

            <!-- Daftar Destinasi Wisata Rekomendasi -->
            <div>
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2" style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.5rem; margin-bottom: 1.5rem;">Daftar Rekomendasi Destinasi</h3>
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach($recommendations as $index => $rec)
                        <div style="page-break-inside: avoid; display: block;">
                            <div style="display: flex; gap: 1.25rem; border-bottom: 1px solid #f8fafc; padding-bottom: 1.25rem;">
                                <div style="width: 130px; height: 85px; border-radius: 0.5rem; overflow: hidden; background-color: #f1f5f9; flex-shrink: 0;">
                                    <img src="{{ $rec['image'] }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $rec['name'] }}">
                                </div>
                                <div style="flex: 1; min-width: 0; font-size: 0.75rem;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
                                        <h4 style="font-size: 0.85rem; font-weight: 700; color: #3F5C7D; margin: 0;">{{ $index + 1 }}. {{ $rec['name'] }}</h4>
                                        <div style="display: flex; align-items: center; gap: 0.4rem; flex-shrink: 0;">
                                            @if(!empty($rec['google_maps_url']))
                                                <a href="{{ $rec['google_maps_url'] }}" target="_blank" style="font-size: 0.65rem; font-weight: 600; color: #3F5C7D; text-decoration: none; padding: 0.125rem 0.4rem; border: 1px solid rgba(63, 92, 125, 0.2); border-radius: 0.25rem; display: inline-flex; align-items: center; background-color: #ffffff; line-height: 1;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 2px;"><path d="M14.106 5.553a2 2 0 0 0-1.612 0l-5.651 2.825a2 2 0 0 1-1.612 0L1.82 6.671A1 1 0 0 0 1 7.565V20.24a1 1 0 0 0 1.447.894l3.167-1.584a2 2 0 0 1-1.612 0l5.651 2.825a2 2 0 0 0 1.612 0l5.411-2.705A1 1 0 0 0 23 18.775V6.1A1 1 0 0 0 21.553 5.2l-3.167 1.585a2 2 0 0 1-1.612 0z"/><path d="M9 9v11"/><path d="M15 4v11"/></svg>Buka di Maps
                                                </a>
                                            @endif
                                            <span style="font-size: 0.7rem; font-weight: 700; color: #8ED3D8; padding: 0.125rem 0.5rem; background-color: #f0fdfa; border-radius: 0.25rem; display: inline-block; line-height: 1.2;">⚡ {{ $rec['match_score'] }}% Cocok</span>
                                        </div>
                                    </div>
                                    <p style="color: #94a3b8; font-size: 0.7rem; margin: 0.25rem 0 0.5rem 0; display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap;">
                                        <span style="display: inline-flex; align-items: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 3px; color: #f43f5e;"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                            {{ $rec['district'] }}, Banyuwangi
                                        </span>
                                        • 
                                        <span style="display: inline-flex; align-items: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 3px; color: #94a3b8;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                            Jam Buka: {{ $rec['best_time'] }}
                                        </span>
                                        • 
                                        <span style="display: inline-flex; align-items: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 3px; color: #10b981;"><rect width="20" height="12" x="2" y="6" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/></svg>
                                            Tiket: {{ $rec['budget'] }}
                                        </span>
                                    </p>
                                    <p style="color: #475569; line-height: 1.5; margin: 0; font-style: italic;">
                                        "{{ $rec['reason'] }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dataEl = document.getElementById('ai-planner-data');
            if (!dataEl) return;

            const categories = JSON.parse(dataEl.dataset.categories || '[]');
            const travelType = dataEl.dataset.travelType || 'Kustom';
            const selectedCategories = JSON.parse(dataEl.dataset.selectedCategories || '[]');
            const selectedVisit = JSON.parse(dataEl.dataset.selectedVisit || '[]');
            const selectedTravelType = dataEl.dataset.selectedTravelType;
            const selectedTrans = dataEl.dataset.selectedTrans;
            const selectedBudget = dataEl.dataset.selectedBudget;
            const selectedAccess = dataEl.dataset.selectedAccess;
            const selectedCrowd = dataEl.dataset.selectedCrowd;
            const resultUrl = dataEl.dataset.resultUrl;
            const destinations = JSON.parse(dataEl.dataset.destinations || '[]');

            const date = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });
            
            // Set the PDF banner date to local date in real-time
            const pdfDateEl = document.getElementById('pdf-download-date');
            if (pdfDateEl) {
                pdfDateEl.textContent = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
            }

            // Build url to view this result again
            const queryParams = new URLSearchParams();
            selectedCategories.forEach(function(catId) {
                queryParams.append('categories[]', catId);
            });
            selectedVisit.forEach(function(visId) {
                queryParams.append('visit_time[]', visId);
            });
            if (selectedTravelType) queryParams.append('travel_type', selectedTravelType);
            if (selectedTrans) queryParams.append('transportation', selectedTrans);
            if (selectedBudget) queryParams.append('budget', selectedBudget);
            if (selectedAccess) queryParams.append('access_level', selectedAccess);
            if (selectedCrowd) queryParams.append('crowd_level', selectedCrowd);

            const historyItem = {
                date: date,
                url: resultUrl + "?" + queryParams.toString(),
                categories: categories,
                travelType: travelType,
                destinations: destinations
            };

            let history = JSON.parse(localStorage.getItem('ai_planner_history') || '[]');
            
            // Remove duplicate if same query params (URL) to avoid cluttering
            history = history.filter(function(item) {
                return item.url !== historyItem.url;
            });
            
            // Add to beginning of array
            history.unshift(historyItem);
            
            // Limit to 5 items
            if (history.length > 5) history.pop();
            
            localStorage.setItem('ai_planner_history', JSON.stringify(history));

            // Fetch live weather data for Banyuwangi
            fetch('https://api.open-meteo.com/v1/forecast?latitude=-8.2192&longitude=114.3691&daily=weathercode,temperature_2m_max,temperature_2m_min&timezone=Asia%2FJakarta')
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if (data && data.daily) {
                        const code = data.daily.weathercode[0];
                        const maxTemp = Math.round(data.daily.temperature_2m_max[0]);
                        const minTemp = Math.round(data.daily.temperature_2m_min[0]);
                        
                        // Map WMO Weather Codes to Indonesian descriptions and SVG icons
                        let dayDesc = 'Cerah';
                        let dayIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>';
                        let nightDesc = 'Cerah Berawan';
                        let nightIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;"><path d="M12 2v2M4.93 4.93l1.41 1.41M20 12h2M19.07 4.93l-1.41 1.41"/><path d="M15.9 16A5 5 0 0 0 12 9c-2.3 0-4.3 1.6-4.8 3.8A4.2 4.2 0 0 0 3 17c0 2.2 1.8 4 4 4h9c2.2 0 4-1.8 4-4s-1.8-4-4-4Z"/></svg>';

                        if (code === 0) {
                            dayDesc = 'Cerah';
                            dayIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>';
                            nightDesc = 'Cerah';
                            nightIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #cbd5e1;"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>';
                        } else if ([1, 2, 3].includes(code)) {
                            dayDesc = 'Cerah Berawan';
                            dayIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;"><path d="M12 2v2M4.93 4.93l1.41 1.41M20 12h2M19.07 4.93l-1.41 1.41"/><path d="M15.9 16A5 5 0 0 0 12 9c-2.3 0-4.3 1.6-4.8 3.8A4.2 4.2 0 0 0 3 17c0 2.2 1.8 4 4 4h9c2.2 0 4-1.8 4-4s-1.8-4-4-4Z"/></svg>';
                            nightDesc = 'Berawan';
                            nightIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #94a3b8;"><path d="M17.5 19A3.5 3.5 0 0 0 21 15.5c0-2.79-2.54-4.5-5-4.5-.42-1.01-1.44-2-2.5-2-1.9 0-3.5 1.6-3.5 3.5l.01.5C7.5 13 4 15.5 4 18.5 4 20.43 5.57 22 7.5 22h10Z"/></svg>';
                        } else if ([45, 48].includes(code)) {
                            dayDesc = 'Kabut';
                            dayIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #cbd5e1;"><path d="M5 8h14M3 12h16M7 16h10M9 20h6"/></svg>';
                            nightDesc = 'Kabut';
                            nightIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #cbd5e1;"><path d="M5 8h14M3 12h16M7 16h10M9 20h6"/></svg>';
                        } else if ([51, 53, 55, 61, 63, 65].includes(code)) {
                            dayDesc = 'Hujan Ringan';
                            dayIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #38bdf8;"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242M16 14v6M8 14v6M12 16v6"/></svg>';
                            nightDesc = 'Hujan';
                            nightIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #38bdf8;"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242M16 14v6M8 14v6M12 16v6"/></svg>';
                        } else if ([80, 81, 82].includes(code)) {
                            dayDesc = 'Hujan Lebat';
                            dayIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #38bdf8;"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242M16 14v6M8 14v6M12 16v6"/></svg>';
                            nightDesc = 'Hujan';
                            nightIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #38bdf8;"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242M16 14v6M8 14v6M12 16v6"/></svg>';
                        } else if ([95, 96, 99].includes(code)) {
                            dayDesc = 'Hujan Badai';
                            dayIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;"><path d="M19 16.9A5 5 0 0 0 18 7h-1.26a8 8 0 1 0-11.62 8.58M13 11l-4 6h6l-4 6"/></svg>';
                            nightDesc = 'Hujan Badai';
                            nightIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;"><path d="M19 16.9A5 5 0 0 0 18 7h-1.26a8 8 0 1 0-11.62 8.58M13 11l-4 6h6l-4 6"/></svg>';
                        }

                        // Update the elements
                        const dayIconEl = document.getElementById('weather-icon-day');
                        const dayTextEl = document.getElementById('weather-text-day');
                        const nightIconEl = document.getElementById('weather-icon-night');
                        const nightTextEl = document.getElementById('weather-text-night');
                        const pagiIconEl = document.getElementById('weather-icon-pagi');
                        const pagiTextEl = document.getElementById('weather-text-pagi');
                        const soreIconEl = document.getElementById('weather-icon-sore');
                        const soreTextEl = document.getElementById('weather-text-sore');

                        // Map WMO codes to description for pagi
                        let pagiDesc = dayDesc === 'Cerah' ? 'Cerah / Sejuk' : dayDesc;
                        let pagiIconSvg = dayIconSvg;

                        // Map WMO codes to description for sore
                        let soreDesc = dayDesc;
                        let soreIconSvg = dayIconSvg;

                        if (pagiIconEl) pagiIconEl.innerHTML = pagiIconSvg;
                        if (pagiTextEl) pagiTextEl.textContent = `${pagiDesc} • ${minTemp + 1}°C - ${minTemp + 4}°C`;

                        if (dayIconEl) dayIconEl.innerHTML = dayIconSvg;
                        if (dayTextEl) dayTextEl.textContent = `${dayDesc} • ${maxTemp - 3}°C - ${maxTemp}°C`;

                        if (soreIconEl) soreIconEl.innerHTML = soreIconSvg;
                        if (soreTextEl) soreTextEl.textContent = `${soreDesc} • ${minTemp + 4}°C - ${maxTemp - 2}°C`;

                        if (nightIconEl) nightIconEl.innerHTML = nightIconSvg;
                        if (nightTextEl) nightTextEl.textContent = `${nightDesc} • ${minTemp}°C - ${minTemp + 3}°C`;
                    }
                })
                .catch(function(err) {
                    console.error('Error fetching live weather data:', err);
                });

            // PDF Generation Handler
            const downloadBtn = document.getElementById('download-pdf-btn');
            if (downloadBtn) {
                downloadBtn.addEventListener('click', function() {
                    const originalContent = downloadBtn.innerHTML;
                    downloadBtn.disabled = true;
                    downloadBtn.innerHTML = `
                        <svg class="animate-spin h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    `;

                    const pdfTemplate = document.getElementById('pdf-template');
                    const element = pdfTemplate.cloneNode(true);
                    element.classList.remove('hidden');
                    
                    const opt = {
                        margin:       [0.4, 0.4, 0.4, 0.4],
                        filename:     'Petualangan_Banyuwangi_AI.pdf',
                        image:        { type: 'jpeg', quality: 0.98 },
                        html2canvas:  { scale: 2, useCORS: true, letterRendering: true },
                        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' },
                        pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] }
                    };

                    html2pdf().set(opt).from(element).toPdf().get('pdf').then(function(pdf) {
                        const totalPages = pdf.internal.getNumberOfPages();
                        for (let i = 1; i <= totalPages; i++) {
                            pdf.setPage(i);
                            pdf.setFontSize(8);
                            pdf.setTextColor(100, 116, 139); // #64748b
                            pdf.setFont("helvetica", "normal");
                            
                            // Draw light solid line
                            pdf.setDrawColor(226, 232, 240); // #e2e8f0
                            pdf.setLineWidth(0.015);
                            pdf.line(0.4, 10.4, 8.1, 10.4);
                            
                            // Draw footer text
                            pdf.text("Rekomendasi destinasi ini dibuat oleh AI Planner Laras Banyuwangi, Temukan keindahan Banyuwangi", 4.25, 10.6, { align: "center" });
                        }
                    }).save().then(() => {
                        downloadBtn.disabled = false;
                        downloadBtn.innerHTML = originalContent;
                    }).catch(err => {
                        console.error('PDF Generation Error:', err);
                        downloadBtn.disabled = false;
                        downloadBtn.innerHTML = originalContent;
                    });
                });
            }
        });
    </script>

</x-guest-portal-layout>
