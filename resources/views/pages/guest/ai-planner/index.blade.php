<x-guest-portal-layout>
    <x-slot name="title">AI Planner - Laras Banyuwangi</x-slot>





    <style>
        [x-cloak] { display: none !important; }
    </style>

    <!-- Header Section -->
    <div class="relative bg-gradient-to-r from-[#7F9ED2] to-[#8ED3D8] py-16 sm:py-20 text-center text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 font-sans tracking-tight">Selaraskan Destinasi Wisatamu</h1>
            <p class="text-white/95 max-w-3xl mx-auto text-sm sm:text-base md:text-lg font-light leading-relaxed font-sans">
                Bantu kami merekomendasikan destinasi terbaik di Banyuwangi<br class="hidden md:block" />
                yang sesuai dengan gaya dan preferensimu.
            </p>
        </div>
        <!-- Wave SVG -->
        <div class="absolute -bottom-[2px] left-0 right-0 w-full overflow-hidden leading-none z-10">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-[52px] text-[#EFF6FC] fill-current translate-y-[1px] scale-y-[1.05]">
                <path d="M0,60 C300,10 600,110 900,60 C1050,35 1150,45 1200,60 L1200,120 L0,120 Z" stroke="none"></path>
            </svg>
        </div>
    </div>

    <!-- Wizard Section -->
    <div class="py-10 sm:py-16 bg-gradient-to-br from-[#EFF6FC] via-[#F4F9FC] to-[#E5EFF8] min-h-[60vh] overflow-x-hidden" x-data="{
        started: false,
        step: 1,
        totalSteps: 8,
        history: [],
        categories: [],
        activities: [],
        travelType: '',
        transportation: '',
        visitTime: [],
        budget: '',
        accessLevel: '',
        crowdLevel: '',
        stepIsValid() {
            if (this.step === 1) return this.categories.length > 0;
            if (this.step === 2) return this.activities.length > 0;
            if (this.step === 3) return this.travelType !== '';
            if (this.step === 4) return this.transportation !== '';
            if (this.step === 5) return this.visitTime.length > 0;
            if (this.step === 6) return this.budget !== '';
            if (this.step === 7) return this.accessLevel !== '';
            if (this.step === 8) return this.crowdLevel !== '';
            return true;
        },
        init() {
            this.history = JSON.parse(localStorage.getItem('ai_planner_history') || '[]');
        },
        clearHistory() {
            localStorage.removeItem('ai_planner_history');
            this.history = [];
        },
        getProgress() {
            return Math.round((this.step / this.totalSteps) * 100);
        },
        getMainStep() {
            if (this.step <= 2) return 1;
            if (this.step <= 5) return 2;
            return 3;
        },
        submitForm() {
            const overlay = document.getElementById('ai-loading-overlay');
            overlay.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.add('opacity-100');
            }, 50);

            const progressBar = document.getElementById('loading-progress-bar');
            const percentText = document.getElementById('loading-percent-text');
            const statusText = document.getElementById('loading-status-text');

            const stepsText = [
                '🔍 Menelaah data preferensi liburan Anda...',
                '🌍 Mencari destinasi terbaik di database Laras Banyuwangi...',
                '📊 Menganalisis aksesibilitas lokasi dan budget yang ditentukan...',
                '🧠 Menghitung tingkat kecocokan (AI Match Score)...',
                '✨ Menyusun 8 rekomendasi personal terbaik...'
            ];

            let progress = 0;
            let stepIndex = 0;
            const duration = 3500;
            const intervalTime = 50;
            const totalUpdates = duration / intervalTime;
            const progressPerUpdate = 100 / totalUpdates;
            const textChangeThresholds = [20, 40, 60, 80, 95];

            const timer = setInterval(() => {
                progress += progressPerUpdate;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(timer);
                    document.getElementById('ai-planner-form').submit();
                }

                progressBar.style.width = `${progress}%`;
                percentText.textContent = `${Math.round(progress)}%`;

                for (let i = 0; i < textChangeThresholds.length; i++) {
                    if (progress >= textChangeThresholds[i] && stepIndex === i) {
                        stepIndex = i + 1;
                        if (stepsText[stepIndex]) {
                            statusText.style.opacity = '0';
                            setTimeout(() => {
                                statusText.textContent = stepsText[stepIndex];
                                statusText.style.opacity = '1';
                            }, 150);
                        }
                    }
                }
            }, intervalTime);
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- LANDING PAGE VIEW -->
            <div x-show="!started" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="space-y-16">
                <!-- Split Hero Section -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <!-- Left Column: Stepper & Info -->
                    <div class="lg:col-span-6 flex flex-col items-start text-left">
                        <span class="px-3.5 py-1.5 bg-[#E6F7FA] text-[#3F5C7D] text-[10px] font-bold rounded-full border border-[#CDEBF2] tracking-wider uppercase inline-flex items-center gap-1.5 mb-6 font-sans select-none">
                            <x-lucide-sparkles class="w-3.5 h-3.5 text-[#3F5C7D]" stroke-width="2.5" /> AI Planner Laras Banyuwangi
                        </span>

                        <h2 class="text-3xl md:text-[2.75rem] font-bold text-[#3F5C7D] mb-4 font-sans leading-tight">
                            Temukan Destinasi yang <span class="bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] bg-clip-text text-transparent">Selaras untuk Anda</span>
                        </h2>

                        <!-- Underline Divider -->
                        <div class="w-16 h-1.5 bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] mb-6 rounded-full"></div>

                        <p class="text-slate-600 mb-8 font-light text-base leading-relaxed font-sans">
                            Laras Banyuwangi memanfaatkan teknologi Smart Tourism berbasis <br class="hidden md:block" />
                            <span class="text-[#3F5C7D] font-bold">Content-Based Filtering</span> untuk menghadirkan rekomendasi destinasi <br class="hidden md:block" />
                            yang sesuai dengan minat, budget, dan gaya perjalanan Anda.
                        </p>

                        <!-- Vertical Stepper Timeline -->
                        <div class="space-y-6 mb-8 w-full font-sans">
                            <div class="flex items-start gap-4 group">
                                <div class="w-10 h-10 rounded-2xl bg-[#E6F7FA] border border-[#CDEBF2] flex items-center justify-center text-[#3F5C7D] shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105">
                                    <x-lucide-clipboard-list class="w-5 h-5 text-[#3F5C7D]" stroke-width="2" />
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm md:text-base mb-1">Pilih Preferensi</h4>
                                    <p class="text-slate-500 text-xs md:text-sm font-light leading-relaxed">Jawab beberapa pertanyaan tentang minat wisata, budget, waktu, dan gaya perjalanan Anda.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 group">
                                <div class="w-10 h-10 rounded-2xl bg-[#EFF6FC] border border-[#CDEBF2]/50 flex items-center justify-center text-[#89A8E0] shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105">
                                    <x-lucide-brain class="w-5 h-5 text-[#89A8E0]" stroke-width="2" />
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm md:text-base mb-1">Sistem Menganalisis</h4>
                                    <p class="text-slate-500 text-xs md:text-sm font-light leading-relaxed">Algoritma Content-Based Filtering, TF-IDF, dan Cosine Similarity menganalisis kecocokan destinasi.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 group">
                                <div class="w-10 h-10 rounded-2xl bg-[#E6F7FA] border border-[#CDEBF2] flex items-center justify-center text-[#8ED3D8] shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105">
                                    <x-lucide-compass class="w-5 h-5 text-[#8ED3D8]" stroke-width="2" />
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm md:text-base mb-1">Rekomendasi Destinasi</h4>
                                    <p class="text-slate-500 text-xs md:text-sm font-light leading-relaxed">Dapatkan daftar destinasi terbaik yang paling sesuai dengan preferensi Anda.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Start Action Button -->
                        <button type="button" @click="started = true" class="px-8 py-3.5 bg-gradient-to-r from-[#7F9ED2] to-[#3F5C7D] hover:from-[#7392c6] hover:to-[#344d6b] text-white text-base font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-xl hover:shadow-[#3F5C7D]/20 hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2.5 cursor-pointer border-none font-sans">
                            <x-lucide-sparkles class="w-5 h-5 text-white shrink-0" stroke-width="2" />
                            Mulai AI Planner
                        </button>
                    </div>

                    <!-- Right Column: Features Panel (Mengapa Menggunakan...) -->
                    <div class="lg:col-span-6 flex justify-center w-full py-6">
                        <div class="relative w-full max-w-lg bg-white/70 backdrop-blur-md border border-white/90 p-6 sm:p-8 rounded-[2.5rem] shadow-[0_20px_50px_rgba(63,92,125,0.1)] z-10 flex flex-col gap-6">
                            <div>
                                <h3 class="text-lg md:text-xl font-bold text-[#3F5C7D] font-sans leading-tight">
                                    Mengapa Menggunakan <br class="hidden sm:block" />AI Planner <span class="bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] bg-clip-text text-transparent">Laras Banyuwangi?</span>
                                </h3>
                                <div class="w-16 h-1.5 bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] mt-3 mb-6 rounded-full"></div>
                            </div>
                            
                            <div class="divide-y divide-slate-100/80">
                                <div class="flex items-start gap-4 pb-5 group">
                                    <div class="w-14 h-14 rounded-2xl bg-[#E6F7FA] border border-[#CDEBF2] flex items-center justify-center text-[#3F5C7D] shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105">
                                        <x-lucide-user-check class="w-6 h-6 text-[#3F5C7D]" />
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-[#3F5C7D] text-base mb-1">Rekomendasi Personal</h4>
                                        <p class="text-slate-500 text-xs md:text-sm font-light leading-relaxed">
                                            Destinasi dipilih berdasarkan minat, preferensi, dan karakteristik perjalanan Anda.
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start gap-4 py-5 group">
                                    <div class="w-14 h-14 rounded-2xl bg-[#EFF6FC] border border-[#DCEAF8] flex items-center justify-center text-[#89A8E0] shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105">
                                        <x-lucide-network class="w-6 h-6 text-[#3F5C7D]" />
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-[#3F5C7D] text-base mb-1">Pencocokan Cerdas</h4>
                                        <p class="text-slate-500 text-xs md:text-sm font-light leading-relaxed">
                                            Menggunakan metode Content-Based Filtering, TF-IDF, dan Cosine Similarity untuk mengukur tingkat kecocokan destinasi.
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start gap-4 pt-5 group">
                                    <div class="w-14 h-14 rounded-2xl bg-[#F1F0FE] border border-[#E4E2FE] flex items-center justify-center text-[#89A8E0] shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105">
                                        <x-lucide-wallet class="w-6 h-6 text-[#3F5C7D]" />
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-[#3F5C7D] text-base mb-1">Sesuai Budget & Waktu</h4>
                                        <p class="text-slate-500 text-xs md:text-sm font-light leading-relaxed">
                                            Rekomendasi mempertimbangkan biaya kunjungan, waktu kunjungan, serta tingkat aksesibilitas destinasi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- History Section Table -->
                <div class="space-y-6 pt-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-lg md:text-xl font-bold text-[#3F5C7D] font-sans">Riwayat AI Planner Anda</h3>
                            <p class="text-slate-400 text-sm font-light font-sans mt-0.5">Daftar pencarian rekomendasi destinasi Anda yang tersimpan (maks menampilkan 5 riwayat terakhir).</p>
                        </div>
                        <button type="button" x-show="history.length > 0" @click="clearHistory()" class="px-5 py-2 text-sm text-red-500 hover:text-white font-semibold bg-white border border-red-200 hover:bg-red-500 hover:border-red-500 rounded-full transition-all duration-300 shadow-sm cursor-pointer font-sans" x-cloak>
                            Hapus Semua Riwayat
                        </button>
                    </div>

                    <!-- History Display State: Empty -->
                    <div x-show="history.length === 0" class="bg-white border border-slate-100 rounded-[2rem] p-12 text-center shadow-[0_8px_30px_rgba(0,0,0,0.015)]">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100 shadow-inner">
                            <x-lucide-history class="h-8 w-8 text-slate-400" stroke-width="1.5" />
                        </div>
                        <h4 class="text-base font-bold text-[#3F5C7D] font-sans">Belum Ada Riwayat Rekomendasi</h4>
                        <p class="text-slate-400 text-xs font-light font-sans max-w-sm mx-auto mt-1 leading-relaxed">
                            Riwayat pencarian destinasi Anda akan otomatis tercatat di sini setelah Anda menyelesaikan formulir AI Planner di atas.
                        </p>
                    </div>

                    <!-- History Display State: Table -->
                    <div x-show="history.length > 0" class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.015)] overflow-hidden" x-cloak>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse font-sans text-sm">
                                <thead>
                                    <tr class="bg-slate-50/70 border-b border-slate-100 text-slate-400 font-semibold uppercase tracking-wider text-xs">
                                        <th class="py-4 px-6">Tanggal</th>
                                        <th class="py-4 px-6">Gaya Travel</th>
                                        <th class="py-4 px-6">Kategori</th>
                                        <th class="py-4 px-6">Destinasi Terpilih</th>
                                        <th class="py-4 px-6">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100/80">
                                    <template x-for="(item, index) in history" :key="index">
                                        <tr class="hover:bg-slate-50/30 transition-colors duration-200 text-slate-600">
                                            <td class="py-4 px-6 font-medium text-slate-400" x-text="item.date"></td>
                                            <td class="py-4 px-6">
                                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-xs font-bold rounded-full border border-emerald-100" x-text="item.travelType"></span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex flex-wrap gap-1">
                                                    <template x-for="cat in item.categories.slice(0, 2)">
                                                        <span class="px-2 py-0.5 bg-[#E6F7FA] text-[#3F5C7D] text-xs font-medium rounded-md border border-[#CDEBF2]" x-text="cat"></span>
                                                    </template>
                                                    <template x-if="item.categories.length > 2">
                                                        <span class="px-1.5 py-0.5 bg-slate-50 text-slate-400 text-xs rounded-md border border-slate-100" x-text="'+' + (item.categories.length - 2)"></span>
                                                    </template>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <p class="max-w-xs md:max-w-sm truncate text-slate-500 font-light text-xs m-0" x-text="item.destinations.slice(0, 3).join(', ') + (item.destinations.length > 3 ? ', ...' : '')"></p>
                                            </td>
                                            <td class="py-4 px-6">
                                                <a :href="item.url" class="inline-flex items-center gap-1 px-4 py-1.5 bg-[#3F5C7D]/10 hover:bg-[#3F5C7D] text-[#3F5C7D] hover:text-white font-bold rounded-full transition-all duration-300 no-underline text-xs">
                                                    Buka Rekomendasi <x-lucide-arrow-right class="w-3 h-3" stroke-width="2.5" />
                                                </a>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FORM & WIZARD VIEW -->
            <div x-show="started" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="max-w-4xl mx-auto space-y-8">
                
                <!-- Progress Header Component -->
                <x-planner-progress />

                <!-- Form Wrapper -->
                <form id="ai-planner-form" action="{{ route('planner.result') }}" method="POST" @submit.prevent="submitForm">
                    @csrf

                    <!-- Main Card Container -->
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_12px_40px_rgba(0,0,0,0.03)] p-5 sm:p-8 md:p-12 min-h-[480px] flex flex-col justify-between">
                        
                        <!-- STEP 1: Kategori Wisata -->
                        <div x-show="step === 1" class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Jenis wisata apa yang paling kamu minati?</h2>
                                <p class="text-slate-400 text-sm md:text-base font-sans font-light mt-2">Pilih satu atau beberapa kategori wisata agar AI dapat memahami minat perjalananmu.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($categories as $category)
                                    <x-planner-option 
                                        type="checkbox" 
                                        name="categories[]" 
                                        value="{{ $category->name }}" 
                                        title="Wisata {{ $category->name }}" 
                                        x-model="categories"
                                    />
                                @endforeach
                            </div>
                        </div>

                        <!-- STEP 2: Aktivitas yang Disukai -->
                        <div x-show="step === 2" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Aktivitas apa yang ingin kamu lakukan?</h2>
                                <p class="text-slate-400 text-sm md:text-base font-sans font-light mt-2">Pilih aktivitas yang ingin kamu nikmati selama menjelajahi Banyuwangi.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($activities as $activity)
                                    <x-planner-option 
                                        type="checkbox" 
                                        name="activities[]" 
                                        value="{{ $activity->name }}" 
                                        title="{{ $activity->name }}" 
                                        x-model="activities"
                                    />
                                @endforeach
                            </div>
                        </div>

                        <!-- STEP 3: Tipe Perjalanan -->
                        <div x-show="step === 3" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Bagaimana gaya perjalananmu?</h2>
                                <p class="text-slate-400 text-sm md:text-base font-sans font-light mt-2">Pilih gaya perjalanan yang paling menggambarkan rencana liburanmu.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($travelTypes as $type)
                                    <x-planner-option 
                                        type="radio" 
                                        name="travel_type" 
                                        value="{{ $type->name }}" 
                                        title="Gaya {{ $type->name }}" 
                                        x-model="travelType"
                                    />
                                @endforeach
                            </div>
                        </div>

                        <!-- STEP 4: Transportasi -->
                        <div x-show="step === 4" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Transportasi apa yang akan kamu gunakan?</h2>
                                <p class="text-slate-400 text-sm md:text-base font-sans font-light mt-2">AI akan menyesuaikan rekomendasi dengan akses menuju destinasi.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                @foreach($transportations as $trans)
                                    <x-planner-option 
                                        type="radio" 
                                        name="transportation" 
                                        value="{{ $trans->name }}" 
                                        title="{{ $trans->name }}" 
                                        x-model="transportation"
                                    />
                                @endforeach
                            </div>
                        </div>

                        <!-- STEP 5: Waktu Kunjungan -->
                        <div x-show="step === 5" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Kapan waktu terbaik untuk kunjunganmu?</h2>
                                <p class="text-slate-400 text-sm md:text-base font-sans font-light mt-2">Pilih satu atau beberapa waktu kunjungan yang paling sesuai dengan rencana perjalananmu.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                @foreach($visitTimes as $time)
                                    <x-planner-option 
                                        type="checkbox" 
                                        name="visit_times[]" 
                                        value="{{ $time->name }}" 
                                        title="{{ $time->name }}" 
                                        x-model="visitTime"
                                    />
                                @endforeach
                            </div>
                        </div>

                        <!-- STEP 6: Budget Tiket Masuk -->
                        <div x-show="step === 6" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Berapa kisaran budget tiket masukmu?</h2>
                                <p class="text-slate-400 text-sm md:text-base font-sans font-light mt-2">Pilih rentang harga tiket per orang yang paling nyaman untukmu.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <x-planner-option 
                                    type="radio" 
                                    name="budget" 
                                    value="15000" 
                                    title="Hemat" 
                                    x-model="budget"
                                />
                                <x-planner-option 
                                    type="radio" 
                                    name="budget" 
                                    value="50000" 
                                    title="Sedang" 
                                    x-model="budget"
                                />
                                <x-planner-option 
                                    type="radio" 
                                    name="budget" 
                                    value="100000" 
                                    title="Mewah / Premium" 
                                    x-model="budget"
                                />
                            </div>
                        </div>

                        <!-- STEP 7: Aksesibilitas Lokasi -->
                        <div x-show="step === 7" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Seberapa mudah akses destinasi yang kamu inginkan?</h2>
                                <p class="text-slate-400 text-sm md:text-base font-sans font-light mt-2">AI akan menyesuaikan rekomendasi dengan tingkat kemudahan akses menuju lokasi.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <x-planner-option 
                                    type="radio" 
                                    name="access_level" 
                                    value="mudah" 
                                    title="Akses Mudah" 
                                    x-model="accessLevel"
                                />
                                <x-planner-option 
                                    type="radio" 
                                    name="access_level" 
                                    value="sedang" 
                                    title="Akses Sedang" 
                                    x-model="accessLevel"
                                />
                                <x-planner-option 
                                    type="radio" 
                                    name="access_level" 
                                    value="menantang" 
                                    title="Tantangan Ekstra" 
                                    x-model="accessLevel"
                                />
                            </div>
                        </div>

                        <!-- STEP 8: Tingkat Keramaian -->
                        <div x-show="step === 8" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Suasana destinasi seperti apa yang kamu inginkan?</h2>
                                <p class="text-slate-400 text-sm md:text-base font-sans font-light mt-2">Pilih tingkat keramaian yang paling nyaman untuk pengalaman wisatamu.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <x-planner-option 
                                    type="radio" 
                                    name="crowd_level" 
                                    value="sepi" 
                                    title="Tenang & Sepi" 
                                    x-model="crowdLevel"
                                />
                                <x-planner-option 
                                    type="radio" 
                                    name="crowd_level" 
                                    value="sedang" 
                                    title="Sedang / Normal" 
                                    x-model="crowdLevel"
                                />
                                <x-planner-option 
                                    type="radio" 
                                    name="crowd_level" 
                                    value="ramai" 
                                    title="Populer & Ramai" 
                                    x-model="crowdLevel"
                                />
                            </div>
                        </div>

                        <!-- Button Footer Navigation inside Card -->
                        <div class="flex flex-col-reverse sm:flex-row gap-3 sm:gap-0 sm:justify-between items-stretch sm:items-center pt-8 border-t border-slate-100 mt-8">
                            <!-- Left: Kembali Button -->
                            <button type="button" @click="if(step > 1) { step-- } else { started = false }" class="px-6 py-3 bg-[#8A9EB7] hover:bg-[#7A8EA7] text-white text-xs font-semibold uppercase tracking-wider rounded-xl transition-all duration-300 flex items-center justify-center gap-1.5 shadow-sm cursor-pointer border-none font-sans w-full sm:w-auto">
                                <x-lucide-arrow-left class="w-3.5 h-3.5" stroke-width="2.5" /> Kembali
                            </button>
                            
                            <!-- Right: Lanjut / Submit Button -->
                            <div class="flex flex-col sm:block w-full sm:w-auto">
                                <!-- Next Step button -->
                                <button type="button" @click="if(step < totalSteps && stepIsValid()) step++" x-show="step < totalSteps" :disabled="!stepIsValid()" :class="stepIsValid() ? 'bg-[#3F5C7D] hover:bg-[#344d6b] cursor-pointer' : 'bg-slate-300 text-slate-500 cursor-not-allowed'" class="px-8 py-3 text-white text-xs font-semibold uppercase tracking-wider rounded-xl transition-all duration-300 flex items-center justify-center gap-1.5 shadow-sm border-none font-sans w-full sm:w-auto">
                                    Lanjut <x-lucide-arrow-right class="w-3.5 h-3.5" stroke-width="2.5" />
                                </button>

                                <!-- Submit button -->
                                <button type="submit" x-show="step === totalSteps" :disabled="!stepIsValid()" :class="stepIsValid() ? 'bg-[#3F5C7D] hover:bg-[#344d6b] cursor-pointer' : 'bg-slate-300 text-slate-500 cursor-not-allowed'" class="px-8 py-3 text-white text-xs font-semibold uppercase tracking-wider rounded-xl transition-all duration-300 flex items-center justify-center gap-1.5 shadow-sm border-none font-sans w-full sm:w-auto" x-cloak>
                                    LIHAT REKOMENDASI SAYA <x-lucide-sparkles class="w-4 h-4 text-white" stroke-width="2.5" />
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div> <!-- End of x-show="started" -->

        </div>
    </div>

    <!-- AI Loading Screen Overlay -->
    <div id="ai-loading-overlay" class="fixed inset-0 bg-slate-900/90 backdrop-blur-lg z-[9999] flex items-center justify-center hidden opacity-0 transition-opacity duration-500">
        <div class="max-w-md w-full px-6 text-center text-white">
            <div class="relative w-28 h-28 mx-auto mb-8 flex items-center justify-center">
                <div class="absolute inset-0 rounded-full border-4 border-t-[#8ED3D8] border-r-transparent border-b-[#7F9ED2] border-l-transparent animate-spin duration-1000"></div>
                <div class="w-16 h-16 rounded-full bg-gradient-to-r from-[#7F9ED2] to-[#8ED3D8] animate-pulse shadow-[0_0_40px_rgba(142,211,216,0.6)] flex items-center justify-center">
                    <x-lucide-sparkles class="w-8 h-8 text-white" stroke-width="2" />
                </div>
            </div>

            <h3 class="text-2xl font-bold font-sans tracking-wide mb-3">AI Planner sedang memproses</h3>
            <p class="text-slate-400 font-sans text-xs font-light tracking-wider uppercase mb-6">Mencari Rekomendasi Destinasi Terbaik Anda</p>
            
            <div class="bg-white/5 border border-white/10 rounded-2xl p-5 mb-6 min-h-[72px] flex items-center justify-center">
                <span id="loading-status-text" class="text-slate-200 text-sm font-sans font-light tracking-wide transition-all duration-300">
                    Menganalisis kriteria & preferensi Anda...
                </span>
            </div>

            <div class="w-full bg-white/10 h-1.5 rounded-full overflow-hidden">
                <div id="loading-progress-bar" class="w-0 bg-gradient-to-r from-[#7F9ED2] to-[#8ED3D8] h-full transition-all duration-100 ease-out"></div>
            </div>
            <div class="mt-2 text-right">
                <span id="loading-percent-text" class="text-slate-500 text-xs font-semibold font-sans">0%</span>
            </div>
        </div>
    </div>

</x-guest-portal-layout>
