<x-app-layout>
    <x-slot name="header">
        {{ __('Riwayat Preferensi User') }}
    </x-slot>

    <div class="py-2" x-data="{ 
        deleteModalOpen: false, 
        deleteActionUrl: ''
    }">
        <!-- Title & Subtitle Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#2B3674]">Riwayat Preferensi User</h1>
            <p class="text-sm text-slate-400 mt-1 font-medium">Pantau data preferensi pencarian dan hasil rekomendasi AI Planner dari pengunjung website.</p>
        </div>

        <!-- Reusable Search Component -->
        <x-admin-search 
            placeholder="Cari riwayat (nama user, budget, tipe perjalanan...)" 
        />

        <!-- Reusable Table Component -->
        <x-admin-tabel :headers="['No', 'Tanggal', 'User', 'Gaya Perjalanan', 'Budget', 'Kategori Wisata', 'Hasil Rekomendasi', 'Aksi']" :items="$histories">
            @forelse($histories as $index => $history)
                @php
                    $mappedCategories = collect($history->categories)->map(fn($id) => $categoryMap[$id] ?? $id)->join(', ');
                    $mappedActivities = collect($history->activities)->map(fn($id) => $activityMap[$id] ?? $id)->join(', ');
                    $mappedVisitTimes = collect($history->visit_times)->map(fn($id) => $visitTimeMap[$id] ?? $id)->join(', ');
                    $mappedRecommendations = is_array($history->recommendations) ? implode(', ', $history->recommendations) : '-';
                @endphp
                <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                    <!-- Column 1: No -->
                    <td class="px-8 py-5 text-sm font-semibold text-[#2B3674] w-20">
                        {{ $histories->firstItem() + $index }}
                    </td>
                    <!-- Column 2: Tanggal -->
                    <td class="px-8 py-5 text-sm font-medium text-slate-600">
                        {{ $history->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                    </td>
                    <!-- Column 3: User -->
                    <td class="px-8 py-5 text-sm font-bold text-[#2B3674]">
                        @if($history->user)
                            <div class="flex flex-col">
                                <span>{{ $history->user->name }}</span>
                                <span class="text-xs text-slate-400 font-normal font-sans">{{ $history->user->email }}</span>
                            </div>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-slate-500 font-semibold bg-slate-100/80 px-2.5 py-1 rounded-full text-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                Guest #{{ substr($history->guest_token ?? 'Anonim', 0, 6) }}
                            </span>
                        @endif
                    </td>
                    <!-- Column 4: Gaya Perjalanan -->
                    <td class="px-8 py-5 text-sm font-semibold text-[#3F5C7D]">
                        {{ $history->travelType?->name ?? 'Semua Gaya' }}
                    </td>
                    <!-- Column 5: Budget -->
                    <td class="px-8 py-5 text-sm font-medium capitalize">
                        @if($history->budget === 'hemat')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                {{ $history->budget }}
                            </span>
                        @elseif($history->budget === 'sedang')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                {{ $history->budget }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-100">
                                {{ $history->budget }}
                            </span>
                        @endif
                    </td>
                    <!-- Column 6: Kategori Wisata -->
                    <td class="px-8 py-5 text-sm text-slate-500 max-w-xs truncate" title="{{ $mappedCategories ?: 'Semua Kategori' }}">
                        {{ $mappedCategories ?: 'Semua Kategori' }}
                    </td>
                    <!-- Column 7: Hasil Rekomendasi -->
                    <td class="px-8 py-5 text-sm text-slate-500 max-w-xs truncate font-medium text-indigo-950" title="{{ $mappedRecommendations }}">
                        {{ $mappedRecommendations }}
                    </td>
                    <!-- Column 8: Aksi -->
                    <td class="px-8 py-5 text-sm w-44">
                        <div class="flex items-center gap-4 text-[#89A8E0]">
                            <!-- Detail View Page Link -->
                            <a href="{{ route('admin.riwayat-preferensi.show', $history->id) }}" class="hover:text-[#3F5C7D] transition-colors duration-150" title="Detail">
                                <x-lucide-eye class="w-5 h-5" />
                            </a>
                            
                            <!-- Delete -->
                            <button type="button" @click="deleteModalOpen = true; deleteActionUrl = '{{ route('admin.riwayat-preferensi.destroy', $history->id) }}'" class="hover:text-rose-600 transition-colors duration-150 text-rose-500 align-middle" title="Hapus">
                                <x-lucide-trash-2 class="w-5 h-5" />
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-8 py-10 text-center text-slate-400 font-medium">
                        Tidak ada data riwayat preferensi.
                    </td>
                </tr>
            @endforelse
        </x-admin-tabel>

        <!-- Reusable Deletion Modal Component -->
        <x-delete-modal 
            title="Hapus Riwayat Preferensi?" 
            message="Apakah Anda yakin ingin menghapus log preferensi ini? Tindakan ini tidak dapat dibatalkan." 
        />
    </div>
</x-app-layout>
