@props(['category', 'location', 'title', 'description', 'image', 'link' => '/explore'])

<div class="group bg-white rounded-[2rem] border border-slate-100 shadow-[0_12px_28px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
    <div class="relative overflow-hidden aspect-[4/3] bg-slate-100">
        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $image }}" alt="{{ $title }}">
        <span class="absolute top-4 right-4 bg-[#E6F7FA]/95 backdrop-blur-sm text-[#7F9ED2] text-xs font-semibold px-3.5 py-1.5 rounded-full shadow-sm border border-[#CDEBF2]">{{ $category }}</span>
    </div>
    <div class="p-6 flex flex-col flex-grow items-start text-left">
        <!-- Location indicator -->
        <div class="flex items-center gap-1.5 text-slate-400 text-sm font-medium mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <span class="text-slate-500 font-sans font-light">{{ $location }}</span>
        </div>
        <h3 class="text-2xl font-bold text-[#3F5C7D] mb-3 font-sans leading-tight">{{ $title }}</h3>
        <p class="text-slate-500 text-sm leading-relaxed mb-6 font-light font-sans">{{ $description }}</p>
        <a href="{{ $link }}" class="text-[#89A8E0] hover:text-[#7F9ED2] font-semibold text-sm transition-colors mt-auto flex items-center gap-1.5 font-sans">
            Lihat Detail
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
        </a>
    </div>
</div>
