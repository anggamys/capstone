@props([
    'name',
    'value' => null,
    'options' => [],
    'placeholder' => 'Pilih opsi...'
])

@php
    $selectedLabel = $options[$value] ?? $placeholder;
@endphp

<div x-data="{ 
        open: false, 
        selected: '{{ $value ?? '' }}',
        selectedLabel: '{{ $selectedLabel }}',
        options: @js($options),
        select(val, label) {
            this.selected = val;
            this.selectedLabel = label;
            this.open = false;
        }
     }" 
     class="relative w-full"
     @click.outside="open = false">
     
    <!-- Hidden Input for Form Submission -->
    <input type="hidden" name="{{ $name }}" :value="selected">

    <!-- Trigger Button -->
    <button type="button" 
            @click="open = !open"
            class="w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold flex items-center justify-between cursor-pointer text-left">
        <span x-text="selectedLabel"></span>
        <span class="text-[#3F5C7D] transition-transform duration-200" :class="open ? 'rotate-180' : ''">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        </span>
    </button>

    <!-- Dropdown List -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
         class="absolute z-50 mt-2 w-full bg-white rounded-2xl border border-indigo-100/30 shadow-xl shadow-indigo-100/10 overflow-hidden py-1.5"
         style="display: none;">
        
        <template x-for="(label, key) in options" :key="key">
            <button type="button"
                    @click="select(key, label)"
                    class="w-full px-5 py-3 text-left text-sm font-semibold transition-colors duration-150 flex items-center justify-between"
                    :class="selected == key ? 'text-[#3F5C7D] bg-[#3F5C7D]/10' : 'text-slate-600 hover:bg-[#F4F7FE] hover:text-[#2B3674]'">
                <span x-text="label"></span>
                <template x-if="selected == key">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4 text-[#3F5C7D]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </template>
            </button>
        </template>
    </div>
</div>
