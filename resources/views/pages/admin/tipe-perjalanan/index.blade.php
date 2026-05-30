<x-app-layout>
    <x-slot name="header">
        {{ __('Tipe Perjalanan') }}
    </x-slot>

    <div class="py-2" x-data="{ deleteModalOpen: false, deleteActionUrl: '' }">
        <!-- Title & Subtitle Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#2B3674]">Data Tipe Perjalanan</h1>
            <p class="text-sm text-slate-400 mt-1 font-medium">Kelola seluruh data tipe perjalanan secara komprehensif.</p>
        </div>

        <!-- Reusable Search Component -->
        <x-admin-search 
            placeholder="Cari tipe perjalanan.." 
            :action="route('admin.tipe-perjalanan.create')" 
            buttonText="Tambah Data" 
        />

        <!-- Reusable Table Component -->
        <x-admin-tabel :headers="['No', 'Nama Tipe Perjalanan', 'Slug', 'Status', 'Aksi']" :items="$travelTypes">
            @forelse($travelTypes as $index => $travelType)
                <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                    <!-- Column 1: No -->
                    <td class="px-8 py-5 text-sm font-semibold text-[#2B3674] w-20">
                        {{ $travelTypes->firstItem() + $index }}
                    </td>
                    <!-- Column 2: Nama Tipe Perjalanan -->
                    <td class="px-8 py-5 text-sm font-bold text-[#2B3674]">
                        {{ $travelType->name }}
                    </td>
                    <!-- Column 3: Slug -->
                    <td class="px-8 py-5 text-sm font-medium text-slate-500 font-mono">
                        {{ $travelType->slug }}
                    </td>
                    <!-- Column 4: Status -->
                    <td class="px-8 py-5 text-sm font-medium">
                        @if($travelType->status === 'active')
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
                            <a href="{{ route('admin.tipe-perjalanan.show', $travelType->id) }}" class="hover:text-[#3F5C7D] transition-colors duration-150" title="Detail">
                                <x-lucide-eye class="w-5 h-5" />
                            </a>
                            
                            <!-- Edit -->
                            <a href="{{ route('admin.tipe-perjalanan.edit', $travelType->id) }}" class="hover:text-amber-600 transition-colors duration-150 text-amber-500" title="Edit">
                                <x-lucide-pencil class="w-5 h-5" />
                            </a>
 
                            <!-- Delete -->
                            <button type="button" @click="deleteModalOpen = true; deleteActionUrl = '{{ route('admin.tipe-perjalanan.destroy', $travelType->id) }}'" class="hover:text-rose-600 transition-colors duration-150 text-rose-500 align-middle" title="Hapus">
                                <x-lucide-trash-2 class="w-5 h-5" />
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-10 text-center text-slate-400 font-medium">
                        Tidak ada data tipe perjalanan.
                    </td>
                </tr>
            @endforelse
        </x-admin-tabel>

        <!-- Reusable Deletion Modal Component -->
        <x-delete-modal 
            title="Hapus Tipe Perjalanan?" 
            message="Apakah Anda yakin ingin menghapus tipe perjalanan ini? Tindakan ini tidak dapat dibatalkan." 
        />
    </div>
</x-app-layout>
