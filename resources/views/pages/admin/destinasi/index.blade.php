<x-app-layout>
    <x-slot name="header">
        {{ __('Destinasi Wisata') }}
    </x-slot>

    <div class="py-2" x-data="{ deleteModalOpen: false, deleteActionUrl: '' }">
        <!-- Title & Subtitle Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#2B3674]">Data Destinasi Wisata</h1>
            <p class="text-sm text-slate-400 mt-1 font-medium">Kelola data destinasi wisata Banyuwangi secara komprehensif.</p>
        </div>

        <!-- Reusable Search Component -->
        <x-admin-search 
            placeholder="Cari destinasi wisata (nama, kecamatan).." 
            :action="route('admin.destinasi.create')" 
            buttonText="Tambah Data" 
        />

        <!-- Reusable Table Component -->
        <x-admin-tabel :headers="['No', 'Cover', 'Nama Destinasi', 'Kategori / Subkategori', 'Kecamatan', 'Status', 'Aksi']" :items="$destinations">
            @forelse($destinations as $index => $destination)
                <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                    <!-- Column 1: No -->
                    <td class="px-8 py-5 text-sm font-semibold text-[#2B3674] w-20">
                        {{ $destinations->firstItem() + $index }}
                    </td>
                    <!-- Column 2: Cover -->
                    <td class="px-8 py-5 text-sm w-32">
                        @if($destination->main_image)
                            <img src="{{ asset('storage/' . $destination->main_image) }}" alt="{{ $destination->name }}" class="w-20 h-12 object-cover rounded-xl shadow-sm border border-slate-100">
                        @else
                            <div class="w-20 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-[10px] text-slate-400 font-bold border border-dashed border-slate-200">
                                No Image
                            </div>
                        @endif
                    </td>
                    <!-- Column 3: Nama Destinasi -->
                    <td class="px-8 py-5 text-sm font-bold text-[#2B3674] max-w-xs truncate" title="{{ $destination->name }}">
                        {{ $destination->name }}
                    </td>
                    <!-- Column 4: Kategori / Subkategori -->
                    <td class="px-8 py-5 text-sm">
                        <div class="flex flex-col gap-0.5">
                            <span class="font-bold text-[#2B3674] text-xs">
                                {{ $destination->category->name }}
                            </span>
                            @if($destination->subcategory)
                                <span class="text-slate-400 text-[11px] font-semibold">
                                    {{ $destination->subcategory->name }}
                                </span>
                            @endif
                        </div>
                    </td>
                    <!-- Column 5: Kecamatan -->
                    <td class="px-8 py-5 text-sm font-semibold text-slate-600">
                        {{ $destination->district ?? '-' }}
                    </td>

                    <!-- Column 8: Status -->
                    <td class="px-8 py-5 text-sm font-medium">
                        @if($destination->status === 'active')
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
                    <!-- Column 9: Aksi -->
                    <td class="px-8 py-5 text-sm w-44">
                        <div class="flex items-center gap-4 text-[#89A8E0]">
                            <!-- Detail View (Blue Eye Icon) -->
                            <a href="{{ route('admin.destinasi.show', $destination->id) }}" class="hover:text-[#3F5C7D] transition-colors duration-150" title="Detail">
                                <x-lucide-eye class="w-5 h-5" />
                            </a>
                            
                            <!-- Edit (Orange Pencil Icon) -->
                            <a href="{{ route('admin.destinasi.edit', $destination->id) }}" class="hover:text-amber-600 transition-colors duration-150 text-amber-500" title="Edit">
                                <x-lucide-pencil class="w-5 h-5" />
                            </a>

                            <!-- Delete (Red Trash Icon) -->
                            <button type="button" @click="deleteModalOpen = true; deleteActionUrl = '{{ route('admin.destinasi.destroy', $destination->id) }}'" class="hover:text-rose-600 transition-colors duration-150 text-rose-500 align-middle" title="Hapus">
                                <x-lucide-trash-2 class="w-5 h-5" />
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-8 py-10 text-center text-slate-400 font-medium">
                        Tidak ada data destinasi wisata.
                    </td>
                </tr>
            @endforelse
        </x-admin-tabel>

        <!-- Reusable Deletion Modal Component -->
        <x-delete-modal 
            title="Hapus Destinasi Wisata?" 
            message="Apakah Anda yakin ingin menghapus destinasi wisata ini? Tindakan ini tidak dapat dibatalkan." 
        />
    </div>
</x-app-layout>
