<x-guest-portal-layout>
    <x-slot name="title">Tentang Kami - Laras Banyuwangi</x-slot>

    <!-- Header Section -->
    <div class="relative bg-gradient-to-r from-[#7F9ED2] to-[#8ED3D8] py-20 text-center text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-sans tracking-tight">Tentang Kami</h1>
            <p
                class="text-white/95 max-w-3xl mx-auto text-base md:text-lg font-light leading-relaxed font-sans mb-8 md:mb-10">
                Kami hadir untuk membantu wisatawan menemukan pengalaman terbaik<br class="hidden md:block" />
                di Banyuwangi melalui teknologi dan rekomendasi cerdas.
            </p>
        </div>
        <!-- Wave SVG -->
        <div class="absolute -bottom-[1px] left-0 right-0 w-full overflow-hidden leading-none z-0">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none"
                class="relative block w-full h-[50px] text-white fill-current">
                <path d="M0,80 C360,130 720,30 1200,80 L1200,120 L0,120 Z"></path>
            </svg>
        </div>
    </div>

    <!-- Content Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Centered Logo -->
            <div class="flex justify-center mb-10">
                <img class="max-w-[750px] w-full h-auto object-contain" src="{{ asset('images/logo-about.png') }}"
                    alt="Laras Banyuwangi Logo">
            </div>

            <!-- Title: Siapa Kami? -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-[2.75rem] font-bold font-sans tracking-tight">
                    <span class="text-[#3F5C7D]">Siapa</span> <span
                        class="bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] bg-clip-text text-transparent">Kami?</span>
                </h2>
            </div>

            <!-- Three Column Cards (5-3-4 layout) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch mb-20">
                <!-- Column 1: Mengenal Lebih Dekat (col-span-5) -->
                <div
                    class="col-span-12 lg:col-span-5 p-8 rounded-[2rem] bg-white border border-slate-100 shadow-[0_12px_28px_rgba(0,0,0,0.03)] hover:shadow-lg transition-shadow flex flex-col justify-center">
                    <h3 class="text-2xl md:text-3xl font-bold text-[#3F5C7D] mb-1 font-sans leading-tight">Mengenal
                        Lebih Dekat</h3>
                    <h2 class="text-xl md:text-4xl font-bold mb-6 font-sans"><span
                            class="bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] bg-clip-text text-transparent">Laras
                            Banyuwangi</span></h2>
                    <p class="text-slate-600 font-sans text-xs leading-relaxed text-sm md:text-base mb-4">
                        "Laras" dalam budaya lokal bermakna keselarasan. Kami percaya bahwa pariwisata sejati bukan
                        sekadar mengunjungi tempat, melainkan sebuah dialog antara pengunjung, masyarakat lokal, dan
                        kelestarian alam.
                    </p>
                    <p class="text-slate-600 font-sans text-xs leading-relaxed text-sm md:text-base">
                        Berawal dari kecintaan terhadap keindahan Banyuwangi yang belum sepenuhnya terekspos, kami
                        mendedikasikan platform ini sebagai jembatan bagi para penjelajah untuk menemukan esensi
                        sesungguhnya dari 'The Sunrise of Java'.
                    </p>
                </div>

                <!-- Column 2: Visi Kami (col-span-3) -->
                <div
                    class="col-span-12 lg:col-span-3 p-8 rounded-[2rem] bg-white border border-slate-100 shadow-[0_12px_28px_rgba(0,0,0,0.03)] hover:shadow-lg transition-shadow flex flex-col items-center text-center justify-center">
                    <div class="w-12 h-12 rounded-full bg-[#3F5C7D] flex items-center justify-center text-white mb-6">
                        <x-lucide-eye class="w-6 h-6" />
                    </div>
                    <p class="text-slate-600 font-sans text-xs leading-relaxed text-sm md:text-base">
                        Menjadi pintu gerbang utama yang memperkenalkan pesona otentik Banyuwangi ke dunia, sekaligus
                        menjadi pelopor pariwisata berkelanjutan yang menjunjung tinggi kearifan lokal.
                    </p>
                </div>

                <!-- Column 3: Misi Kami (col-span-4) -->
                <div
                    class="col-span-12 lg:col-span-4 p-8 rounded-[2rem] bg-white border border-slate-100 shadow-[0_12px_28px_rgba(0,0,0,0.03)] hover:shadow-lg transition-shadow flex flex-col justify-center">
                    <div
                        class="w-12 h-12 rounded-full bg-[#3F5C7D] flex items-center justify-center text-white mb-6 mx-auto">
                        <x-lucide-target class="w-6 h-6" />
                    </div>
                    <ul class="space-y-6">
                        <li class="flex items-start gap-3">
                            <div
                                class="w-7 h-7 rounded-full bg-[#E6F7FA] text-[#3F5C7D] flex items-center justify-center shrink-0">
                                <x-lucide-leaf class="w-4 h-4 text-[#3F5C7D]" />
                            </div>
                            <span class="text-slate-600 font-sans text-xs md:text-sm leading-relaxed">Mendukung praktik
                                pariwisata yang tidak merusak lingkungan alam serta menjaga ekosistem Banyuwangi.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div
                                class="w-7 h-7 rounded-full bg-[#E6F7FA] text-[#3F5C7D] flex items-center justify-center shrink-0">
                                <x-lucide-users class="w-4 h-4 text-[#3F5C7D]" />
                            </div>
                            <span class="text-slate-600 font-sans text-xs md:text-sm leading-relaxed">Melibatkan
                                komunitas lokal secara aktif dalam ekosistem pariwisata untuk meningkatkan kesejahteraan
                                bersama.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div
                                class="w-7 h-7 rounded-full bg-[#E6F7FA] text-[#3F5C7D] flex items-center justify-center shrink-0">
                                <x-lucide-compass class="w-4 h-4 text-[#3F5C7D]" />
                            </div>
                            <span class="text-slate-600 font-sans text-xs md:text-sm leading-relaxed">Menyediakan kurasi
                                pengalaman perjalanan yang bermakna, edukatif, dan tak terlupakan bagi setiap
                                pengunjung.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--  Section: Tim Pengembang Laras -->
    <div class="py-24 bg-[#CDEBF2]/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-[#3F5C7D] mb-4 font-sans">
                    Tim Pengembang <span
                        class="bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] bg-clip-text text-transparent">Laras</span>
                </h2>
                <p class="text-slate-500 max-w-3xl mx-auto font-sans text-sm md:text-base leading-relaxed">
                    Tim lintas disiplin yang menggabungkan keahlian ui ux, full-stack development, dan machine learning
                    untuk menciptakan solusi digital yang bermanfaat bagi pariwisata Banyuwangi.
                </p>
            </div>

            <!-- Developer Grid - Flex Wrapping with Fixed Width Cards -->
            <div class="flex flex-wrap justify-center gap-6">
                <!-- Dev 1: Clarisah -->
                <x-developer-card tag="Machine Learning" name="Clarisah" role="Machine Learning Engineer"
                    image="{{ asset('images/clarisah.png') }}"
                    linkedin="www.linkedin.com/in/clarissa-ingnasia-659323282" />

                <!-- Dev 2: Dyah -->
                <x-developer-card tag="Machine Learning" name="Dyah" role="Machine Learning Engineer"
                    image="{{ asset('images/nana.png') }}" linkedin="www.linkedin.com/in/dyahinkud" />

                <!-- Dev 3: Dicky -->
                <x-developer-card tag="Front End & Back End" name="Dicky" role="Fullstack Developer"
                    image="{{ asset('images/dickyha.png') }}" linkedin="www.linkedin.com/in/dickyhaa" />

                <!-- Dev 4: Feomita -->
                <x-developer-card tag="Front End & Back End" name="Feomita" role="Fullstack Developer"
                    image="{{ asset('images/feomita.png') }}"
                    linkedin="www.linkedin.com/in/feomita-ramadhany-fudiansah-90767828b" />

                <!-- Dev 5: Sophia -->
                <x-developer-card tag="UI UX Designer" name="Sophia" role="UI UX"
                    image="{{ asset('images/sopia.png') }}" linkedin="www.linkedin.com/in/sophiaanindita" />
            </div>
        </div>
    </div>
</x-guest-portal-layout>
