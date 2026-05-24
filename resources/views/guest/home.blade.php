<x-guest-portal-layout>
    <x-slot name="title">Laras Banyuwangi - Temukan Destinasi Wisata Pilihanmu</x-slot>

    <!-- 1. Hero Section -->
    <div class="relative bg-slate-900 overflow-hidden min-h-screen flex items-center pt-20">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('images/bg-login.jpg') }}');"></div>
        <!-- Dark gradient overlay matching mockup -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#12263f]/30 via-[#12263f]/40 to-[#12263f]/85 z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 text-white py-24 md:py-32 text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-6 leading-tight font-sans">
                    Temukan Destinasi Wisata Banyuwangi yang Selaras dengan Pilihanmu
                </h1>
                <p class="text-lg md:text-xl text-slate-100/90 mb-10 leading-relaxed font-light max-w-3xl mx-auto font-sans">
                    Cari dan rencanakan liburan impian Anda, mulai dari menjelajahi keindahan alam, hingga mendapatkan rekomendasi itinerary pintar.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/explore" class="px-8 py-4 bg-[#3F5C7D] hover:bg-[#344d6b] text-white font-semibold rounded-full text-center shadow-lg transition-all hover:shadow-xl hover:translate-y-[-1px] active:translate-y-[1px]">
                        Mulai Jelajah
                    </a>
                    <a href="/planner" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-full text-center border border-white/20 transition-all hover:translate-y-[-1px] active:translate-y-[1px] backdrop-blur-sm">
                        AI Planner
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Section: Lebih dari Sekadar Destinasi -->
    <div class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 max-w-4xl mx-auto">
                <h2 class="text-3xl md:text-5xl font-bold text-slate-900 mb-6 leading-tight">
                    Lebih dari Sekadar <span class="text-[#89A8E0]">Destinasi</span>,<br/>
                    <span class="text-[#89A8E0]">Banyuwangi</span> adalah Pengalaman
                </h2>
                <p class="text-slate-500 leading-relaxed text-base font-light font-sans">
                    Setiap sudut Banyuwangi menyimpan cerita. Dari gemuruh api biru Kawah Ijen, hingga tenangnya ombak Pantai Pulau Merah. Kami hadir untuk membantu Anda merancang petualangan yang tak terlupakan di ujung timur Pulau Jawa.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="p-8 rounded-[2rem] border border-[#CDEBF2] bg-[#E6F7FA]/30 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300 flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-2xl bg-[#E6F7FA] flex items-center justify-center text-[#3F5C7D] mb-6 border border-[#CDEBF2]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#3F5C7D] mb-3">Destinasi Wisata</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-sans">jelajah berbagai destinasi wisata menarik mulai dari pantai eksotis, pegunungan megah, hingga keunikan budaya lokal.</p>
                </div>

                <!-- Card 2 -->
                <div class="p-8 rounded-[2rem] border border-[#CDEBF2] bg-[#E6F7FA]/30 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300 flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-2xl bg-[#E6F7FA] flex items-center justify-center text-[#8ED3D8] mb-6 border border-[#CDEBF2]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#3F5C7D] mb-3">AI Planner</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-sans">Dapatkan rekomendasi itinerary perjalanan kustom secara pintar berdasarkan alokasi waktu dan budget Anda.</p>
                </div>

                <!-- Card 3 -->
                <div class="p-8 rounded-[2rem] border border-[#CDEBF2] bg-[#E6F7FA]/30 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300 flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-2xl bg-[#E6F7FA] flex items-center justify-center text-[#89A8E0] mb-6 border border-[#CDEBF2]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#3F5C7D] mb-3">Blog Banyuwangi</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-sans">Temukan artikel menarik, cerita budaya khas Osing, kuliner tradisional, serta tips perjalanan terbaru.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Section: AI Planner -->
    <div class="py-20 bg-[#E6F7FA]/40 border-y border-[#CDEBF2]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Details -->
                <div class="lg:col-span-6 flex flex-col items-start text-left">
                    <span class="text-xs font-semibold uppercase tracking-widest text-[#3F5C7D] mb-3">Sistem Rekomendasi Cerdas</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-[#3F5C7D] mb-6 font-sans">AI Planner</h2>
                    <p class="text-slate-600 mb-8 font-light text-base leading-relaxed font-sans">
                        Kami menggunakan teknologi AI untuk merancang itinerary perjalanan Anda secara maksimal sesuai preferensi dan durasi berlibur di Banyuwangi.
                    </p>
                    
                    <!-- Stepper -->
                    <div class="space-y-6 mb-10 w-full font-sans">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-[#89A8E0] text-white flex items-center justify-center font-bold text-sm shrink-0">1</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base mb-1">Pilih Preferensi</h4>
                                <p class="text-slate-500 text-sm">Tentukan jenis wisata, budget, dan waktu yang Anda miliki.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-[#8ED3D8] text-white flex items-center justify-center font-bold text-sm shrink-0">2</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base mb-1">Sistem Menganalisis</h4>
                                <p class="text-slate-500 text-sm">Algoritma kami akan mencari destinasi terbaik yang paling cocok.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-[#4cb399] text-white flex items-center justify-center font-bold text-sm shrink-0">3</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base mb-1">Rencana Perjalanan Jadi</h4>
                                <p class="text-slate-500 text-sm">Itinerary harian yang siap digunakan beserta estimasi alokasi biaya.</p>
                            </div>
                        </div>
                    </div>

                    <a href="/planner" class="px-8 py-4 bg-[#3F5C7D] hover:bg-[#344d6b] text-white font-semibold rounded-full shadow-md transition-all hover:shadow-lg">
                        Coba AI Planner
                    </a>
                </div>

                <!-- Right Mockup Image with Gradient Container -->
                <div class="lg:col-span-6 flex justify-center w-full">
                    <div class="relative w-full max-w-lg aspect-[4/3] bg-gradient-to-tr from-[#3F5C7D] to-[#89A8E0] rounded-[2.5rem] p-6 sm:p-10 flex items-center justify-center shadow-2xl overflow-hidden">
                        <div class="absolute inset-0 bg-white/5 backdrop-blur-[1px] pointer-events-none"></div>
                        <img class="max-w-[90%] h-auto object-contain drop-shadow-2xl z-10 transition-transform duration-500 hover:scale-[1.03]" src="{{ asset('images/laptop-mockup.jpg') }}" alt="AI Planner Laptop Mockup">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Section: Destinasi Populer -->
    <div class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 font-sans">
                        Destinasi <span class="text-[#89A8E0]">Populer</span>
                    </h2>
                    <p class="text-slate-500 font-sans">Jelajahi tempat-tempat favorit pilihan wisatawan di Banyuwangi.</p>
                </div>
                <a href="/explore" class="text-[#3F5C7D] font-semibold text-sm hover:underline mt-4 md:mt-0 flex items-center gap-1 font-sans">
                    Lihat semua destinasi
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Destinasi 1 -->
                <x-destination-card 
                    category="Alam" 
                    location="Licin, Banyuwangi" 
                    title="Kawah Ijen" 
                    description="Fenomena blue fire yang menakjubkan dan kawah asam terbesar di dunia." 
                    image="https://images.unsplash.com/photo-1578507065211-1768857cf1b7?auto=format&fit=crop&w=600&q=80" 
                    link="/explore" />

                <!-- Destinasi 2 -->
                <x-destination-card 
                    category="Pantai" 
                    location="Pesanggaran, Banyuwangi" 
                    title="Pulau Merah" 
                    description="Nikmati keindahan sunset emas dan bukit merah yang berada di tepi pantai." 
                    image="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" 
                    link="/explore" />

                <!-- Destinasi 3 -->
                <x-destination-card 
                    category="Hutan" 
                    location="Benculuk, Banyuwangi" 
                    title="De Djawatan" 
                    description="Hutan trembesi magis ala film Lord of the Rings di Banyuwangi." 
                    image="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=600&q=80" 
                    link="/explore" />
            </div>
        </div>
    </div>

    <!-- 5. Section: Blog & Artikel -->
    <div class="py-24 bg-[#E6F7FA]/20 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 font-sans">
                        Blog <span class="text-[#89A8E0]">Artikel</span>
                    </h2>
                    <p class="text-slate-500 font-sans">Menarik, Informatif, dan Up to Date.</p>
                </div>
                <a href="/blog" class="text-[#3F5C7D] font-semibold text-sm hover:underline mt-4 md:mt-0 flex items-center gap-1 font-sans">
                    Lihat semua artikel
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Blog 1 -->
                <x-blog-card 
                    category="Kuliner" 
                    date="10 Juni 2026" 
                    title="5 Makanan Khas Banyuwangi yang Wajib Dicoba" 
                    description="Dari pedasnya Nasi Tempong hingga gurihnya Rujak Soto yang unik..." 
                    image="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80" 
                    link="/blog" />

                <!-- Blog 2 -->
                <x-blog-card 
                    category="Tips" 
                    date="15 Juni 2026" 
                    title="Panduan Transportasi Keliling Banyuwangi" 
                    description="Tips memilih transportasi terbaik untuk keliling destinasi..." 
                    image="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=600&q=80" 
                    link="/blog" />

                <!-- Blog 3 -->
                <x-blog-card 
                    category="Budaya" 
                    date="20 Juni 2026" 
                    title="Mengenal Lebih Dekat Suku Osing" 
                    description="Menelusuri sejarah, tradisi, dan keunikan adat suku asli Banyuwangi..." 
                    image="https://images.unsplash.com/photo-1590756254933-2873d72a83b6?auto=format&fit=crop&w=600&q=80" 
                    link="/blog" />
            </div>
        </div>
    </div>

    <!-- 6. Section: Tim Pengembang Laras -->
    <div class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 font-sans">
                    Tim Pengembang <span class="text-[#89A8E0]">Laras</span>
                </h2>
                <p class="text-slate-500 max-w-3xl mx-auto font-sans text-sm md:text-base leading-relaxed">
                    Tim lintas disiplin yang menggabungkan keahlian ui ux, full-stack development, dan machine learning untuk menciptakan solusi digital yang bermanfaat bagi pariwisata Banyuwangi.
                </p>
            </div>

            <!-- Developer Grid - Flex Wrapping with Fixed Width Cards -->
            <div class="flex flex-wrap justify-center gap-6">
                <!-- Dev 1: Clarisah -->
                <x-developer-card 
                    tag="Machine Learning" 
                    name="Clarisah" 
                    role="Machine Learning Engineer" 
                    image="{{ asset('images/clarisah.png') }}"
                    linkedin="www.linkedin.com/in/clarissa-ingnasia-659323282" />

                <!-- Dev 2: Dyah -->
                <x-developer-card 
                    tag="Machine Learning" 
                    name="Dyah" 
                    role="Machine Learning Engineer" 
                    image="{{ asset('images/nana.png') }}"
                    linkedin="www.linkedin.com/in/dyahinkud" />

                <!-- Dev 3: Dicky -->
                <x-developer-card 
                    tag="Front End & Back End" 
                    name="Dicky" 
                    role="Fullstack Developer" 
                    image="{{ asset('images/dickyha.png') }}"
                    linkedin="www.linkedin.com/in/dickyhaa" />

                <!-- Dev 4: Feomita -->
                <x-developer-card 
                    tag="Front End & Back End" 
                    name="Feomita" 
                    role="Fullstack Developer" 
                    image="{{ asset('images/feomita.png') }}"
                    linkedin="www.linkedin.com/in/feomita-ramadhany-fudiansah-90767828b" />

                <!-- Dev 5: Sophia -->
                <x-developer-card 
                    tag="UI UX Designer" 
                    name="Sophia" 
                    role="UI UX" 
                    image="{{ asset('images/sopia.png') }}"
                    linkedin="www.linkedin.com/in/sophiaanindita" />
            </div>
        </div>
    </div>

    <!-- 7. Section: CTA -->
    <div class="relative py-28 bg-slate-900 overflow-hidden flex items-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-slate-950/40 to-transparent z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 text-white text-center md:text-left py-12">
            <div class="max-w-2xl">
                <h2 class="text-3xl md:text-5xl font-bold tracking-tight mb-4 leading-tight font-sans">
                    Siap Menjelajah Banyuwangi?
                </h2>
                <p class="text-base md:text-lg text-slate-200 mb-8 leading-relaxed font-light font-sans">
                    Mulai perjalanan Anda sekarang bersama portal wisata Laras Banyuwangi.
                </p>
                <a href="/explore" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl text-center border border-white/20 transition-all hover:translate-y-[-1px] active:translate-y-[1px] backdrop-blur-sm">
                    jelajah Sekarang
                </a>
            </div>
        </div>
    </div>
</x-guest-portal-layout>
