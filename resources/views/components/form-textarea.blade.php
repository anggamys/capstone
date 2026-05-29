@props([
    'disabled' => false
])

<textarea @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold leading-relaxed']) }}></textarea>
