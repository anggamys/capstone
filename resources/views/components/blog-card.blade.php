@props(['category', 'date', 'title', 'description', 'image', 'link' => '/blog', 'featured' => false, 'author' => 'Admin Laras'])

@if($featured)
    <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-[0_12px_28px_rgba(0,0,0,0.03)] overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 isolate lg:h-[400px]">
        <div class="grid grid-cols-1 lg:grid-cols-12 h-full">
            <!-- Image -->
            <div class="relative overflow-hidden aspect-[16/10] lg:aspect-auto lg:h-full lg:col-span-7 bg-slate-100 rounded-t-[2.5rem] lg:rounded-t-none lg:rounded-l-[2.5rem]">
                <img class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-500" src="{{ $image }}" alt="{{ $title }}">
                <span class="absolute top-5 left-5 bg-white/20 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1 rounded-full border border-white/30 flex items-center gap-1 shadow-sm">
                    <x-lucide-star class="w-3 h-3 fill-white text-white" />
                    Terbaru
                </span>
                <span class="absolute top-5 right-5 bg-[#E6F7FA]/95 backdrop-blur-sm text-[#3F5C7D] text-[10px] font-semibold px-3 py-1 rounded-full shadow-sm border border-[#CDEBF2]">{{ $category }}</span>
            </div>
            
            <!-- Content -->
            <div class="p-6 lg:p-10 lg:col-span-5 flex flex-col items-start text-left justify-center h-full">
                <div class="flex flex-wrap items-center gap-y-1 gap-x-4 text-slate-400 text-xs font-medium mb-3">
                    <div class="flex items-center gap-1.5">
                        <x-lucide-user class="w-4 h-4 text-slate-400 shrink-0" />
                        <span class="text-slate-500 font-sans font-light">Oleh <strong class="font-semibold text-slate-600">{{ $author }}</strong></span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <x-lucide-calendar class="w-4 h-4 text-slate-400 shrink-0" />
                        <span class="text-slate-500 font-sans font-light">{{ $date }}</span>
                    </div>
                </div>
                
                <h2 class="text-xl lg:text-2xl font-bold text-[#3F5C7D] mb-3 font-sans leading-tight group-hover:text-[#89A8E0] transition-colors" title="{{ $title }}">
                    <a href="{{ $link }}">{{ $title }}</a>
                </h2>
                
                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed mb-5 font-light font-sans line-clamp-4">
                    {{ $description }}
                </p>
                
                <a href="{{ $link }}" class="px-5 py-2.5 bg-[#3F5C7D] hover:bg-[#344d6b] text-white font-semibold text-xs uppercase tracking-wider rounded-full transition-all flex items-center gap-2 font-sans shadow-md shadow-[#3F5C7D]/10">
                    Baca Selengkapnya
                    <x-lucide-arrow-right class="w-4 h-4" stroke-width="2.5" />
                </a>
            </div>
        </div>
    </div>
@else
    <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-[0_12px_28px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 hover:-translate-y-2 isolate">
        <div class="relative overflow-hidden aspect-[4/3] bg-slate-100 rounded-t-[2rem]">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $image }}" alt="{{ $title }}">
            <span class="absolute top-4 right-4 bg-[#E6F7FA]/95 backdrop-blur-sm text-[#3F5C7D] text-xs font-semibold px-3.5 py-1.5 rounded-full shadow-sm border border-[#CDEBF2]">{{ $category }}</span>
        </div>
        <div class="p-6 flex flex-col flex-grow items-start text-left">
            <!-- Author & Date indicator -->
            <div class="flex flex-wrap items-center gap-y-1 gap-x-3.5 text-slate-400 text-xs font-medium mb-2.5">
                <div class="flex items-center gap-1">
                    <x-lucide-user class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                    <span class="text-slate-500 font-sans font-light">Oleh <strong class="font-semibold text-slate-600">{{ $author }}</strong></span>
                </div>
                <div class="flex items-center gap-1">
                    <x-lucide-calendar class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                    <span class="text-slate-500 font-sans font-light">{{ $date }}</span>
                </div>
            </div>
            <h3 class="text-xl font-bold text-[#3F5C7D] mb-2 font-sans leading-tight line-clamp-2 hover:text-[#89A8E0] transition-colors" title="{{ $title }}">
                <a href="{{ $link }}">{{ $title }}</a>
            </h3>
            <p class="text-slate-500 text-xs sm:text-sm leading-relaxed mb-5 font-light font-sans line-clamp-2">{{ $description }}</p>
            <a href="{{ $link }}" class="text-[#89A8E0] hover:text-[#7F9ED2] font-semibold text-sm transition-colors mt-auto flex items-center gap-1.5 font-sans">
                Baca Selengkapnya
                <x-lucide-arrow-right class="w-4 h-4" stroke-width="2.5" />
            </a>
        </div>
    </div>
@endif
