<x-guest-portal-layout>
    <x-slot name="title">Blog - Laras Banyuwangi</x-slot>

    <!-- Header Section -->
    <div class="relative bg-gradient-to-r from-[#7F9ED2] to-[#8ED3D8] py-14 text-center text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-sans tracking-tight">Blog</h1>
            <p class="text-white/95 max-w-3xl mx-auto text-base md:text-lg font-light leading-relaxed font-sans">
                Cerita budaya, petualangan wisata, dan tips berlibur seru di Banyuwangi.
            </p>
        </div>
        <!-- Wave SVG -->
        <div class="absolute -bottom-[1px] left-0 right-0 w-full overflow-hidden leading-none z-0">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-[50px] text-slate-50 fill-current">
                <path d="M0,60 C300,10 600,110 900,60 C1050,35 1150,45 1200,60 L1200,120 L0,120 Z"></path>
            </svg>
        </div>
    </div>

    <!-- Content Section -->
    <div class="pt-8 pb-16 bg-slate-50 min-h-[50vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Search Bar (Centered) -->
            <div class="mb-6 flex flex-col items-center justify-center text-center max-w-xl mx-auto">
                <form action="{{ route('blog') }}" method="GET" class="w-full">
                    <!-- Tetap simpan kategori yang dipilih -->
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    
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
                            placeholder="Cari blog..." 
                            class="w-full pl-11 pr-10 py-3.5 bg-white border border-slate-200 rounded-2xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:border-[#89A8E0] transition-all duration-300 font-sans text-sm"
                        />
                        
                        <!-- Reset Button -->
                        @if(request('search'))
                            <a 
                                href="{{ route('blog', ['category' => request('category')]) }}"
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

            <!-- Category Tabs (Centered) -->
            <div class="mb-5">
                <div class="flex flex-wrap gap-2.5 justify-center">
                    <!-- 'Semua' Tab -->
                    <a 
                        href="{{ route('blog', ['search' => request('search')]) }}"
                        class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide uppercase transition-all duration-300 border font-sans {{ !request('category') || request('category') === 'semua' 
                            ? 'bg-[#3F5C7D] text-white shadow-sm border-transparent' 
                            : 'bg-white text-slate-600 hover:bg-slate-100 hover:text-slate-800 border-slate-200/80' }}"
                    >
                        Semua
                    </a>

                    @foreach($categories as $cat)
                        <a 
                            href="{{ route('blog', ['category' => $cat->slug, 'search' => request('search')]) }}"
                            class="px-5 py-2.5 rounded-full text-xs font-semibold tracking-wide uppercase transition-all duration-300 border font-sans {{ request('category') === $cat->slug 
                                ? 'bg-[#3F5C7D] text-white shadow-sm border-transparent' 
                                : 'bg-white text-slate-600 hover:bg-slate-100 hover:text-slate-800 border-slate-200/80' }}"
                        >
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Results Count Indicator -->
            <div class="mb-6 text-center">
                <div class="text-xs text-slate-400 font-sans font-light">
                    Menampilkan <span class="font-semibold text-[#3F5C7D]">{{ $filteredCount }}</span> dari {{ $totalCount }} blog
                </div>
            </div>

            <!-- 1. Pinned Featured Blog Section (Only on page 1 and no search/category filter active) -->
            @if($featuredBlog)
                <div class="mb-12">
                    <x-blog-card 
                        :category="$featuredBlog->category?->name ?? 'Umum'" 
                        :date="$featuredBlog->published_at ? $featuredBlog->published_at->translatedFormat('d F Y') : $featuredBlog->created_at->translatedFormat('d F Y')" 
                        :title="$featuredBlog->title" 
                        :description="\Illuminate\Support\Str::limit(strip_tags($featuredBlog->content), 350)" 
                        :image="$featuredBlog->image_url" 
                        :link="route('blog.show', $featuredBlog->slug)"
                        :author="$featuredBlog->admin?->name ?? 'Admin Laras'"
                        featured
                    />
                </div>
            @endif

            <!-- 2. Grid Blog Section -->
            @if($blogs->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($blogs as $blog)
                        <x-blog-card 
                            :category="$blog->category?->name ?? 'Umum'" 
                            :date="$blog->published_at ? $blog->published_at->translatedFormat('d F Y') : $blog->created_at->translatedFormat('d F Y')" 
                            :title="$blog->title" 
                            :description="\Illuminate\Support\Str::limit(strip_tags($blog->content), 120)" 
                            :image="$blog->image_url" 
                            :link="route('blog.show', $blog->slug)"
                            :author="$blog->admin?->name ?? 'Admin Laras'" />
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($blogs->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $blogs->onEachSide(1)->links('components.admin-pagination') }}
                    </div>
                @endif
            @else
                <!-- Empty State (No Blogs Found) -->
                @if(request('search') || (request('category') && request('category') !== 'semua'))
                    <div class="bg-white border border-slate-100 p-12 rounded-[2rem] text-center shadow-sm max-w-md mx-auto mt-6">
                        <div class="w-16 h-16 rounded-2xl bg-[#E6F7FA] text-[#89A8E0] flex items-center justify-center mx-auto mb-5 border border-[#CDEBF2]">
                            <x-lucide-search class="w-8 h-8" stroke-width="2" />
                        </div>
                        <h3 class="text-xl font-bold text-[#3F5C7D] mb-2 font-sans">Blog Tidak Ditemukan</h3>
                        <p class="text-slate-400 font-sans font-light leading-relaxed mb-6 text-sm">
                            Kami tidak dapat menemukan blog yang cocok dengan pencarian atau filter Anda. Silakan ubah kata kunci atau kategori.
                        </p>
                        <a 
                            href="{{ route('blog') }}"
                            class="px-5 py-2.5 bg-[#3F5C7D] hover:bg-[#344d6b] text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-md transition-all font-sans inline-block"
                        >
                            Reset Filter
                        </a>
                    </div>
                @else
                    <div class="text-center py-16 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                        <x-lucide-newspaper class="w-16 h-16 text-slate-300 mx-auto mb-4" />
                        <h3 class="text-lg font-bold text-[#3F5C7D] mb-1 font-sans">Belum Ada Blog</h3>
                        <p class="text-slate-400 font-sans font-light text-sm">Kembali lagi nanti untuk membaca artikel menarik dari kami.</p>
                    </div>
                @endif
            @endif

        </div>
    </div>
</x-guest-portal-layout>
