@props([
    'name',
    'value',
    'checked' => false,
    'label'
])

<label class="relative flex items-center cursor-pointer select-none">
    <input type="checkbox" 
           name="{{ $name }}" 
           value="{{ $value }}" 
           class="sr-only peer" 
           {{ $checked ? 'checked' : '' }}
           {{ $attributes }}>
    <div class="px-4 py-2 bg-[#F4F7FE] hover:bg-[#89A8E0]/10 text-[#3F5C7D] peer-checked:bg-[#3F5C7D] peer-checked:text-white rounded-xl text-xs font-semibold transition-all duration-150 flex items-center gap-1.5 shadow-sm">
        <span>{{ $label }}</span>
        <span class="text-[10px] opacity-75 peer-checked:hidden">+</span>
        <span class="text-[10px] hidden peer-checked:inline">✓</span>
    </div>
</label>
