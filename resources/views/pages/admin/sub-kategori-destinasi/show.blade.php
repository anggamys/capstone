<x-app-layout>
    <x-slot name="header">
        {{ __('Sub Kategori Destinasi | Detail') }}
    </x-slot>

    <div class="py-2">
        <!-- Header Title & Action Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-[#2B3674]">Detail Sub Kategori Destinasi</h1>
                <p class="text-sm text-slate-400 mt-1 font-medium">Lihat rincian informasi sub kategori destinasi tersebut</p>
            </div>
            <div>
                <a href="{{ route('admin.sub-kategori-destinasi.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#3F5C7D]/30 text-[#3F5C7D] hover:bg-[#3F5C7D]/5 text-sm font-bold rounded-2xl transition-all duration-200 shadow-sm">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Detail Content Box -->
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10 mb-6">
            <!-- Section Title with Info Icon -->
            <div class="flex items-center gap-3 mb-8 border-b border-slate-100 pb-4">
                <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                    <x-lucide-info class="w-5 h-5" stroke-width="2.5" />
                </span>
                <h2 class="text-base font-bold text-[#2B3674]">Informasi Sub Kategori</h2>
            </div>

            <div class="space-y-6">
                <!-- Display 1: Kategori Induk -->
                <div>
                    <label class="block text-sm font-bold text-[#2B3674] mb-2">Kategori Induk</label>
                    <input type="text" 
                           value="{{ $subcategory->category->name ?? '-' }}" 
                           disabled 
                           class="w-full px-5 py-4 bg-[#F4F7FE]/60 text-slate-500 rounded-2xl border-none text-sm font-semibold cursor-not-allowed">
                </div>

                <!-- Display 2: Nama Sub Kategori -->
                <div>
                    <label class="block text-sm font-bold text-[#2B3674] mb-2">Nama Sub Kategori Destinasi</label>
                    <input type="text" 
                           value="{{ $subcategory->name }}" 
                           disabled 
                           class="w-full px-5 py-4 bg-[#F4F7FE]/60 text-slate-500 rounded-2xl border-none text-sm font-semibold cursor-not-allowed">
                </div>

                <!-- Display 3: Slug -->
                <div>
                    <label class="block text-sm font-bold text-[#2B3674] mb-2">Slug Sub Kategori Destinasi</label>
                    <input type="text" 
                           value="{{ $subcategory->slug }}" 
                           disabled 
                           class="w-full px-5 py-4 bg-[#F4F7FE]/60 text-slate-500 rounded-2xl border-none text-sm font-medium font-mono cursor-not-allowed">
                </div>

                <!-- Display 4: Status -->
                <div>
                    <label class="block text-sm font-bold text-[#2B3674] mb-2">Status</label>
                    <input type="text" 
                           value="{{ $subcategory->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}" 
                           disabled 
                           class="w-full px-5 py-4 bg-[#F4F7FE]/60 text-slate-500 rounded-2xl border-none text-sm font-semibold cursor-not-allowed">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
