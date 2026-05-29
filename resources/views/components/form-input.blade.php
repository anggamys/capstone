@props([
    'disabled' => false,
    'type' => 'text',
    'prefix' => null,
    'prefixClass' => 'text-[#3F5C7D]'
])

@if($prefix)
    <div class="relative w-full">
        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-sm font-bold {{ $prefixClass }}">{{ $prefix }}</span>
        <input type="{{ $type }}" @disabled($disabled) {{ $attributes->merge(['class' => 'w-full pl-12 pr-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold']) }}>
    </div>
@else
    <input type="{{ $type }}" @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold']) }}>
@endif
