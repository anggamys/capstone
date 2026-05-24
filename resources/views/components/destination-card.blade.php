@props(['category', 'location', 'title', 'description', 'image', 'link' => '/explore'])

<div class="group bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
    <div class="relative overflow-hidden aspect-[4/3] bg-slate-100">
        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $image }}" alt="{{ $title }}">
        <span class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-slate-800 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">{{ $category }}</span>
    </div>
    <div class="p-6 flex flex-col flex-grow items-start text-left">
        <!-- Location indicator -->
        <div class="flex items-center gap-1 text-slate-400 text-xs font-medium mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <span>{{ $location }}</span>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-2 font-sans">{{ $title }}</h3>
        <p class="text-slate-500 text-sm leading-relaxed mb-6 font-light font-sans">{{ $description }}</p>
        <a href="{{ $link }}" class="text-[#3F5C7D] font-semibold text-sm hover:underline mt-auto flex items-center gap-1 font-sans">
            Detail Wisata
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
        </a>
    </div>
</div>
