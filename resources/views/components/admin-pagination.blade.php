@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center gap-1.5">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-100 bg-slate-50 text-slate-400 cursor-not-allowed">
                <x-lucide-chevron-left class="w-4 h-4" stroke-width="2.5" />
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-100 bg-white text-[#2B3674] hover:bg-slate-50 transition-colors duration-200">
                <x-lucide-chevron-left class="w-4 h-4" stroke-width="2.5" />
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="inline-flex items-center justify-center w-9 h-9 text-slate-400">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-[#3F5C7D] text-white font-semibold text-xs shadow-md shadow-[#3F5C7D]/20">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-100 bg-white text-[#2B3674] hover:bg-slate-50 transition-colors duration-200 font-semibold text-xs">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-100 bg-white text-[#2B3674] hover:bg-slate-50 transition-colors duration-200">
                <x-lucide-chevron-right class="w-4 h-4" stroke-width="2.5" />
            </a>
        @else
            <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-100 bg-slate-50 text-slate-400 cursor-not-allowed">
                <x-lucide-chevron-right class="w-4 h-4" stroke-width="2.5" />
            </span>
        @endif
    </nav>
@endif
