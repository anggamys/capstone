<x-app-layout>
    <x-slot name="header">
        {{ __('Subkategori Destinasi Wisata') }}
    </x-slot>

    <div class="py-2" x-data="{ deleteModalOpen: false, deleteActionUrl: '' }">
        <!-- Title & Subtitle Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#2B3674]">Data Sub Kategori Destinasi Wisata</h1>
            <p class="text-sm text-slate-400 mt-1 font-medium">Kelola seluruh data sub kategori secara komprehensif.</p>
        </div>

        <!-- Reusable Search Component -->
        <x-admin-search 
            placeholder="Cari sub kategori destinasi.." 
            :action="Route::has('admin.sub-kategori-destinasi.create') ? route('admin.sub-kategori-destinasi.create') : '#'" 
            buttonText="Tambah Data" 
        />

        <!-- Reusable Table Component -->
        <x-admin-tabel :headers="['No', 'Nama Sub Kategori', 'Slug', 'Sub Kategori Dari', 'Status', 'Aksi']" :items="$subcategories">
            @forelse($subcategories as $index => $subcategory)
                <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                    <!-- Column 1: No -->
                    <td class="px-8 py-5 text-sm font-semibold text-[#2B3674] w-20">
                        {{ $subcategories->firstItem() + $index }}
                    </td>
                    <!-- Column 2: Nama Sub Kategori -->
                    <td class="px-8 py-5 text-sm font-bold text-[#2B3674]">
                        {{ $subcategory->name }}
                    </td>
                    <!-- Column 3: Slug -->
                    <td class="px-8 py-5 text-sm font-medium text-slate-500 font-mono">
                        {{ $subcategory->slug }}
                    </td>
                    <!-- Column 4: Sub Kategori Dari (Category Name) -->
                    <td class="px-8 py-5 text-sm font-semibold text-[#2B3674]/90">
                        {{ $subcategory->category->name ?? '-' }}
                    </td>
                    <!-- Column 5: Status -->
                    <td class="px-8 py-5 text-sm font-medium">
                        @if($subcategory->status === 'active')
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
                    <!-- Column 6: Aksi -->
                    <td class="px-8 py-5 text-sm w-44">
                        <div class="flex items-center gap-4 text-[#89A8E0]">
                            <!-- Detail View -->
                            <a href="{{ route('admin.sub-kategori-destinasi.show', $subcategory->id) }}" class="hover:text-[#3F5C7D] transition-colors duration-150" title="Detail">
                                <x-lucide-eye class="w-5 h-5" />
                            </a>
                            
                            <!-- Edit -->
                            <a href="{{ route('admin.sub-kategori-destinasi.edit', $subcategory->id) }}" class="hover:text-amber-600 transition-colors duration-150 text-amber-500" title="Edit">
                                <x-lucide-pencil class="w-5 h-5" />
                            </a>
 
                            <!-- Delete -->
                            <button type="button" @click="deleteModalOpen = true; deleteActionUrl = '{{ route('admin.sub-kategori-destinasi.destroy', $subcategory->id) }}'" class="hover:text-rose-600 transition-colors duration-150 text-rose-500 align-middle" title="Hapus">
                                <x-lucide-trash-2 class="w-5 h-5" />
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-8 py-10 text-center text-slate-400 font-medium">
                        Tidak ada data subkategori destinasi.
                    </td>
                </tr>
            @endforelse
        </x-admin-tabel>

        <!-- Reusable Deletion Modal Component -->
        <x-delete-modal 
            title="Hapus Sub Kategori?" 
            message="Apakah Anda yakin ingin menghapus sub kategori destinasi ini? Tindakan ini tidak dapat dibatalkan." 
        />
    </div>
</x-app-layout>