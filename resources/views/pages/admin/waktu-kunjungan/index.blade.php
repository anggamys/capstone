<x-app-layout>
    <x-slot name="header">
        {{ __('Waktu Kunjungan') }}
    </x-slot>

    <div class="py-2" x-data="{ deleteModalOpen: false, deleteActionUrl: '' }">
        <!-- Title & Subtitle Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#2B3674]">Data Waktu Kunjungan</h1>
            <p class="text-sm text-slate-400 mt-1 font-medium">Kelola seluruh data waktu kunjungan secara komprehensif.</p>
        </div>

        <!-- Reusable Search Component -->
        <x-admin-search 
            placeholder="Cari waktu kunjungan.." 
            :action="route('admin.waktu-kunjungan.create')" 
            buttonText="Tambah Data" 
        />

        <!-- Reusable Table Component -->
        <x-admin-tabel :headers="['No', 'Nama Waktu Kunjungan', 'Slug', 'Status', 'Aksi']" :items="$visitTimes">
            @forelse($visitTimes as $index => $visitTime)
                <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                    <!-- Column 1: No -->
                    <td class="px-8 py-5 text-sm font-semibold text-[#2B3674] w-20">
                        {{ $visitTimes->firstItem() + $index }}
                    </td>
                    <!-- Column 2: Nama Waktu Kunjungan -->
                    <td class="px-8 py-5 text-sm font-bold text-[#2B3674]">
                        {{ $visitTime->name }}
                    </td>
                    <!-- Column 3: Slug -->
                    <td class="px-8 py-5 text-sm font-medium text-slate-500 font-mono">
                        {{ $visitTime->slug }}
                    </td>
                    <!-- Column 4: Status -->
                    <td class="px-8 py-5 text-sm font-medium">
                        @if($visitTime->status === 'active')
                            <span class="inline-flex items-center gap-1.5 text-emerald-600 font-semibold">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 border border-emerald-100 shadow-sm shadow-emerald-500/20"></span>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-rose-600 font-semibold">
                                <span class="w-2.5 h-2.5 rounded-full bg-rose-500 border border-rose-100 shadow-sm shadow-rose-500/20"></span>
                                Tidak Aktif
                            </span>
                        @endif
                    </td>
                    <!-- Column 5: Aksi -->
                    <td class="px-8 py-5 text-sm w-44">
                        <div class="flex items-center gap-4 text-[#89A8E0]">
                            <!-- Detail View -->
                            <a href="{{ route('admin.waktu-kunjungan.show', $visitTime->id) }}" class="hover:text-[#3F5C7D] transition-colors duration-150" title="Detail">
                                <x-lucide-eye class="w-5 h-5" />
                            </a>
                            
                            <!-- Edit -->
                            <a href="{{ route('admin.waktu-kunjungan.edit', $visitTime->id) }}" class="hover:text-amber-600 transition-colors duration-150 text-amber-500" title="Edit">
                                <x-lucide-pencil class="w-5 h-5" />
                            </a>
 
                            <!-- Delete -->
                            <button type="button" @click="deleteModalOpen = true; deleteActionUrl = '{{ route('admin.waktu-kunjungan.destroy', $visitTime->id) }}'" class="hover:text-rose-600 transition-colors duration-150 text-rose-500 align-middle" title="Hapus">
                                <x-lucide-trash-2 class="w-5 h-5" />
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-10 text-center text-slate-400 font-medium">
                        Tidak ada data waktu kunjungan.
                    </td>
                </tr>
            @endforelse
        </x-admin-tabel>

        <!-- Reusable Deletion Modal Component -->
        <x-delete-modal 
            title="Hapus Waktu Kunjungan?" 
            message="Apakah Anda yakin ingin menghapus waktu kunjungan ini? Tindakan ini tidak dapat dibatalkan." 
        />
    </div>
</x-app-layout>
