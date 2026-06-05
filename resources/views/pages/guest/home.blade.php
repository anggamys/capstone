<x-guest-portal-layout>
    <x-slot name="title">Laras Banyuwangi - Temukan Destinasi Wisata Pilihanmu</x-slot>

    <!-- 1. Hero Section -->
    <div class="relative bg-slate-900 overflow-hidden min-h-screen flex items-center pt-20">
        <!-- Background Image with Overlay -->
        {!! '<' . 'style>.hero-bg { background-image: url(' . asset('images/bg-login.jpg') . '); }</' . 'style>' !!}
        <div class="absolute inset-0 bg-cover bg-center z-0 hero-bg"></div>
        <!-- Dark gradient overlay matching mockup -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#12263f]/30 via-[#12263f]/40 to-[#12263f]/85 z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 text-white py-24 md:py-32 text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-6 leading-tight font-sans">
                    Temukan Destinasi Wisata<br class="hidden md:block" />
                    Banyuwangi yang<br class="hidden md:block" />
                    Selaras dengan Pilihanmu
                </h1>
                <p
                    class="text-lg md:text-xl text-slate-100/90 mb-10 leading-relaxed font-light max-w-3xl mx-auto font-sans">
                    Cari dan rencanakan liburan impian Anda, mulai dari menjelajahi keindahan alam, hingga mendapatkan
                    rekomendasi itinerary pintar.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/planner"
                        class="px-8 py-4 bg-gradient-to-r from-[#89A8E0] to-[#3F5C7D] hover:from-[#7f9ed2] hover:to-[#344d6b] text-white font-semibold rounded-full text-center shadow-lg shadow-[#3F5C7D]/25 transition-all hover:translate-y-[-1px] active:translate-y-[1px] flex items-center justify-center gap-2">
                        <x-lucide-sparkles class="w-4 h-4 text-white" stroke-width="2.5" />
                        Mulai AI Planner
                    </a>
                    <a href="/explore"
                        class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-full text-center border border-white/20 transition-all hover:translate-y-[-1px] active:translate-y-[1px] backdrop-blur-sm flex items-center justify-center">
                        Jelajah Destinasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Section: Lebih dari Sekadar Destinasi -->
    <div class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 max-w-4xl mx-auto">
                <h2 class="text-3xl md:text-5xl font-bold text-[#3F5C7D] mb-6 leading-tight font-sans">
                    Lebih dari Sekadar <span
                        class="bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] bg-clip-text text-transparent">Destinasi</span>,<br />
                    <span
                        class="bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] bg-clip-text text-transparent">Banyuwangi</span>
                    adalah Pengalaman
                </h2>
                <!-- Gradient Underline Divider -->
                <div class="w-32 h-1.5 bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] mx-auto mt-6 mb-8 rounded-full">
                </div>
                <p class="text-slate-500 leading-relaxed text-base font-light font-sans">
                    Setiap sudut Banyuwangi menyimpan cerita. Dari gemuruh api biru Kawah Ijen, hingga tenangnya ombak
                    Pantai Pulau Merah. Kami hadir untuk membantu Anda merancang petualangan yang tak terlupakan di
                    ujung timur Pulau Jawa.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div
                    class="p-8 rounded-[2rem] border border-[#CDEBF2] bg-[#E6F7FA]/30 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300 flex flex-col items-center text-center">
                    <div
                        class="w-14 h-14 rounded-2xl bg-[#E6F7FA] flex items-center justify-center text-[#3F5C7D] mb-6 border border-[#CDEBF2]">
                        <x-lucide-compass class="w-6 h-6" />
                    </div>
                    <h3 class="text-xl font-bold text-[#3F5C7D] mb-3">Destinasi Wisata</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-sans">jelajah berbagai destinasi wisata
                        menarik mulai dari pantai eksotis, pegunungan megah, hingga keunikan budaya lokal.</p>
                </div>

                <!-- Card 2 -->
                <div
                    class="p-8 rounded-[2rem] border border-[#CDEBF2] bg-[#E6F7FA]/30 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300 flex flex-col items-center text-center">
                    <div
                        class="w-14 h-14 rounded-2xl bg-[#E6F7FA] flex items-center justify-center text-[#8ED3D8] mb-6 border border-[#CDEBF2]">
                        <x-lucide-route class="w-6 h-6" />
                    </div>
                    <h3 class="text-xl font-bold text-[#3F5C7D] mb-3">AI Planner</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-sans">Dapatkan rekomendasi itinerary
                        perjalanan kustom secara pintar berdasarkan alokasi waktu dan budget Anda.</p>
                </div>

                <!-- Card 3 -->
                <div
                    class="p-8 rounded-[2rem] border border-[#CDEBF2] bg-[#E6F7FA]/30 hover:bg-white hover:shadow-xl hover:border-transparent transition-all duration-300 flex flex-col items-center text-center">
                    <div
                        class="w-14 h-14 rounded-2xl bg-[#E6F7FA] flex items-center justify-center text-[#89A8E0] mb-6 border border-[#CDEBF2]">
                        <x-lucide-newspaper class="w-6 h-6" />
                    </div>
                    <h3 class="text-xl font-bold text-[#3F5C7D] mb-3">Blog Banyuwangi</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-sans">Temukan blog menarik, cerita budaya khas
                        Osing, kuliner tradisional, serta tips perjalanan terbaru.</p>
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
                    <span class="text-xs font-semibold uppercase tracking-widest text-[#3F5C7D] mb-3">Sistem Rekomendasi
                        Cerdas</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-[#3F5C7D] mb-6 font-sans">AI Planner</h2>

                    <!-- Mockup image for mobile view (placed right under title) -->
                    <div class="block lg:hidden w-full mb-8">
                        <div class="relative w-full max-w-2xl aspect-[4/3] bg-gradient-to-tr from-[#3F5C7D] via-[#89A8E0] to-[#CDEBF2] rounded-[2rem] shadow-xl overflow-hidden">
                            <div class="absolute inset-0 bg-white/5 backdrop-blur-[1px] pointer-events-none"></div>
                            <img class="absolute inset-0 h-full w-full object-cover object-center"
                                src="{{ asset('images/laptop-mockup.jpg') }}" alt="AI Planner Laptop Mockup">
                        </div>
                    </div>

                    <p class="text-slate-600 mb-8 font-light text-base leading-relaxed font-sans">
                        Kami menggunakan teknologi AI untuk merancang itinerary perjalanan Anda secara maksimal sesuai
                        preferensi dan durasi berlibur di Banyuwangi.
                    </p>

                    <!-- Stepper -->
                    <div class="space-y-6 mb-10 w-full font-sans">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-[#3F5C7D] text-white flex items-center justify-center font-bold text-sm shrink-0">
                                1</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base mb-1">Pilih Preferensi</h4>
                                <p class="text-slate-500 text-sm">Tentukan jenis wisata, budget, dan waktu yang Anda
                                    miliki.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-[#89A8E0] text-white flex items-center justify-center font-bold text-sm shrink-0">
                                2</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base mb-1">Sistem Menganalisis</h4>
                                <p class="text-slate-500 text-sm">Algoritma kami akan mencari destinasi terbaik yang
                                    paling cocok.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-[#8ED3D8] text-white flex items-center justify-center font-bold text-sm shrink-0">
                                3</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base mb-1">Rencana Perjalanan Jadi</h4>
                                <p class="text-slate-500 text-sm">Itinerary harian yang siap digunakan beserta estimasi
                                    alokasi biaya.</p>
                            </div>
                        </div>
                    </div>

                    <a href="/planner"
                        class="px-8 py-4 bg-gradient-to-r from-[#89A8E0] to-[#3F5C7D] hover:from-[#7f9ed2] hover:to-[#344d6b] text-white font-semibold rounded-full text-center shadow-lg shadow-[#3F5C7D]/25 transition-all hover:translate-y-[-1px] active:translate-y-[1px] flex items-center justify-center gap-2">
                        <x-lucide-sparkles class="w-4 h-4 text-white" stroke-width="2.5" />
                        Mulai AI Planner
                    </a>
                </div>

                <!-- Right Mockup Image with Gradient Container (hidden on mobile, shown on desktop) -->
                <div class="hidden lg:flex lg:col-span-6 justify-center w-full">
                    <div
                        class="relative w-full max-w-2xl aspect-[4/3] bg-gradient-to-tr from-[#3F5C7D] via-[#89A8E0] to-[#CDEBF2] rounded-[2.5rem] shadow-2xl overflow-hidden">
                        <div class="absolute inset-0 bg-white/5 backdrop-blur-[1px] pointer-events-none"></div>
                        <img class="absolute inset-0 h-full w-full object-cover object-center transition-transform duration-500 hover:scale-[1.03]"
                            src="{{ asset('images/laptop-mockup.jpg') }}" alt="AI Planner Laptop Mockup">
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
                    <h2 class="text-3xl md:text-4xl font-bold text-[#3F5C7D] mb-4 font-sans">
                        Destinasi <span
                            class="bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] bg-clip-text text-transparent">Populer</span>
                    </h2>
                    <p class="text-slate-500 font-sans">Jelajahi tempat-tempat menakjubkan yang menjadi daya tarik utama
                        Banyuwangi.</p>
                </div>
                <a href="/explore"
                    class="text-[#3F5C7D] font-semibold text-sm hover:underline mt-4 md:mt-0 flex items-center gap-1 font-sans">
                    Lihat semua destinasi
                    <x-lucide-arrow-right class="w-4 h-4" stroke-width="2.5" />
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Destinasi 1 -->
                <x-destination-card category="Alam" location="Licin, Banyuwangi" title="Kawah Ijen"
                    description="Fenomena blue fire yang menakjubkan dan kawah asam terbesar di dunia."
                    image="{{ asset('images/kawah-ijen.png') }}" link="/explore/kawah-ijen" />

                <!-- Destinasi 2 -->
                <x-destination-card category="Pantai" location="Pesanggaran, Banyuwangi" title="Pulau Merah"
                    description="Nikmati keindahan sunset emas dan bukit merah yang berada di tepi pantai."
                    image="{{ asset('images/pulau-merah.png') }}" link="/explore/pantai-pulau-merah" />

                <!-- Destinasi 3 -->
                <x-destination-card category="Hutan" location="Benculuk, Banyuwangi" title="De Djawatan"
                    description="Hutan trembesi magis ala film Lord of the Rings di Banyuwangi."
                    image="{{ asset('images/de-djawatan.png') }}" link="/explore/de-djawatan" />
            </div>
        </div>
    </div>

    <!-- 5. Section: Blog -->
    <div class="py-24 bg-[#E6F7FA]/20 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-[#3F5C7D] mb-4 font-sans">
                        Blog <span
                            class="bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] bg-clip-text text-transparent">Terbaru</span>
                    </h2>
                    <p class="text-slate-500 font-sans">Blog Terbaru Seputar Banyuwangi dan Wisata</p>
                </div>
                <a href="{{ route('blog') }}"
                    class="text-[#3F5C7D] font-semibold text-sm hover:underline mt-4 md:mt-0 flex items-center gap-1 font-sans">
                    Lihat semua blog
                    <x-lucide-arrow-right class="w-4 h-4" stroke-width="2.5" />
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($blogs as $blog)
                    <x-blog-card :category="$blog->category?->name ?? 'Umum'" :date="$blog->published_at
                        ? $blog->published_at->translatedFormat('d F Y')
                        : $blog->created_at->translatedFormat('d F Y')" :title="$blog->title" :description="\Illuminate\Support\Str::limit(strip_tags($blog->content), 120)"
                        :image="$blog->image_url" :link="route('blog.show', $blog->slug)" :author="$blog->admin?->name ?? 'Admin Laras'" />
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-3xl border border-slate-100 shadow-sm">
                        <p class="text-slate-500 font-sans font-light">Belum ada blog yang diterbitkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- 6. Section: Tim Pengembang Laras -->
    <div class="py-24 bg-[#CDEBF2]/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-[#3F5C7D] mb-4 font-sans">
                    Tim Pengembang <span
                        class="bg-gradient-to-r from-[#89A8E0] to-[#8ED3D8] bg-clip-text text-transparent">Laras</span>
                </h2>
                <p class="text-slate-500 max-w-3xl mx-auto font-sans text-sm md:text-base leading-relaxed">
                    Tim lintas disiplin yang menggabungkan keahlian ui ux, full-stack development, dan machine learning<br class="hidden md:block" />
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

    <!-- 7. Section: CTA -->
    <div class="relative py-28 bg-slate-900 overflow-hidden flex items-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center z-0"
            style="background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80');">
        </div>
        <div class="absolute inset-0 bg-slate-950/60 z-10"></div>

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 text-white text-center py-12 flex flex-col items-center justify-center w-full">
            <div class="max-w-2xl mx-auto flex flex-col items-center">
                <h2 class="text-3xl md:text-5xl font-bold tracking-tight mb-4 leading-tight font-sans">
                    Siap Menjelajah Banyuwangi?
                </h2>
                <p class="text-base md:text-lg text-slate-200 mb-8 leading-relaxed font-light font-sans">
                    Mulai perjalanan Anda sekarang bersama portal wisata Laras Banyuwangi.
                </p>
                <a href="/explore"
                    class="inline-flex items-center justify-center px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-full border border-white/20 transition-all hover:translate-y-[-1px] active:translate-y-[1px] backdrop-blur-sm shadow-md">
                    Jelajah Destinasi
                </a>
            </div>
        </div>
    </div>
</x-guest-portal-layout>
