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
                        Berikut destinasi Banyuwangi yang paling selaras dengan preferensi perjalananmu. Fitur AI Planner kami telah menyusun rencana terbaik untuk eksplorasimu.
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
                               <x-lucide-alert-triangle class="w-8 h-8 text-[#89A8E0]" />
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
    <!-- Hidden PDF Template specially designed for export -->
    <x-planner-pdf-template 
        :recommendations="$recommendations"
        :categories-list="$categoriesList"
        :travel-type-obj="$travelTypeObj"
        :selected-budget-key="$selectedBudgetKey"
        :budget-map="$budgetMap"
        :visit-time-list="$visitTimeList"
        :transportation-obj="$transportationObj"
    />

</x-guest-portal-layout>
