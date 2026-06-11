<x-guest-portal-layout>
    <x-slot name="title">Jelajah Wisata - Laras Banyuwangi</x-slot>

    <!-- Header Section -->
    <div class="relative bg-gradient-to-r from-[#7F9ED2] to-[#8ED3D8] py-20 text-center text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-sans tracking-tight">Jelajah Destinasi</h1>
            <p class="text-white/95 max-w-3xl mx-auto text-base md:text-lg font-light leading-relaxed font-sans">
                Temukan keindahan alam tersembunyi, seni budaya yang sakral,<br class="hidden md:block" />
                dan kuliner khas Banyuwangi yang menggugah selera.
            </p>
        </div>
        <!-- Wave SVG -->
        <div class="absolute -bottom-[2px] left-0 right-0 w-full overflow-hidden leading-none z-10">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-[52px] text-slate-50 fill-current translate-y-[1px] scale-y-[1.05]">
                <path d="M0,60 C300,10 600,110 900,60 C1050,35 1150,45 1200,60 L1200,120 L0,120 Z" stroke="none"></path>
            </svg>
        </div>
    </div>

    <!-- Content Section wrapper -->
    <div class="pt-8 pb-16 bg-slate-50 min-h-[50vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Search Bar (Centered) -->
            <div class="mb-6 flex flex-col items-center justify-center text-center max-w-xl mx-auto">
                <form action="{{ route('explore') }}" method="GET" class="w-full">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <!-- Search Input -->
                    <div class="relative w-full shadow-sm rounded-2xl">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                            </svg>
                        </span>
                        <input 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari destinasi atau wilayah..." 
                            class="w-full pl-11 pr-10 py-3.5 bg-white border border-slate-200 rounded-2xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:border-[#89A8E0] transition-all duration-300 font-sans text-sm"
                        />
                        <!-- Reset Button -->
                        @if(request('search'))
                            <a 
                                href="{{ route('explore', ['category' => request('category')]) }}"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Category Tabs (Stacked & wrapped on mobile, centered) -->
            <div class="mb-5">
                <div class="flex flex-wrap gap-2.5 justify-center">
                    <!-- 'Semua' Tab -->
                    <a 
                        href="{{ route('explore', ['search' => request('search')]) }}"
                        class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide uppercase transition-all duration-300 border font-sans {{ !request('category') || request('category') === 'semua' 
                            ? 'bg-[#3F5C7D] text-white shadow-sm border-transparent' 
                            : 'bg-white text-slate-600 hover:bg-slate-100 hover:text-slate-800 border-slate-200/80' }}"
                    >
                        Semua
                    </a>

                    @foreach($categories as $cat)
                        <a 
                            href="{{ route('explore', ['category' => $cat->slug, 'search' => request('search')]) }}"
                            class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide uppercase transition-all duration-300 border font-sans {{ request('category') === $cat->slug 
                                ? 'bg-[#3F5C7D] text-white shadow-sm border-transparent' 
                                : 'bg-white text-slate-600 hover:bg-slate-100 hover:text-slate-800 border-slate-200/80' }}"
                        >
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Results Count Indicator (Below Categories) -->
            <div class="mb-6 text-center">
                <div class="text-xs text-slate-400 font-sans font-light">
                    Menampilkan <span class="font-semibold text-[#3F5C7D]">{{ $filteredCount }}</span> dari {{ $totalCount }} destinasi
                </div>
            </div>

            <!-- Pinned Featured Destinasi Sorotan Slider (Hanya muncul jika tidak sedang mencari/memfilter kategori) -->
            @if($featuredDestinations->isNotEmpty())
                <div 
                    x-data="{ 
                        activeSlide: 0, 
                        slidesCount: {{ $featuredDestinations->count() }},
                        autoplayInterval: null,
                        startAutoplay() {
                            this.stopAutoplay();
                            this.autoplayInterval = setInterval(() => {
                                this.activeSlide = (this.activeSlide + 1) % this.slidesCount;
                            }, 5000);
                        },
                        stopAutoplay() {
                            if (this.autoplayInterval) {
                                clearInterval(this.autoplayInterval);
                                this.autoplayInterval = null;
                            }
                        }
                    }"
                    x-init="startAutoplay()"
                    @mouseenter="stopAutoplay()"
                    @mouseleave="startAutoplay()"
                    class="mb-12 relative"
                >
                    <div class="relative w-full lg:h-[400px]">
                        @foreach($featuredDestinations as $index => $dest)
                            <div 
                                x-show="activeSlide === {{ $index }}"
                                x-transition
                                :class="activeSlide === {{ $index }} ? 'relative' : 'absolute inset-0'"
                                class="w-full lg:absolute lg:inset-0 lg:h-full"
                            >
                                <!-- Card Layout (Split 60/40) -->
                                <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-[0_12px_28px_rgba(0,0,0,0.03)] overflow-hidden hover:shadow-xl transition-[box-shadow] duration-500 ease-out isolate h-full">
                                    <div class="flex flex-col lg:grid lg:grid-cols-12 h-full">
                                        <!-- Image -->
                                        <div class="relative overflow-hidden aspect-[16/10] lg:aspect-auto lg:h-full lg:col-span-7 bg-slate-100 rounded-t-[2rem] lg:rounded-t-none lg:rounded-l-[2rem] transform-gpu">
                                            <img class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-700 ease-out transform-gpu will-change-transform" src="{{ $dest->image_url }}" alt="{{ $dest->name }}">
                                            <span class="absolute top-5 left-5 bg-white/20 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1.5 rounded-full border border-white/30 flex items-center gap-1 shadow-sm">
                                                <x-lucide-star class="w-3 h-3 fill-white text-white" />
                                                Terpopuler
                                            </span>
                                            <span class="absolute top-5 right-5 bg-[#E6F7FA]/95 backdrop-blur-sm text-[#3F5C7D] text-[10px] font-semibold px-3.5 py-1.5 rounded-full shadow-sm border border-[#CDEBF2]">{{ $dest->category->name }}</span>
                                        </div>
                                        
                                        <!-- Content -->
                                        <div class="p-6 lg:p-10 lg:col-span-5 flex flex-col items-start text-left justify-center h-full">
                                            <div class="flex flex-wrap items-center gap-y-1 gap-x-4 text-slate-400 text-xs font-medium mb-3">
                                                <div class="flex items-center gap-1.5">
                                                    <x-lucide-map-pin class="w-4 h-4 text-slate-400 shrink-0" />
                                                    <span class="text-slate-500 font-sans font-light text-xs">{{ $dest->district }}, Banyuwangi</span>
                                                </div>
                                                <div class="flex items-center gap-1.5">
                                                    <x-lucide-star class="w-4 h-4 text-amber-500 fill-amber-500 shrink-0" />
                                                    <span class="text-slate-500 font-sans font-light text-xs"><strong class="font-semibold text-slate-600">{{ $dest->rating }}</strong> / 5.0</span>
                                                </div>
                                            </div>
                                            
                                            <h2 class="text-xl lg:text-2xl font-bold text-[#3F5C7D] mb-3 font-sans leading-tight truncate w-full h-7 lg:h-8 hover:text-[#89A8E0] transition-colors" title="{{ $dest->name }}">
                                                <a href="{{ route('explore.show', $dest->slug) }}">{{ $dest->name }}</a>
                                            </h2>
                                            
                                            <p class="text-slate-500 text-xs sm:text-sm leading-relaxed mb-5 font-light font-sans line-clamp-4">
                                                {{ $dest->description }}
                                            </p>
                                            
                                            <a href="{{ route('explore.show', $dest->slug) }}" class="px-5 py-2.5 bg-[#3F5C7D] hover:bg-[#344d6b] text-white font-semibold text-xs uppercase tracking-wider rounded-full transition-all flex items-center gap-2 font-sans shadow-md shadow-[#3F5C7D]/10">
                                                Lihat Detail
                                                <x-lucide-arrow-right class="w-4 h-4" stroke-width="2.5" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Dots Indicator / Controls -->
                    <div class="absolute bottom-5 right-5 lg:right-10 z-20 flex gap-2">
                        @foreach($featuredDestinations as $index => $dest)
                            <button 
                                @click="activeSlide = {{ $index }}; startAutoplay()"
                                :class="activeSlide === {{ $index }} ? 'bg-[#3F5C7D] w-8' : 'bg-[#3F5C7D]/30 w-2.5'"
                                class="h-2.5 rounded-full transition-all duration-300 focus:outline-none"
                            ></button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Destination Grid -->
            @if($destinations->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($destinations as $dest)
                        <div class="destination-card-wrapper">
                            <x-destination-card 
                                :category="$dest->category->name" 
                                :location="$dest->district . ', Banyuwangi'" 
                                :title="$dest->name" 
                                :description="Str::limit($dest->description, 100)" 
                                :image="$dest->image_url" 
                                :link="route('explore.show', $dest->slug)" 
                            />
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($destinations->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $destinations->onEachSide(1)->links('components.admin-pagination') }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="bg-white border border-slate-100 p-12 rounded-[2rem] text-center shadow-sm max-w-md mx-auto mt-12">
                    <div class="w-16 h-16 rounded-2xl bg-[#E6F7FA] text-[#89A8E0] flex items-center justify-center mx-auto mb-5 border border-[#CDEBF2]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#3F5C7D] mb-2 font-sans">Destinasi Tidak Ditemukan</h3>
                    <p class="text-slate-400 font-sans font-light leading-relaxed mb-6 text-sm">
                        Kami tidak dapat menemukan destinasi yang cocok dengan pencarian atau filter Anda. Silakan ubah kata kunci atau kategori.
                    </p>
                    <a 
                        href="{{ route('explore') }}" 
                        class="px-5 py-2.5 bg-[#3F5C7D] hover:bg-[#344d6b] text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-md transition-all font-sans inline-block"
                    >
                        Reset Filter
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-guest-portal-layout>
