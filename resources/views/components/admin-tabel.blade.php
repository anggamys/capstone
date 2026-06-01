@props([
    'headers' => [],
    'items' => null
])

<div class="bg-white rounded-[2rem] shadow-sm border border-indigo-50/25 overflow-hidden transition-all duration-200 hover:shadow-md">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="border-b border-slate-100/50 bg-[#F1F3FF]">
                    @foreach($headers as $header)
                        <th class="px-8 py-5 text-[11px] font-bold text-[#3F5C7D] uppercase tracking-wider">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100/70 text-sm text-[#2B3674]">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    <!-- Pagination Footer -->
    @if($items && method_exists($items, 'links'))
        <div class="px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-slate-100/80 bg-white">
            <!-- Showing Entries Info -->
            <div class="text-xs font-semibold text-slate-400">
                Menampilkan {{ $items->firstItem() ?? 0 }}-{{ $items->lastItem() ?? 0 }} dari {{ number_format($items->total()) }} entri
            </div>
            
            <!-- Pagination Controls -->
            <div>
                {{ $items->onEachSide(1)->links('components.admin-pagination') }}
            </div>
        </div>
    @elseif($items)
        <!-- Static/Total footer fallback if items is just an array/collection without pagination -->
        <div class="px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-slate-100 bg-white">
            <div class="text-xs font-semibold text-slate-400">
                Menampilkan {{ count($items) }} entri
            </div>
        </div>
    @endif
</div>
