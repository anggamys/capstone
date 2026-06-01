<x-guest-portal-layout>
    <x-slot name="title">{{ $blog->title }} - Laras Banyuwangi</x-slot>

    <div x-data="{ imageModalOpen: false }">

        <!-- Breadcrumbs Section -->
        <div class="bg-white border-b border-slate-100 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center gap-2.5 text-xs text-slate-500 font-sans">
                    <a href="/" class="hover:text-[#3F5C7D] transition-colors flex items-center gap-1 font-medium">
                        <x-lucide-home class="w-3.5 h-3.5 text-slate-400" />
                        Home
                    </a>
                    <x-lucide-chevron-right class="w-2.5 h-2.5 text-slate-300" stroke-width="3" />
                    <a href="{{ route('blog') }}" class="hover:text-[#3F5C7D] transition-colors font-medium">Blog</a>
                    <x-lucide-chevron-right class="w-2.5 h-2.5 text-slate-300" stroke-width="3" />
                    <span class="text-[#3F5C7D] font-semibold truncate max-w-[150px] sm:max-w-none">{{ $blog->title }}</span>
                </nav>
            </div>
        </div>

        <!-- Header Banner Section with Dynamic CSS background -->
        {!! '<' . 'style>.blog-banner-bg { background-image: url(' . $blog->image_url . '); }</' . 'style>' !!}
        <div class="relative bg-slate-900 bg-cover bg-center overflow-hidden py-24 md:py-32 flex items-center blog-banner-bg">
            <!-- Dark blue gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#12263f]/90 via-[#12263f]/60 to-[#12263f]/30 z-10"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 text-white w-full text-left">
                <div class="max-w-4xl">
                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($blog->status === 'published')
                            <span class="inline-flex items-center gap-1.5 bg-emerald-500/10 backdrop-blur-sm text-emerald-400 text-xs font-semibold px-3.5 py-1.5 rounded-full border border-emerald-500/25">
                                <x-lucide-check-circle class="w-4 h-4 text-emerald-400 shrink-0" />
                                Published
                            </span>
                        @endif
                        <span class="bg-[#E6F7FA]/20 backdrop-blur-sm text-[#E6F7FA] text-xs font-semibold px-3.5 py-1.5 rounded-full border border-[#E6F7FA]/30">
                            {{ $blog->category?->name ?? 'Umum' }}
                        </span>
                    </div>

                    <!-- Blog Title -->
                    <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-6 leading-tight font-sans">
                        {{ $blog->title }}
                    </h1>

                    <!-- Author & Date Details -->
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-slate-200 text-xs md:text-sm">
                        <div class="flex items-center gap-2">
                            <x-lucide-user class="w-4 h-4 text-[#8ED3D8]" stroke-width="2" />
                            <span class="font-sans font-light">Ditulis oleh <strong class="font-semibold text-white">{{ $blog->admin?->name ?? 'Admin Laras' }}</strong></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <x-lucide-calendar class="w-4 h-4 text-[#8ED3D8]" stroke-width="2" />
                            <span class="font-sans font-light">{{ $blog->published_at ? $blog->published_at->translatedFormat('d F Y') : $blog->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <x-lucide-eye class="w-4 h-4 text-[#8ED3D8]" stroke-width="2" />
                            <span class="font-sans font-light">Dilihat <strong class="font-semibold text-white">{{ number_format($blog->views, 0, ',', '.') }}</strong> kali</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left Column: Blog Content (2/3 width) -->
                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white rounded-[2rem] p-8 shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-slate-100">
                            
                            <!-- Cover Image Preview inside card -->
                            <div class="mb-8">
                                <button @click="imageModalOpen = true" type="button" class="group block w-full overflow-hidden rounded-2xl md:rounded-3xl border border-slate-100 shadow-sm relative text-left focus:outline-none">
                                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-full max-h-[350px] md:max-h-[450px] object-cover transition-transform duration-500 group-hover:scale-102">
                                    <!-- Hover overlay -->
                                    <div class="absolute inset-0 bg-[#12263f]/25 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                                        <span class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-xs font-semibold border border-white/30 flex items-center gap-1.5 shadow-sm">
                                            <x-lucide-zoom-in class="w-4 h-4" stroke-width="2.5" />
                                            Lihat Gambar Penuh
                                        </span>
                                    </div>
                                </button>
                            </div>

                            <!-- Styled content container to render HTML dynamically -->
                            <div class="text-slate-600 text-sm md:text-base leading-relaxed font-sans font-light
                                [&_p]:mb-5 [&_p]:leading-relaxed
                                [&_h1]:text-2xl [&_h1]:font-bold [&_h1]:text-[#3F5C7D] [&_h1]:mt-8 [&_h1]:mb-4 [&_h1]:font-sans
                                [&_h2]:text-xl [&_h2]:font-bold [&_h2]:text-[#3F5C7D] [&_h2]:mt-7 [&_h2]:mb-3 [&_h2]:font-sans
                                [&_h3]:text-lg [&_h3]:font-bold [&_h3]:text-[#3F5C7D] [&_h3]:mt-6 [&_h3]:mb-2 [&_h3]:font-sans
                                [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:mb-5 [&_ul]:space-y-1.5
                                [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:mb-5 [&_ol]:space-y-1.5
                                [&_li]:leading-relaxed
                                [&_strong]:font-semibold [&_strong]:text-slate-800
                                [&_a]:text-[#89A8E0] [&_a]:underline hover:[&_a]:text-[#3F5C7D]
                                [&_blockquote]:border-l-4 [&_blockquote]:border-[#CDEBF2] [&_blockquote]:pl-4 [&_blockquote]:italic [&_blockquote]:my-6 [&_blockquote]:text-slate-500">
                                {!! $blog->content !!}
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Sidebar (1/3 width) -->
                    <div class="space-y-8">
                        <!-- "Blog Terbaru" Card -->
                        <div class="bg-white rounded-[2rem] p-8 shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-slate-100">
                            <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
                                <span class="p-2 bg-[#E6F7FA] text-[#3F5C7D] rounded-xl border border-[#CDEBF2]">
                                    <x-lucide-newspaper class="w-5 h-5" stroke-width="2.5" />
                                </span>
                                <h2 class="text-lg font-bold text-[#3F5C7D] font-sans">Blog Terbaru</h2>
                            </div>

                            <div class="space-y-6">
                                @forelse($recentBlogs as $recent)
                                    <a href="{{ route('blog.show', $recent->slug) }}" class="group flex gap-4 items-start pb-5 border-b border-slate-100 last:border-0 last:pb-0">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                                            <img src="{{ $recent->image_url }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                        <div class="flex-grow min-w-0">
                                            <span class="text-[10px] font-semibold text-[#89A8E0] uppercase tracking-wider block mb-1">
                                                {{ $recent->category?->name ?? 'Umum' }}
                                            </span>
                                            <h4 class="text-xs sm:text-sm font-bold text-slate-800 line-clamp-2 leading-tight group-hover:text-[#3F5C7D] transition-colors" title="{{ $recent->title }}">
                                                {{ $recent->title }}
                                            </h4>
                                            <span class="text-[10px] text-slate-400 font-light block mt-1.5">
                                                {{ $recent->published_at ? $recent->published_at->translatedFormat('d M Y') : $recent->created_at->translatedFormat('d M Y') }}
                                            </span>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-xs text-slate-400 italic font-light font-sans">Belum ada blog terbaru lainnya.</p>
                                @Endforelse
                            </div>
                        </div>

                        <!-- Back to List Button Card -->
                        <div class="bg-white rounded-[2rem] p-6 shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-slate-100 flex flex-col items-center">
                            <a href="{{ route('blog') }}" class="w-full text-center px-6 py-3.5 bg-slate-50 hover:bg-[#3F5C7D] hover:text-white text-[#3F5C7D] font-bold text-xs uppercase tracking-wider rounded-xl transition-all duration-300 border border-slate-100 hover:border-transparent flex items-center justify-center gap-2 font-sans shadow-sm">
                                <x-lucide-arrow-left class="w-4 h-4" stroke-width="2.5" />
                                Kembali Ke Semua Blog
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Lightbox Modal -->
        <div 
            x-show="imageModalOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @keydown.escape.window="imageModalOpen = false"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 md:p-10 bg-slate-950/80 backdrop-blur-sm"
            x-cloak
        >
            <!-- Modal Content Wrapper -->
            <div 
                @click.away="imageModalOpen = false" 
                class="relative bg-white rounded-[2rem] p-3 sm:p-4 shadow-2xl max-w-5xl w-full max-h-[90vh] flex flex-col items-center justify-center overflow-hidden border border-slate-100"
                x-show="imageModalOpen"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
            >
                <!-- Close Button -->
                <button 
                    @click="imageModalOpen = false" 
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2 bg-slate-50 hover:bg-slate-100 rounded-full transition-colors z-20"
                    aria-label="Close modal"
                >
                    <x-lucide-x class="w-5 h-5" stroke-width="2.5" />
                </button>

                <!-- Image container -->
                <div class="w-full h-full flex items-center justify-center p-2">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="max-w-full max-h-[80vh] object-contain rounded-2xl">
                </div>
            </div>
        </div>
    </div>
</x-guest-portal-layout>
