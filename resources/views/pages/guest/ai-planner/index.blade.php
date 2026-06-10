<x-guest-portal-layout>
    <x-slot name="title">AI Trip Planner - Laras Banyuwangi</x-slot>





    <style>
        [x-cloak] { display: none !important; }
    </style>

    <!-- Header Section -->
    <div class="relative bg-gradient-to-r from-[#7F9ED2] to-[#8ED3D8] py-20 text-center text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-sans tracking-tight">Selaraskan Destinasi Wisatamu</h1>
            <p class="text-white/95 max-w-3xl mx-auto text-base md:text-lg font-light leading-relaxed font-sans">
                Bantu kami merekomendasikan destinasi terbaik di Banyuwangi<br class="hidden md:block" />
                yang sesuai dengan gaya dan preferensimu.
            </p>
        </div>
        <!-- Wave SVG -->
        <div class="absolute -bottom-[1px] left-0 right-0 w-full overflow-hidden leading-none z-0">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-[50px] text-[#EFF6FC] fill-current">
                <path d="M0,60 C300,10 600,110 900,60 C1050,35 1150,45 1200,60 L1200,120 L0,120 Z"></path>
            </svg>
        </div>
    </div>

    <!-- Wizard Section -->
    <div class="py-16 bg-gradient-to-br from-[#EFF6FC] via-[#F4F9FC] to-[#E5EFF8] min-h-[60vh]" x-data="{
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
                '✨ Menyusun 6 rekomendasi personal terbaik...'
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
                            Langkah Penyelarasan Destinasi
                        </span>

                        <!-- Vertical Stepper Timeline -->
                        <div class="space-y-6 mb-8 w-full font-sans">
                            <div class="flex items-start gap-4 group">
                                <div class="w-9 h-9 rounded-full bg-[#2C4E80] text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-md transition-transform duration-300 group-hover:scale-105">
                                    1
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm md:text-base mb-1">Pilih Preferensi</h4>
                                    <p class="text-slate-500 text-xs md:text-sm font-light leading-relaxed">Tentukan jenis wisata, budget, dan waktu yang Anda miliki.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 group">
                                <div class="w-9 h-9 rounded-full bg-[#6B8EC6] text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-md transition-transform duration-300 group-hover:scale-105">
                                    2
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm md:text-base mb-1">Sistem Menganalisis</h4>
                                    <p class="text-slate-500 text-xs md:text-sm font-light leading-relaxed">Algoritma kami akan mencari destinasi terbaik yang paling cocok.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 group">
                                <div class="w-9 h-9 rounded-full bg-[#73C7D5] text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-md transition-transform duration-300 group-hover:scale-105">
                                    3
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm md:text-base mb-1">Rekomendasi Destinasi Siap</h4>
                                    <p class="text-slate-500 text-xs md:text-sm font-light leading-relaxed">Daftar rekomendasi destinasi terbaik beserta persentase kecocokan AI.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Start Action Button -->
                        <button type="button" @click="started = true" class="px-8 py-3.5 bg-gradient-to-r from-[#7F9ED2] to-[#3F5C7D] hover:from-[#7392c6] hover:to-[#344d6b] text-white text-xs font-bold uppercase tracking-wider rounded-full transition-all duration-300 shadow-lg hover:shadow-xl hover:shadow-[#3F5C7D]/20 hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2 cursor-pointer border-none font-sans">
                            <x-lucide-zap class="w-4 h-4 text-white fill-white shrink-0" stroke-width="2.5" />
                            Mulai AI Planner
                        </button>
                    </div>

                    <!-- Right Column: Features Panel (Mengapa Memilih...) -->
                    <div class="lg:col-span-6 flex justify-center w-full relative">
                        <!-- Decorative Back Gradients -->
                        <div class="absolute -top-12 -left-12 w-64 h-64 bg-[#E6F7FA] rounded-full blur-3xl opacity-50 z-0"></div>
                        <div class="absolute -bottom-12 -right-12 w-64 h-64 bg-[#7F9ED2] rounded-full blur-3xl opacity-35 z-0"></div>

                        <div class="relative w-full max-w-md bg-white/40 backdrop-blur-md border border-white/60 p-8 rounded-[2.5rem] shadow-2xl z-10 flex flex-col gap-6">
                            <div>
                                <h3 class="text-lg font-bold text-[#3F5C7D] font-sans">
                                    Mengapa Memilih AI Trip Planner?
                                </h3>
                                <div class="w-12 h-1 bg-gradient-to-r from-[#7F9ED2] to-[#8ED3D8] mt-2 rounded-full"></div>
                            </div>
                            
                            <div class="space-y-5">
                                <div class="group border-l-2 border-[#7F9ED2]/30 pl-4 hover:border-[#2C4E80] transition-all duration-300">
                                    <h4 class="text-sm font-bold text-[#3F5C7D] font-sans mb-1 group-hover:text-[#2C4E80] transition-colors">
                                        Rekomendasi Akurat
                                    </h4>
                                    <p class="text-slate-500 text-[11px] font-light leading-relaxed font-sans">
                                        Menganalisis kecocokan destinasi wisata Banyuwangi secara riil berdasarkan kategori dan aktivitas favorit Anda.
                                    </p>
                                </div>
                                
                                <div class="group border-l-2 border-[#7F9ED2]/30 pl-4 hover:border-[#2C4E80] transition-all duration-300">
                                    <h4 class="text-sm font-bold text-[#3F5C7D] font-sans mb-1 group-hover:text-[#2C4E80] transition-colors">
                                        Kesesuaian Kendaraan
                                    </h4>
                                    <p class="text-slate-500 text-[11px] font-light leading-relaxed font-sans">
                                        Menyaring tempat wisata dengan tingkat aksesibilitas jalan yang aman dilalui oleh kendaraan utama pilihan Anda.
                                    </p>
                                </div>
                                
                                <div class="group border-l-2 border-[#7F9ED2]/30 pl-4 hover:border-[#2C4E80] transition-all duration-300">
                                    <h4 class="text-sm font-bold text-[#3F5C7D] font-sans mb-1 group-hover:text-[#2C4E80] transition-colors">
                                        Kontrol Anggaran
                                    </h4>
                                    <p class="text-slate-500 text-[11px] font-light leading-relaxed font-sans">
                                        Mengoptimalkan pilihan destinasi yang masuk dalam toleransi budget harga tiket masuk per orang yang Anda tentukan.
                                    </p>
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
                            <p class="text-slate-400 text-xs font-light font-sans mt-0.5">Daftar pencarian rekomendasi destinasi kustom Anda yang tersimpan secara lokal.</p>
                        </div>
                        <button type="button" x-show="history.length > 0" @click="clearHistory()" class="px-4 py-2 text-xs text-red-500 hover:text-white font-semibold bg-white border border-red-200 hover:bg-red-500 hover:border-red-500 rounded-full transition-all duration-300 shadow-sm cursor-pointer font-sans" x-cloak>
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
                            <table class="w-full text-left border-collapse font-sans text-xs">
                                <thead>
                                    <tr class="bg-slate-50/70 border-b border-slate-100 text-slate-400 font-semibold uppercase tracking-wider text-[10px]">
                                        <th class="py-4 px-6">Tanggal</th>
                                        <th class="py-4 px-6">Gaya Travel</th>
                                        <th class="py-4 px-6">Kategori</th>
                                        <th class="py-4 px-6">Destinasi Terpilih</th>
                                        <th class="py-4 px-6 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100/80">
                                    <template x-for="(item, index) in history" :key="index">
                                        <tr class="hover:bg-slate-50/30 transition-colors duration-200 text-slate-600">
                                            <td class="py-4 px-6 font-medium text-slate-400" x-text="item.date"></td>
                                            <td class="py-4 px-6">
                                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full border border-emerald-100" x-text="item.travelType"></span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex flex-wrap gap-1">
                                                    <template x-for="cat in item.categories.slice(0, 2)">
                                                        <span class="px-2 py-0.5 bg-[#E6F7FA] text-[#3F5C7D] text-[10px] font-medium rounded-md border border-[#CDEBF2]" x-text="cat"></span>
                                                    </template>
                                                    <template x-if="item.categories.length > 2">
                                                        <span class="px-1.5 py-0.5 bg-slate-50 text-slate-400 text-[10px] rounded-md border border-slate-100" x-text="'+' + (item.categories.length - 2)"></span>
                                                    </template>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <p class="max-w-xs md:max-w-sm truncate text-slate-500 font-light text-[11px] m-0" x-text="item.destinations.join(', ')"></p>
                                            </td>
                                            <td class="py-4 px-6 text-right">
                                                <a :href="item.url" class="inline-flex items-center gap-1 px-4 py-1.5 bg-[#3F5C7D]/10 hover:bg-[#3F5C7D] text-[#3F5C7D] hover:text-white font-bold rounded-full transition-all duration-300 no-underline text-[10px]">
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
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_12px_40px_rgba(0,0,0,0.03)] p-8 md:p-12 min-h-[480px] flex flex-col justify-between">
                        
                        <!-- STEP 1: Kategori Wisata -->
                        <div x-show="step === 1" class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Apa tipe liburan favoritmu?</h2>
                                <p class="text-slate-400 text-xs font-sans font-light mt-1.5">Pilih kategori wisata untuk membantu AI kami mencari destinasi terbaik.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($categories as $category)
                                    <x-planner-option 
                                        type="checkbox" 
                                        name="categories[]" 
                                        value="{{ $category->id }}" 
                                        title="Wisata {{ $category->name }}" 
                                        x-model="categories"
                                    />
                                @endforeach
                            </div>
                        </div>

                        <!-- STEP 2: Aktivitas yang Disukai -->
                        <div x-show="step === 2" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Aktivitas apa yang paling kamu inginkan?</h2>
                                <p class="text-slate-400 text-xs font-sans font-light mt-1.5">Pilih aktivitas favoritmu selama menjelajahi Banyuwangi.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($activities as $activity)
                                    <x-planner-option 
                                        type="checkbox" 
                                        name="activities[]" 
                                        value="{{ $activity->id }}" 
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
                                <p class="text-slate-400 text-xs font-sans font-light mt-1.5">Pilih satu gaya perjalanan yang paling mendeskripsikan liburanmu.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($travelTypes as $type)
                                    <x-planner-option 
                                        type="radio" 
                                        name="travel_type" 
                                        value="{{ $type->id }}" 
                                        title="Gaya {{ $type->name }}" 
                                        x-model="travelType"
                                    />
                                @endforeach
                            </div>
                        </div>

                        <!-- STEP 4: Transportasi -->
                        <div x-show="step === 4" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Kendaraan apa yang akan digunakan?</h2>
                                <p class="text-slate-400 text-xs font-sans font-light mt-1.5">Kami akan mencocokkan akses jalan destinasi dengan kendaraanmu.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                @foreach($transportations as $trans)
                                    <x-planner-option 
                                        type="radio" 
                                        name="transportation" 
                                        value="{{ $trans->id }}" 
                                        title="{{ $trans->name }}" 
                                        x-model="transportation"
                                    />
                                @endforeach
                            </div>
                        </div>

                        <!-- STEP 5: Waktu Kunjungan -->
                        <div x-show="step === 5" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Kapan waktu kunjungan favoritmu?</h2>
                                <p class="text-slate-400 text-xs font-sans font-light mt-1.5">Pilih satu atau beberapa waktu kunjungan yang paling ideal.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                @foreach($visitTimes as $time)
                                    <x-planner-option 
                                        type="checkbox" 
                                        name="visit_time[]" 
                                        value="{{ $time->id }}" 
                                        title="{{ $time->name }}" 
                                        x-model="visitTime"
                                    />
                                @endforeach
                            </div>
                        </div>

                        <!-- STEP 6: Budget Tiket Masuk -->
                        <div x-show="step === 6" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Berapa alokasi budget tiket masukmu?</h2>
                                <p class="text-slate-400 text-xs font-sans font-light mt-1.5">Sesuaikan rentang harga tiket per orang yang nyaman bagi Anda.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <x-planner-option 
                                    type="radio" 
                                    name="budget" 
                                    value="hemat" 
                                    title="Hemat" 
                                    x-model="budget"
                                />
                                <x-planner-option 
                                    type="radio" 
                                    name="budget" 
                                    value="sedang" 
                                    title="Sedang" 
                                    x-model="budget"
                                />
                                <x-planner-option 
                                    type="radio" 
                                    name="budget" 
                                    value="mewah" 
                                    title="Mewah / Premium" 
                                    x-model="budget"
                                />
                            </div>
                        </div>

                        <!-- STEP 7: Aksesibilitas Lokasi -->
                        <div x-show="step === 7" class="space-y-6" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Bagaimana toleransi akses medannya?</h2>
                                <p class="text-slate-400 text-xs font-sans font-light mt-1.5">Kami menyesuaikan rute berdasarkan tingkat kemudahan akses jalan ke lokasi.</p>
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
                                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-sans">Suasana keramaian seperti apa yang dicari?</h2>
                                <p class="text-slate-400 text-xs font-sans font-light mt-1.5">Sesuaikan tingkat kepadatan pengunjung demi kenyamanan Anda.</p>
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
                                    Cari Rekomendasi Destinasi <x-lucide-sparkles class="w-4 h-4 text-white" stroke-width="2.5" />
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

            <h3 class="text-2xl font-bold font-sans tracking-wide mb-3">AI Trip Planner sedang memproses</h3>
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
