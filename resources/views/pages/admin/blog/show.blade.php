<x-app-layout>
    <x-slot name="header">
        {{ __('Blog | Detail') }}
    </x-slot>

    <!-- Custom Style for Rich Text Rendering -->
    <style>
        .blog-content h1 { font-size: 2.25rem; font-weight: 800; margin-top: 1.5rem; margin-bottom: 1rem; color: #2B3674; }
        .blog-content h2 { font-size: 1.875rem; font-weight: 700; margin-top: 1.5rem; margin-bottom: 1rem; color: #2B3674; }
        .blog-content h3 { font-size: 1.5rem; font-weight: 700; margin-top: 1.5rem; margin-bottom: 1rem; color: #2B3674; }
        .blog-content p { font-size: 0.95rem; line-height: 1.75; margin-bottom: 1.25rem; color: #4B5563; }
        .blog-content ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.25rem; color: #4B5563; }
        .blog-content ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.25rem; color: #4B5563; }
        .blog-content li { margin-bottom: 0.5rem; }
        .blog-content blockquote { border-left: 4px solid #3F5C7D; padding-left: 1rem; font-style: italic; color: #6B7280; margin-bottom: 1.25rem; }
    </style>

    <div class="py-2">
        <!-- Header Title & Action Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-[#2B3674]">Detail Blog</h1>
                <p class="text-sm text-slate-400 mt-1 font-medium">Lihat rincian informasi blog tersebut</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.blog.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#3F5C7D]/30 text-[#3F5C7D] hover:bg-[#3F5C7D]/5 text-sm font-bold rounded-2xl transition-all duration-200 shadow-sm">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Main Detail Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            
            <!-- Left Side: Content Preview -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10">
                <!-- Cover Image -->
                <div class="relative w-full max-h-[380px] rounded-2xl overflow-hidden mb-6 shadow-sm border border-slate-100">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-full h-full object-cover max-h-[380px]">
                </div>

                <!-- Blog Title -->
                <h1 class="text-3xl font-extrabold text-[#2B3674] mb-4 leading-tight">
                    {{ $blog->title }}
                </h1>

                <!-- Divider -->
                <hr class="border-slate-100 my-6">

                <!-- Rich Text Content Body -->
                <div class="blog-content">
                    {!! $blog->content !!}
                </div>
            </div>

            <!-- Right Side: Metadata / Details Card -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10 h-fit">
                <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-4">
                    <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                        <x-lucide-info class="w-5 h-5" stroke-width="2.5" />
                    </span>
                    <h2 class="text-base font-bold text-[#2B3674]">Detail Informasi</h2>
                </div>

                <div class="space-y-5">
                    <!-- Kategori -->
                    <div>
                        <span class="text-xs font-bold text-slate-400 block mb-1">Kategori</span>
                        <span class="inline-flex px-3 py-1 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl text-sm font-bold">
                            {{ $blog->category->name }}
                        </span>
                    </div>

                    <!-- URL Slug -->
                    <div>
                        <span class="text-xs font-bold text-slate-400 block mb-1">URL Slug</span>
                        <span class="text-sm font-medium font-mono text-[#2B3674] break-all bg-slate-50 p-2.5 rounded-xl block border border-slate-100">
                            {{ $blog->slug }}
                        </span>
                    </div>

                    <!-- Penulis -->
                    <div>
                        <span class="text-xs font-bold text-slate-400 block mb-1">Penulis (Admin)</span>
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-full bg-[#E0E7FF] text-[#3F5C7D] flex items-center justify-center font-bold text-sm shadow-sm">
                                {{ strtoupper(substr($blog->admin->name ?? 'A', 0, 1)) }}
                            </div>
                            <span class="text-sm font-bold text-[#2B3674]">{{ $blog->admin->name ?? 'Admin' }}</span>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <span class="text-xs font-bold text-slate-400 block mb-1">Status Publikasi</span>
                        @if($blog->status === 'published')
                            <span class="inline-flex items-center gap-1.5 text-emerald-600 font-bold text-sm">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 border border-emerald-100 shadow-sm shadow-emerald-500/20"></span>
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-amber-600 font-bold text-sm">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500 border border-amber-100 shadow-sm shadow-amber-500/20"></span>
                                Draft
                            </span>
                        @endif
                    </div>

                    <!-- Tanggal Publikasi -->
                    <div>
                        <span class="text-xs font-bold text-slate-400 block mb-1">Waktu Publikasi</span>
                        <span class="text-sm font-semibold text-[#2B3674]">
                            {{ $blog->published_at ? $blog->published_at->translatedFormat('d F Y, H:i') . ' WIB' : '-' }}
                        </span>
                    </div>

                    <!-- Tanggal Dibuat / Diupdate -->
                    <div class="border-t border-slate-100 pt-4 mt-2 space-y-2.5">
                        <div class="flex justify-between text-xs font-medium text-slate-400">
                            <span>Dibuat pada:</span>
                            <span>{{ $blog->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between text-xs font-medium text-slate-400">
                            <span>Terakhir diupdate:</span>
                            <span>{{ $blog->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
