@props([
    'recommendations',
    'categoriesList',
    'travelTypeObj',
    'selectedBudgetKey',
    'budgetMap',
    'visitTimeList',
    'transportationObj'
])

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
                <h1 class="text-2xl font-bold mb-1" style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem;">Petualangan Bersama Laras Banyuwangi</h1>
                <div class="flex items-center gap-4 text-xs font-light text-slate-200" style="display: flex; gap: 1rem; font-size: 0.75rem; color: #e2e8f0;">
                    <span style="display: inline-flex; align-items: center;">
                        <x-lucide-calendar width="12" height="12" style="display: inline-block; vertical-align: middle; margin-right: 4px; color: #a5b4fc; width: 12px; height: 12px;" />
                        <span id="pdf-download-date">{{ date('d M Y') }}</span>
                    </span>
                    <span style="display: inline-flex; align-items: center;">
                        <x-lucide-map-pin width="12" height="12" style="display: inline-block; vertical-align: middle; margin-right: 4px; color: #f43f5e; width: 12px; height: 12px;" />
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
                                <x-lucide-user width="16" height="16" style="color: #3F5C7D; width: 16px; height: 16px;" />
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
                                <x-lucide-banknote width="16" height="16" style="color: #10b981; width: 16px; height: 16px;" />
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
                                <x-lucide-clock width="16" height="16" style="color: #64748b; width: 16px; height: 16px;" />
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
                                <x-lucide-car width="16" height="16" style="color: #3b82f6; width: 16px; height: 16px;" />
                            </span>
                            <div>
                                <p style="color: #94a3b8; font-weight: 500; margin: 0;">Transportasi</p>
                                <p style="font-weight: 700; color: #1e293b; margin: 0.125rem 0 0 0;">{{ $transportationObj?->name ?? 'Fleksibel' }}</p>
                            </div>
                        </div>
                    </td>
                    <td colspan="2" style="padding: 1rem 0 0.5rem 0; vertical-align: top;">
                        <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background-color: #f0fdfa; border-radius: 6px; margin-top: 2px;">
                                <x-lucide-compass width="16" height="16" style="color: #22c55e; width: 16px; height: 16px;" />
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
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2" style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.5rem; margin-bottom: 1rem;">
                <span>Perkiraan Cuaca Hari Ini</span>
            </h3>
            <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
                @if($visitTimeList->isEmpty() || $visitTimeList->contains('slug', 'pagi-hari'))
                    <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.75rem;">
                        <span id="weather-icon-pagi" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px;">
                            <x-lucide-sun width="24" height="24" style="color: #f59e0b; width: 24px; height: 24px;" stroke-width="2.5" />
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
                            <x-lucide-sun width="24" height="24" style="color: #f59e0b; width: 24px; height: 24px;" stroke-width="2.5" />
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
                            <x-lucide-cloud-sun width="24" height="24" style="color: #f59e0b; width: 24px; height: 24px;" stroke-width="2.5" />
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
                            <x-lucide-cloud-rain width="24" height="24" style="color: #38bdf8; width: 24px; height: 24px;" stroke-width="2.5" />
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
                                                <x-lucide-map width="9" height="9" style="display: inline-block; vertical-align: middle; margin-right: 2px; width: 9px; height: 9px;" stroke-width="2.5" />Buka di Maps
                                            </a>
                                        @endif
                                        <span style="font-size: 0.7rem; font-weight: 700; color: #8ED3D8; padding: 0.125rem 0.5rem; background-color: #f0fdfa; border-radius: 0.25rem; display: inline-block; line-height: 1.2;">⚡ {{ $rec['match_score'] }}% Cocok</span>
                                    </div>
                                </div>
                                <p style="color: #94a3b8; font-size: 0.7rem; margin: 0.25rem 0 0.5rem 0; display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap;">
                                    <span style="display: inline-flex; align-items: center;">
                                        <x-lucide-map-pin width="10" height="10" style="display: inline-block; vertical-align: middle; margin-right: 3px; color: #f43f5e; width: 10px; height: 10px;" stroke-width="2.5" />
                                        {{ $rec['district'] }}, Banyuwangi
                                    </span>
                                    • 
                                    <span style="display: inline-flex; align-items: center;">
                                        <x-lucide-clock width="10" height="10" style="display: inline-block; vertical-align: middle; margin-right: 3px; color: #94a3b8; width: 10px; height: 10px;" stroke-width="2.5" />
                                        Jam Buka: {{ $rec['best_time'] }}
                                    </span>
                                    • 
                                    <span style="display: inline-flex; align-items: center;">
                                        <x-lucide-banknote width="10" height="10" style="display: inline-block; vertical-align: middle; margin-right: 3px; color: #10b981; width: 10px; height: 10px;" stroke-width="2.5" />
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

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
                    pagebreak:    { mode: ['css', 'legacy'] }
                };

                html2pdf().set(opt).from(element).toPdf().get('pdf').then(function(pdf) {
                    const totalPages = pdf.internal.getNumberOfPages();
                    
                    // Stamp footer only on the last page
                    pdf.setPage(totalPages);
                    pdf.setFontSize(8);
                    pdf.setTextColor(100, 116, 139); // #64748b
                    pdf.setFont("helvetica", "normal");
                    
                    // Draw light solid line
                    pdf.setDrawColor(226, 232, 240); // #e2e8f0
                    pdf.setLineWidth(0.015);
                    pdf.line(0.4, 10.4, 8.1, 10.4);
                    
                    // Draw footer text
                    pdf.text("Rekomendasi destinasi ini dibuat oleh AI Planner Laras Banyuwangi, Temukan keindahan Banyuwangi", 4.25, 10.6, { align: "center" });
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
