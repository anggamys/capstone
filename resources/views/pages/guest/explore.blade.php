<x-guest-portal-layout>
    <x-slot name="title">Jelajah Wisata - Laras Banyuwangi</x-slot>

    <!-- Header Section -->
    <div class="relative bg-gradient-to-r from-[#7F9ED2] to-[#8ED3D8] py-20 text-center text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-sans tracking-tight">Jelajah Destinasi</h1>
            <p class="text-white/95 max-w-3xl mx-auto text-base md:text-lg font-light leading-relaxed font-sans">
                Temukan keindahan alam tersembunyi, seni budaya yang sakral, dan kuliner khas Banyuwangi yang menggugah selera.
            </p>
        </div>
        <!-- Wave SVG -->
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-0">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-[50px] text-slate-50 fill-current">
                <path d="M0,60 C300,10 600,110 900,60 C1050,35 1150,45 1200,60 L1200,120 L0,120 Z"></path>
            </svg>
        </div>
    </div>

    <!-- Content Section wrapper with Alpine.js -->
    <div 
        x-data="{ 
            selectedCategory: 'semua', 
            searchQuery: '',
            visibleCount: 0,
            matches(category, name, district, description) {
                const matchesCategory = this.selectedCategory === 'semua' || category.toLowerCase() === this.selectedCategory.toLowerCase();
                
                const q = this.searchQuery.toLowerCase().trim();
                if (!q) return matchesCategory;
                
                const matchesSearch = name.toLowerCase().includes(q) || 
                                      district.toLowerCase().includes(q) || 
                                      description.toLowerCase().includes(q);
                return matchesCategory && matchesSearch;
            },
            updateCount() {
                this.$nextTick(() => {
                    const visible = Array.from(this.$refs.grid.children).filter(el => el.style.display !== 'none').length;
                    this.visibleCount = visible;
                });
            }
        }" 
        x-init="updateCount(); $watch('selectedCategory', () => updateCount()); $watch('searchQuery', () => updateCount())"
        class="py-16 bg-slate-50 min-h-screen"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Search Bar (Centered) -->
            <div class="mb-10 flex flex-col items-center justify-center text-center max-w-xl mx-auto">
                <!-- Search Input -->
                <div class="relative w-full shadow-sm rounded-2xl">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                        </svg>
                    </span>
                    <input 
                        type="text" 
                        x-model="searchQuery" 
                        placeholder="Cari destinasi atau wilayah..." 
                        class="w-full pl-11 pr-10 py-3.5 bg-white border border-slate-200 rounded-2xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:border-[#89A8E0] transition-all duration-300 font-sans text-sm"
                    />
                    <!-- Reset Button -->
                    <button 
                        x-show="searchQuery !== ''" 
                        @click="searchQuery = ''" 
                        x-cloak
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Category Tabs (Stacked & wrapped on mobile, centered) -->
            <div class="mb-6">
                <div class="flex flex-wrap gap-2.5 justify-center">
                    <!-- 'Semua' Tab -->
                    <button 
                        @click="selectedCategory = 'semua'"
                        :class="selectedCategory === 'semua' 
                            ? 'bg-[#3F5C7D] text-white shadow-sm border-transparent' 
                            : 'bg-white text-slate-600 hover:bg-slate-100 hover:text-slate-800 border-slate-200/80'"
                        class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide uppercase transition-all duration-300 border font-sans"
                    >
                        Semua
                    </button>

                    @foreach($categories as $cat)
                        <button 
                            @click="selectedCategory = '{{ strtolower($cat->name) }}'"
                            :class="selectedCategory === '{{ strtolower($cat->name) }}' 
                                ? 'bg-[#3F5C7D] text-white shadow-sm border-transparent' 
                                : 'bg-white text-slate-600 hover:bg-slate-100 hover:text-slate-800 border-slate-200/80'"
                            class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide uppercase transition-all duration-300 border font-sans"
                        >
                            {{ $cat->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Results Count Indicator (Below Categories) -->
            <div class="mb-10 text-center">
                <div class="text-xs text-slate-400 font-sans font-light">
                    Menampilkan <span class="font-semibold text-[#3F5C7D]" x-text="visibleCount"></span> dari {{ $destinations->count() }} destinasi
                </div>
            </div>

            <!-- Destination Grid -->
            <div 
                x-ref="grid" 
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
            >
                @foreach($destinations as $dest)
                    <div 
                        x-show="matches('{{ $dest->category->name }}', '{{ $dest->name }}', '{{ $dest->district }}', '{{ $dest->description }}')" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="destination-card-wrapper"
                    >
                        <x-destination-card 
                            :category="$dest->category->name" 
                            :location="$dest->district . ', Banyuwangi'" 
                            :title="$dest->name" 
                            :description="Str::limit($dest->description, 100)" 
                            :image="$dest->image_url" 
                            link="#" 
                        />
                    </div>
                @endforeach
            </div>

            <!-- Empty State -->
            <div 
                x-show="visibleCount === 0" 
                x-cloak
                x-transition
                class="bg-white border border-slate-100 p-12 rounded-[2rem] text-center shadow-sm max-w-md mx-auto mt-12"
            >
                <div class="w-16 h-16 rounded-2xl bg-[#E6F7FA] text-[#89A8E0] flex items-center justify-center mx-auto mb-5 border border-[#CDEBF2]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-[#3F5C7D] mb-2 font-sans">Destinasi Tidak Ditemukan</h3>
                <p class="text-slate-400 font-sans font-light leading-relaxed mb-6 text-sm">
                    Kami tidak dapat menemukan destinasi yang cocok dengan pencarian atau filter Anda. Silakan ubah kata kunci atau kategori.
                </p>
                <button 
                    @click="searchQuery = ''; selectedCategory = 'semua'" 
                    class="px-5 py-2.5 bg-[#3F5C7D] hover:bg-[#344d6b] text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-md transition-all font-sans"
                >
                    Reset Filter
                </button>
            </div>

        </div>
    </div>
</x-guest-portal-layout>
