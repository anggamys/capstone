<x-app-layout>
    <x-slot name="header">
        {{ __('Kategori Destinasi Wisata') }}
    </x-slot>

    <div class="py-2" x-data="{ deleteModalOpen: false, deleteActionUrl: '' }">
        <!-- Title & Subtitle Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#2B3674]">Data Kategori Destinasi Wisata</h1>
            <p class="text-sm text-slate-400 mt-1 font-medium">Kelola seluruh data kategori secara komprehensif.</p>
        </div>


        <!-- Reusable Search Component -->
        <x-admin-search 
            placeholder="Cari kategori destinasi.." 
            :action="Route::has('admin.kategori-destinasi.create') ? route('admin.kategori-destinasi.create') : '#'" 
            buttonText="Tambah Data" 
        />

        <!-- Reusable Table Component -->
        <x-admin-tabel :headers="['No', 'Nama Kategori', 'Slug', 'Status', 'Aksi']" :items="$categories">
            @forelse($categories as $index => $category)
                <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                    <!-- Column 1: No -->
                    <td class="px-8 py-5 text-sm font-semibold text-[#2B3674] w-20">
                        {{ $categories->firstItem() + $index }}
                    </td>
                    <!-- Column 2: Nama Kategori -->
                    <td class="px-8 py-5 text-sm font-bold text-[#2B3674]">
                        {{ $category->name }}
                    </td>
                    <!-- colom slug -->
                    <td class="px-8 py-5 text-sm font-medium text-slate-500 font-mono">
                        {{ $category->slug }}
                    </td>
                    <!-- Column 3: Status -->
                    <td class="px-8 py-5 text-sm font-medium">
                        @if($category->status === 'active')
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
                    <!-- Column 4: Aksi -->
                    <td class="px-8 py-5 text-sm w-44">
                        <div class="flex items-center gap-4 text-[#89A8E0]">
                            <!-- Detail View (Blue Eye Icon) -->
                            <a href="{{ route('admin.kategori-destinasi.show', $category->id) }}" class="hover:text-[#3F5C7D] transition-colors duration-150" title="Detail">
                                <x-lucide-eye class="w-5 h-5" />
                            </a>
                            
                            <!-- Edit (Orange Pencil Icon) -->
                            <a href="{{ route('admin.kategori-destinasi.edit', $category->id) }}" class="hover:text-amber-600 transition-colors duration-150 text-amber-500" title="Edit">
                                <x-lucide-pencil class="w-5 h-5" />
                            </a>

                            <!-- Delete (Red Trash Icon) -->
                            <button type="button" @click="deleteModalOpen = true; deleteActionUrl = '{{ route('admin.kategori-destinasi.destroy', $category->id) }}'" class="hover:text-rose-600 transition-colors duration-150 text-rose-500 align-middle" title="Hapus">
                                <x-lucide-trash-2 class="w-5 h-5" />
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-10 text-center text-slate-400 font-medium">
                        Tidak ada data kategori destinasi.
                    </td>
                </tr>
            @endforelse
        </x-admin-tabel>

        <!-- Reusable Deletion Modal Component -->
        <x-delete-modal 
            title="Hapus Kategori?" 
            message="Apakah Anda yakin ingin menghapus kategori destinasi ini? Tindakan ini tidak dapat dibatalkan." 
        />
    </div>
</x-app-layout>
