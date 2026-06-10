@props([
    'type' => 'checkbox',
    'name',
    'value',
    'checked' => false,
    'title',
    'description' => ''
])

<label class="relative cursor-pointer block select-none h-full">
    <input type="{{ $type }}" 
           name="{{ $name }}" 
           value="{{ $value }}" 
           class="sr-only peer" 
           {{ $checked ? 'checked' : '' }}
           {{ $attributes }}>
    
    <!-- Sibling 2: The Main Card Wrapper -->
    <div class="option-card border border-slate-200/80 bg-white rounded-2xl p-5 pr-12 flex transition-all duration-300 peer-checked:border-[#3F5C7D] peer-checked:bg-[#E6F7FA]/10 h-full shadow-sm relative {{ $description ? 'flex-col justify-between min-h-[105px]' : 'items-center min-h-[64px]' }}">
        <div>
            <h4 class="text-xs md:text-sm font-bold text-slate-800 font-sans transition-colors">{{ $title }}</h4>
            @if($description)
                <p class="text-[10px] md:text-[11px] text-slate-400 font-sans font-light mt-1.5 leading-relaxed">{{ $description }}</p>
            @endif
        </div>
    </div>

    <!-- Sibling 3: The Custom Selection Indicator placed outside wrapper but positioned absolute -->
    @if($type === 'checkbox')
        <div class="absolute {{ $description ? 'top-5' : 'top-1/2 -translate-y-1/2' }} right-5 w-5 h-5 rounded-md border border-slate-300 flex items-center justify-center transition-all bg-white peer-checked:bg-[#3F5C7D] peer-checked:border-transparent text-transparent peer-checked:text-white pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
    @else
        <div class="absolute {{ $description ? 'top-5' : 'top-1/2 -translate-y-1/2' }} right-5 w-5 h-5 rounded-full border border-slate-300 flex items-center justify-center transition-all bg-white peer-checked:border-[#3F5C7D] text-transparent peer-checked:text-[#3F5C7D] pointer-events-none">
            <div class="w-2.5 h-2.5 rounded-full bg-current"></div>
        </div>
    @endif
</label>

@once
<style>
    .peer:checked ~ .option-card h4 {
        color: #3F5C7D !important;
    }
</style>
@endonce
