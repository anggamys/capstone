<x-app-layout>
    <x-slot name="header">
        {{ __('Aktivitas Wisata | Tambah') }}
    </x-slot>

    <div class="py-2">
        <form action="{{ route('admin.aktivitas.store') }}" method="POST">
            @csrf
            
            <!-- Header Title & Action Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-[#2B3674]">Tambah Aktivitas Wisata Baru</h1>
                    <p class="text-sm text-slate-400 mt-1 font-medium">Lengkapi informasi untuk menambah aktivitas wisata baru</p>
                </div>
                <div>
                    <a href="{{ route('admin.aktivitas.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#3F5C7D]/30 text-[#3F5C7D] hover:bg-[#3F5C7D]/5 text-sm font-bold rounded-2xl transition-all duration-200 shadow-sm">
                        Batal
                    </a>
                </div>
            </div>

            <!-- Form Content Box -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10 mb-6">
                <!-- Section Title with Info Icon -->
                <div class="flex items-center gap-3 mb-8 border-b border-slate-100 pb-4">
                    <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 1 1 1.085 1.085l-.04.04m-2.137.882a.5.5 0 0 0-.276.182l-.4.5a.5.5 0 0 0 .117.708l.5.4a.5.5 0 0 0 .708-.117l.4-.5a.5.5 0 0 0-.117-.708l-.5-.4a.5.5 0 0 0-.276-.117m-1.724-6.38a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </span>
                    <h2 class="text-base font-bold text-[#2B3674]">Aktivitas Wisata</h2>
                </div>

                <div class="space-y-6">
                    <!-- Input 1: Nama Aktivitas -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-[#2B3674] mb-2">Nama Aktivitas Wisata</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}" 
                               placeholder="Contoh: Trekking" 
                               class="w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold">
                        @error('name')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input 2: Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-bold text-[#2B3674] mb-2">Slug Aktivitas Wisata</label>
                        <input type="text" 
                               name="slug" 
                               id="slug" 
                               value="{{ old('slug') }}" 
                               placeholder="Contoh: trekking" 
                               class="w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-medium font-mono">
                        @error('slug')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input 3: Status -->
                    <div>
                        <label for="status" class="block text-sm font-bold text-[#2B3674] mb-2">Status</label>
                        <x-select-input 
                            name="status"
                            :value="old('status', 'active')"
                            :options="['active' => 'Aktif', 'inactive' => 'Tidak Aktif']"
                        />
                        @error('status')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Warning and Save Section -->
            <div class="bg-[#F4F7FE] rounded-3xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4 border border-indigo-50/10">
                <p class="text-sm font-semibold text-slate-500 text-center sm:text-left">
                    Pastikan semua data sudah benar sebelum menyimpan ke sistem.
                </p>
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 bg-[#3F5C7D] hover:bg-[#344d6b] text-white text-sm font-bold rounded-2xl shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Client-Side Auto-Slug Generator -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');
            
            let isSlugManuallyEdited = false;

            nameInput.addEventListener('input', function() {
                if (!isSlugManuallyEdited) {
                    slugInput.value = generateSlug(this.value);
                }
            });

            slugInput.addEventListener('input', function() {
                isSlugManuallyEdited = true;
                if (this.value === '') {
                    isSlugManuallyEdited = false;
                }
            });

            function generateSlug(text) {
                return text
                    .toString()
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, '-')           // Replace spaces with -
                    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                    .replace(/^-+/, '')             // Trim - from start of text
                    .replace(/-+$/, '');            // Trim - from end of text
            }
        });
    </script>
</x-app-layout>
