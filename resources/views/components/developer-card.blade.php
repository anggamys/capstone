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
                <a href="https://{{ str_replace(['https://', 'http://'], '', $linkedin) }}" target="_blank" class="transition-transform hover:scale-110 shrink-0 inline-block" title="LinkedIn {{ $name }}">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect width="24" height="24" rx="4" fill="#0a66c2" />
                        <path d="M8 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" fill="white" />
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
