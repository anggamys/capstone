@props(['category', 'location', 'title', 'description', 'image', 'link' => '/explore'])

<div class="group bg-white rounded-[2rem] border border-slate-100 shadow-[0_12px_28px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 hover:-translate-y-2 isolate">
    <div class="relative overflow-hidden aspect-[4/3] bg-slate-100 rounded-t-[2rem]">
        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $image }}" alt="{{ $title }}">
        <span class="absolute top-4 right-4 bg-[#E6F7FA]/95 backdrop-blur-sm text-[#3F5C7D] text-xs font-semibold px-3.5 py-1.5 rounded-full shadow-sm border border-[#CDEBF2]">{{ $category }}</span>
    </div>
    <div class="p-5 flex flex-col flex-grow items-start text-left">
        <!-- Location indicator -->
        <div class="flex items-center gap-1.5 text-slate-400 text-sm font-medium mb-2">
            <x-lucide-map-pin class="w-4 h-4 text-slate-400 shrink-0" />
            <span class="text-slate-500 font-sans font-light">{{ $location }}</span>
        </div>
        <h3 class="text-xl font-bold text-[#3F5C7D] mb-2 font-sans leading-tight line-clamp-1">{{ $title }}</h3>
        <p class="text-slate-500 text-xs sm:text-sm leading-relaxed mb-4 font-light font-sans line-clamp-2">{{ $description }}</p>
        <a href="{{ $link }}" class="text-[#89A8E0] hover:text-[#7F9ED2] font-semibold text-sm transition-colors mt-auto flex items-center gap-1.5 font-sans">
            Lihat Detail
            <x-lucide-arrow-right class="w-4 h-4" stroke-width="2.5" />
        </a>
    </div>
</div>
