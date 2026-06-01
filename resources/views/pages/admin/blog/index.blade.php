<x-app-layout>
    <x-slot name="header">
        {{ __('Blog') }}
    </x-slot>

    <div class="py-2" x-data="{ deleteModalOpen: false, deleteActionUrl: '' }">
        <!-- Title & Subtitle Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#2B3674]">Data Blog</h1>
            <p class="text-sm text-slate-400 mt-1 font-medium">Kelola seluruh postingan blog secara komprehensif.</p>
        </div>

        <!-- Reusable Search Component -->
        <x-admin-search 
            placeholder="Cari blog (judul, kategori, penulis).." 
            :action="route('admin.blog.create')" 
            buttonText="Tambah Data" 
        />

        <!-- Reusable Table Component -->
        <x-admin-tabel :headers="['No', 'Cover', 'Judul Blog', 'Kategori', 'Penulis', 'Status', 'Aksi']" :items="$blogs">
            @forelse($blogs as $index => $blog)
                <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                    <!-- Column 1: No -->
                    <td class="px-8 py-5 text-sm font-semibold text-[#2B3674] w-20">
                        {{ $blogs->firstItem() + $index }}
                    </td>
                    <!-- Column 2: Cover -->
                    <td class="px-8 py-5 text-sm w-32">
                        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-20 h-12 object-cover rounded-xl shadow-sm border border-slate-100">
                    </td>
                    <!-- Column 3: Judul Artikel -->
                    <td class="px-8 py-5 text-sm font-bold text-[#2B3674] max-w-xs truncate" title="{{ $blog->title }}">
                        {{ $blog->title }}
                    </td>
                    <!-- Column 4: Kategori -->
                    <td class="px-8 py-5 text-sm font-semibold text-[#2B3674]">
                        {{ $blog->category->name }}
                    </td>
                    <!-- Column 5: Penulis -->
                    <td class="px-8 py-5 text-sm font-semibold text-slate-600">
                        {{ $blog->admin->name ?? 'Admin' }}
                    </td>
                    <!-- Column 6: Status -->
                    <td class="px-8 py-5 text-sm font-medium">
                        @if($blog->status === 'published')
                            <span class="inline-flex items-center gap-1.5 text-emerald-600 font-semibold">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 border border-emerald-100 shadow-sm shadow-emerald-500/20"></span>
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-amber-600 font-semibold">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500 border border-amber-100 shadow-sm shadow-amber-500/20"></span>
                                Draft
                            </span>
                        @endif
                    </td>
                    <!-- Column 7: Aksi -->
                    <td class="px-8 py-5 text-sm w-44">
                        <div class="flex items-center gap-4 text-[#89A8E0]">
                            <!-- Detail View (Blue Eye Icon) -->
                            <a href="{{ route('admin.blog.show', $blog->id) }}" class="hover:text-[#3F5C7D] transition-colors duration-150" title="Detail">
                                <x-lucide-eye class="w-5 h-5" />
                            </a>
                            
                            <!-- Edit (Orange Pencil Icon) -->
                            <a href="{{ route('admin.blog.edit', $blog->id) }}" class="hover:text-amber-600 transition-colors duration-150 text-amber-500" title="Edit">
                                <x-lucide-pencil class="w-5 h-5" />
                            </a>

                            <!-- Delete (Red Trash Icon) -->
                            <button type="button" @click="deleteModalOpen = true; deleteActionUrl = '{{ route('admin.blog.destroy', $blog->id) }}'" class="hover:text-rose-600 transition-colors duration-150 text-rose-500 align-middle" title="Hapus">
                                <x-lucide-trash-2 class="w-5 h-5" />
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-8 py-10 text-center text-slate-400 font-medium">
                        Tidak ada data blog.
                    </td>
                </tr>
            @endforelse
        </x-admin-tabel>

        <!-- Reusable Deletion Modal Component -->
        <x-delete-modal 
            title="Hapus Blog?" 
            message="Apakah Anda yakin ingin menghapus blog ini? Tindakan ini tidak dapat dibatalkan." 
        />
    </div>
</x-app-layout>
