@props(['tag', 'name', 'role', 'image', 'linkedin'])

<div class="w-[210px] bg-white rounded-[2rem] border border-slate-100 shadow-[0_12px_28px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col items-center pb-6 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-1.5 shrink-0">
    <!-- Top header box -->
    <div class="w-full bg-[#3F5C7D] text-white py-3 text-center font-bold text-xs tracking-wider uppercase">
        {{ $tag }}
    </div>
    <!-- Body Content -->
    <div class="pt-5 px-5 flex flex-col items-center w-full">
        <!-- Profile Image with vertical oval frame -->
        <div class="w-[80px] h-[110px] rounded-full p-1 bg-gradient-to-b from-[#CDEBF2] to-[#89A8E0] mb-4 shadow-md flex items-center justify-center overflow-hidden">
            <img class="w-full h-full rounded-full object-cover" src="{{ $image }}" alt="{{ $name }}">
        </div>
        <!-- Name & LinkedIn -->
        <div class="flex items-center justify-center gap-1.5 mb-1.5 w-full">
            <h4 class="font-bold text-slate-800 text-base md:text-lg font-sans tracking-wide">
                {{ $name }}
            </h4>
            @if($linkedin)
                <a href="https://{{ str_replace(['https://', 'http://'], '', $linkedin) }}" target="_blank" class="w-7 h-7 rounded-lg bg-sky-50 hover:bg-sky-100 flex items-center justify-center text-[#0a66c2] transition-colors shrink-0 shadow-sm border border-sky-100" title="LinkedIn {{ $name }}">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.8v8h2.8v-4.87c0-.26.05-.52.12-.7a.78.78 0 0 1 .72-.53c.47 0 .69.43.69 1v5.1h2.8M6.5 8.44a1.66 1.66 0 1 0 0-3.3 1.66 0 0 0 0 3.3M8 18.5v-8H5v8h3z"/>
                    </svg>
                </a>
            @endif
        </div>
        <!-- Role -->
        <p class="text-slate-500 text-xs md:text-sm font-medium font-sans">
            {{ $role }}
        </p>
    </div>
</div>
