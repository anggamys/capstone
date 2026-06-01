<x-app-layout>
    <x-slot name="header">
        {{ __('Blog | Edit') }}
    </x-slot>

    <!-- Include Quill Editor Style and JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-toolbar.ql-snow {
            border: none !important;
            background: #F4F7FE;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            border-bottom: 1px solid #E2E8F0 !important;
            padding: 12px 16px !important;
        }
        .ql-container.ql-snow {
            border: none !important;
            background: #F4F7FE;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
            font-family: 'Outfit', sans-serif !important;
            font-size: 0.875rem;
            color: #2B3674;
            min-height: 280px;
        }
        .ql-editor {
            min-height: 280px;
            padding: 16px 20px !important;
        }
        .ql-editor.ql-blank::before {
            color: #8F9BBA !important;
            font-style: normal !important;
            font-weight: 500 !important;
        }
    </style>

    <div class="py-2">
        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Header Title & Action Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-[#2B3674]">Edit Blog</h1>
                    <p class="text-sm text-slate-400 mt-1 font-medium">Ubah informasi postingan blog sesuai kebutuhan</p>
                </div>
                <div>
                    <a href="{{ route('admin.blog.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#3F5C7D]/30 text-[#3F5C7D] hover:bg-[#3F5C7D]/5 text-sm font-bold rounded-2xl transition-all duration-200 shadow-sm">
                        Batal
                    </a>
                </div>
            </div>

            <!-- Form Content Box -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10 mb-6">
                <!-- Section Title with Info Icon -->
                <div class="flex items-center gap-3 mb-8 border-b border-slate-100 pb-4">
                    <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                        <x-lucide-info class="w-5 h-5" stroke-width="2.5" />
                    </span>
                    <h2 class="text-base font-bold text-[#2B3674]">Informasi Blog</h2>
                </div>

                <div class="space-y-6">
                    <!-- Input 1: Judul Artikel -->
                    <div>
                        <label for="title" class="block text-sm font-bold text-[#2B3674] mb-2">Judul Blog</label>
                        <x-form-input 
                               name="title" 
                               id="title" 
                               value="{{ old('title', $blog->title) }}" 
                               placeholder="Contoh: Tips Mendaki Gunung Ijen Bagi Pemula" 
                        />
                        @error('title')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input 2: Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-bold text-[#2B3674] mb-2">URL Slug</label>
                        <input type="text" 
                               name="slug" 
                               id="slug" 
                               value="{{ old('slug', $blog->slug) }}" 
                               placeholder="contoh-tips-mendaki-gunung-ijen" 
                               class="w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-medium font-mono">
                        <p class="text-[11px] text-slate-400 mt-1.5 ml-1 font-medium">Slug akan digunakan sebagai alamat url blog (SEO Friendly).</p>
                        @error('slug')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input 3: Kategori & Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="blog_category_id" class="block text-sm font-bold text-[#2B3674] mb-2">Kategori Blog</label>
                            <x-select-input 
                                name="blog_category_id"
                                :value="old('blog_category_id', $blog->blog_category_id)"
                                :options="$categories->pluck('name', 'id')->toArray()"
                                placeholder="Pilih Kategori"
                            />
                            @error('blog_category_id')
                                <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-bold text-[#2B3674] mb-2">Status Publikasi</label>
                            <x-select-input 
                                name="status"
                                :value="old('status', $blog->status)"
                                :options="['draft' => 'Draft', 'published' => 'Published']"
                            />
                            @error('status')
                                <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Input 4: Upload Cover Image -->
                    <div>
                        <label class="block text-sm font-bold text-[#2B3674] mb-2">Unggah Gambar Cover</label>
                        <div class="w-full" x-data="{ preview: '{{ $blog->image_url }}' }">
                            <div class="relative border-2 border-dashed border-slate-200 hover:border-[#89A8E0] bg-[#F4F7FE] rounded-3xl p-8 transition-all duration-200 flex flex-col items-center justify-center cursor-pointer">
                                <input type="file" 
                                       name="image" 
                                       id="image" 
                                       accept="image/*"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                       @change="const file = $event.target.files[0]; if (file) { preview = URL.createObjectURL(file) }">
                                
                                <template x-if="!preview">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <span class="p-3 bg-white text-[#3F5C7D] rounded-xl shadow-sm mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                        </span>
                                        <p class="text-sm font-bold text-[#2B3674]">Klik atau seret gambar ke sini</p>
                                        <p class="text-xs text-[#8F9BBA] mt-1 font-semibold">Format JPG, JPEG, PNG, WEBP (Maksimal 2MB)</p>
                                    </div>
                                </template>
                                <template x-if="preview">
                                    <div class="relative w-full max-h-80 rounded-2xl overflow-hidden shadow-sm">
                                        <img :src="preview" class="w-full h-full object-cover max-h-80">
                                        <button type="button" @click.stop="preview = null; document.getElementById('image').value = ''" class="absolute top-3 right-3 p-2 bg-rose-500 hover:bg-rose-600 text-white rounded-full shadow transition-colors cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input 5: Konten Blog (Quill Rich Text Editor) -->
                    <div>
                        <label class="block text-sm font-bold text-[#2B3674] mb-2">Konten / Isi Blog</label>
                        <input type="hidden" name="content" id="content-input" value="{{ old('content', $blog->content) }}">
                        <div id="quill-editor" class="w-full">
                            {!! old('content', $blog->content) !!}
                        </div>
                        @error('content')
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
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Include Quill Editor JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Slug Generator
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');
            let isSlugManuallyEdited = true; // Kept manually edited for edit page by default

            titleInput.addEventListener('input', function() {
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

            // 2. Quill Editor Configuration
            const quill = new Quill('#quill-editor', {
                theme: 'snow',
                placeholder: 'Tuliskan isi blog di sini...',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'blockquote', 'code-block'],
                        ['clean']
                    ]
                }
            });

            // Bind editor content to the hidden field on form submit
            const form = document.querySelector('form');
            const contentInput = document.getElementById('content-input');

            form.addEventListener('submit', function() {
                // Get html content from Quill
                contentInput.value = quill.root.innerHTML;
                
                // If it's just empty html, clear it to trigger required validation
                if (quill.getText().trim().length === 0) {
                    contentInput.value = '';
                }
            });
        });
    </script>
</x-app-layout>
