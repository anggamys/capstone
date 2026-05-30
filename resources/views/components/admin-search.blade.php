@props([
    'placeholder' => 'Cari...',
    'action' => null,
    'buttonText' => 'Tambah Data',
    'name' => 'search',
    'value' => request('search')
])

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <!-- Search Input Form -->
    <form action="" method="GET" class="relative flex-1 max-w-md w-full">
        <!-- Preserve other query parameters (e.g. filter, sort) -->
        @foreach(request()->except($name, 'page') as $key => $val)
            @if(is_array($val))
                @foreach($val as $v)
                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
            @endif
        @endforeach
        
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                <x-lucide-search class="w-5 h-5" stroke-width="2.5" />
            </span>
            <input type="text" 
                   name="{{ $name }}" 
                   value="{{ $value }}" 
                   placeholder="{{ $placeholder }}" 
                   class="w-full pl-11 pr-4 py-3 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-medium">
        </div>
    </form>

    <!-- Action Button (e.g. Tambah Data) -->
    @if($action)
        <a href="{{ $action }}" class="inline-flex items-center justify-center px-6 py-3 bg-[#3F5C7D] hover:bg-[#344d6b] text-white text-sm font-semibold rounded-2xl shadow-md hover:shadow-lg transition-all duration-200 shrink-0">
            <x-lucide-plus class="w-4 h-4 mr-2" stroke-width="2.5" />
            <span>{{ $buttonText }}</span>
        </a>
    @endif
</div>
