@props(['category', 'date', 'title', 'description', 'image', 'link' => '/blog'])

<div class="group bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
    <div class="relative overflow-hidden aspect-[16/10] bg-slate-100">
        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $image }}" alt="{{ $title }}">
    </div>
    <div class="p-6 flex flex-col flex-grow items-start text-left">
        <span class="text-slate-400 text-xs font-medium mb-2 font-sans">{{ $category }} • {{ $date }}</span>
        <h3 class="text-lg font-bold text-[#3F5C7D] mb-3 group-hover:text-[#3F5C7D] transition-colors leading-snug font-sans">{{ $title }}</h3>
        <p class="text-slate-500 text-sm leading-relaxed mb-6 font-light font-sans">{{ $description }}</p>
        <a href="{{ $link }}" class="text-[#3F5C7D] font-semibold text-sm hover:underline mt-auto flex items-center gap-1 font-sans">
            Baca Selengkapnya
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
        </a>
    </div>
</div>
