<x-app-layout>
    <x-slot name="header">
        {{ __('Destinasi Wisata | Tambah') }}
    </x-slot>

    <div class="py-2">
        <form action="{{ route('admin.destinasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Header Title & Action Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-[#2B3674]">Tambah Destinasi Baru</h1>
                    <p class="text-sm text-slate-400 mt-1 font-medium">Lengkapi informasi untuk menambah destinasi baru</p>
                </div>
                <div>
                    <a href="{{ route('admin.destinasi.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#3F5C7D]/30 text-[#3F5C7D] hover:bg-[#3F5C7D]/5 text-sm font-bold rounded-2xl transition-all duration-200 shadow-sm">
                        Batal
                    </a>
                </div>
            </div>

            <!-- SECTION 1: Informasi Umum -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10 mb-6">
                <div class="flex items-center gap-3 mb-8 border-b border-slate-100 pb-4">
                    <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                        <x-lucide-info class="w-5 h-5" stroke-width="2.5" />
                    </span>
                    <h2 class="text-base font-bold text-[#2B3674]">Informasi Umum</h2>
                </div>

                <div class="space-y-6">
                    <!-- Nama Destinasi -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-[#2B3674] mb-2">Nama Destinasi</label>
                        <x-form-input 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}" 
                               placeholder="Contoh: Kawah Ijen, Taman Nasional Baluran" 
                        />
                        @error('name')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-bold text-[#2B3674] mb-2">URL Slug</label>
                        <input type="text" 
                               name="slug" 
                               id="slug" 
                               value="{{ old('slug') }}" 
                               placeholder="contoh-kawah-ijen-blue-fire" 
                               class="w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-medium font-mono">
                        <p class="text-[11px] text-slate-400 mt-1.5 ml-1 font-medium">Slug akan digunakan sebagai alamat url destinasi (SEO Friendly).</p>
                        @error('slug')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori & Subkategori -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="destination_category_id" class="block text-sm font-bold text-[#2B3674] mb-2">Kategori</label>
                            <x-select-input 
                                name="destination_category_id"
                                :value="old('destination_category_id')"
                                :options="$categories->pluck('name', 'id')->toArray()"
                                placeholder="Pilih Kategori"
                            />
                            @error('destination_category_id')
                                <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="destination_subcategory_id" class="block text-sm font-bold text-[#2B3674] mb-2">Subkategori</label>
                            <x-select-input 
                                name="destination_subcategory_id"
                                :value="old('destination_subcategory_id')"
                                :options="$subcategories->map(fn($sub) => ['value' => $sub->id, 'label' => $sub->name, 'category_id' => $sub->destination_category_id])->toArray()"
                                placeholder="Pilih Subkategori"
                                depends-on="destination_category_id"
                            />
                            @error('destination_subcategory_id')
                                <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-bold text-[#2B3674] mb-2">Deskripsi</label>
                        <x-form-textarea 
                                  name="description" 
                                  id="description" 
                                  rows="5" 
                                  placeholder="Tuliskan deskripsi menarik tentang keindahan dan keunikan destinasi ini..."
                        >{{ old('description') }}</x-form-textarea>
                        @error('description')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
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

                    <!-- Upload Gambar Utama -->
                    <div>
                        <label class="block text-sm font-bold text-[#2B3674] mb-2">Unggah Gambar Utama</label>
                        <div class="w-full" x-data="{ preview: null }">
                            <div class="relative border-2 border-dashed border-slate-200 hover:border-[#89A8E0] bg-[#F4F7FE] rounded-3xl p-8 transition-all duration-200 flex flex-col items-center justify-center cursor-pointer">
                                <input type="file" 
                                       name="main_image" 
                                       id="main_image" 
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
                                        <button type="button" @click.stop="preview = null; document.getElementById('main_image').value = ''" class="absolute top-3 right-3 p-2 bg-rose-500 hover:bg-rose-600 text-white rounded-full shadow transition-colors cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                        @error('main_image')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Lokasi Destinasi -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10 mb-6">
                <div class="flex items-center gap-3 mb-8 border-b border-slate-100 pb-4">
                    <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                        <x-lucide-map-pin class="w-5 h-5" stroke-width="2.5" />
                    </span>
                    <h2 class="text-base font-bold text-[#2B3674]">Lokasi Destinasi</h2>
                </div>

                <div class="space-y-6">
                    <!-- Alamat -->
                    <div>
                        <label for="address" class="block text-sm font-bold text-[#2B3674] mb-2">Alamat</label>
                        <x-form-input 
                               name="address" 
                               id="address" 
                               value="{{ old('address') }}" 
                               placeholder="Masukkan alamat lengkap..." 
                        />
                        @error('address')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kecamatan -->
                    <div>
                        <label for="district" class="block text-sm font-bold text-[#2B3674] mb-2">Kecamatan</label>
                        @php
                            $districts = [
                                'Licin' => 'Licin', 
                                'Pesanggaran' => 'Pesanggaran', 
                                'Genteng' => 'Genteng', 
                                'Banyuwangi' => 'Banyuwangi', 
                                'Kalipuro' => 'Kalipuro', 
                                'Kabat' => 'Kabat', 
                                'Rogojampi' => 'Rogojampi', 
                                'Srono' => 'Srono', 
                                'Cluring' => 'Cluring', 
                                'Muncar' => 'Muncar', 
                                'Tegaldlimo' => 'Tegaldlimo', 
                                'Purwoharjo' => 'Purwoharjo', 
                                'Gambiran' => 'Gambiran', 
                                'Tegalsari' => 'Tegalsari', 
                                'Siliragung' => 'Siliragung', 
                                'Bangorejo' => 'Bangorejo', 
                                'Sempu' => 'Sempu', 
                                'Singojuruh' => 'Singojuruh', 
                                'Songgon' => 'Songgon', 
                                'Glagah' => 'Glagah', 
                                'Wongsorejo' => 'Wongsorejo', 
                                'Glenmore' => 'Glenmore', 
                                'Kalibaru' => 'Kalibaru'
                            ];
                        @endphp
                        <x-select-input 
                            name="district"
                            :value="old('district')"
                            :options="$districts"
                            placeholder="Pilih Kecamatan"
                        />
                        @error('district')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Link Google Maps -->
                    <div>
                        <label for="google_maps_url" class="block text-sm font-bold text-[#2B3674] mb-2">Link Google Maps</label>
                        <x-form-input 
                               name="google_maps_url" 
                               id="google_maps_url" 
                               value="{{ old('google_maps_url') }}" 
                               placeholder="Tempel link Google Maps di sini" 
                        />
                        @error('google_maps_url')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SECTION 3: Informasi Kunjungan -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10 mb-6">
                <div class="flex items-center gap-3 mb-8 border-b border-slate-100 pb-4">
                    <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                        <x-lucide-clock class="w-5 h-5" stroke-width="2.5" />
                    </span>
                    <h2 class="text-base font-bold text-[#2B3674]">Informasi Kunjungan</h2>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Harga Tiket -->
                        <div>
                            <label for="ticket_price" class="block text-sm font-bold text-[#2B3674] mb-2">Harga Tiket</label>
                            <x-form-input 
                                   type="number" 
                                   name="ticket_price" 
                                   id="ticket_price" 
                                   value="{{ old('ticket_price', 0) }}" 
                                   prefix="Rp"
                            />
                            @error('ticket_price')
                                <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jam Operasional -->
                        <div>
                            <label for="operational_hours" class="block text-sm font-bold text-[#2B3674] mb-2">Jam Operasional (Contoh: 08.00 - 17.00 WIB)</label>
                            <x-form-input 
                                   name="operational_hours" 
                                   id="operational_hours" 
                                   value="{{ old('operational_hours') }}" 
                                   placeholder="Contoh: 08.00 - 17.00 WIB" 
                            />
                            @error('operational_hours')
                                <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Durasi Kunjungan -->
                        <div>
                            <label for="visit_duration_hours" class="block text-sm font-bold text-[#2B3674] mb-2">Estimasi Durasi Kunjungan (Satuan Jam)</label>
                            <x-form-input 
                                   name="visit_duration_hours" 
                                   id="visit_duration_hours" 
                                   value="{{ old('visit_duration_hours') }}" 
                                   placeholder="Contoh: 2 - 3" 
                            />
                            @error('visit_duration_hours')
                                <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rating -->
                        <div>
                            <label for="rating" class="block text-sm font-bold text-[#2B3674] mb-2">Rating</label>
                            <x-form-input 
                                   name="rating" 
                                   id="rating" 
                                   value="{{ old('rating', '0.0') }}" 
                                   placeholder="4.5" 
                                   prefix="★"
                                   prefix-class="text-amber-500"
                            />
                            @error('rating')
                                <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Akses Perjalanan -->
                    <div>
                        <label for="access_level" class="block text-sm font-bold text-[#2B3674] mb-2">Akses Perjalanan</label>
                        <x-select-input 
                            name="access_level"
                            :value="old('access_level', 'Sedang')"
                            :options="['Mudah' => 'Mudah', 'Sedang' => 'Sedang', 'Sulit' => 'Sulit']"
                        />
                        @error('access_level')
                            <p class="text-xs text-rose-500 font-semibold mt-1.5 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SECTION 4: Kriteria Rekomendasi -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10 mb-6" x-data="{
                selectedCategory: '',
                selectedDistrict: '',
                selectedAccess: '',
                tags: '',
                init() {
                    this.$watch('selectedCategory', () => this.updateTags());
                    this.$watch('selectedDistrict', () => this.updateTags());
                    this.$watch('selectedAccess', () => this.updateTags());
                },
                updateTags() {
                    let collected = [];
                    if (this.selectedCategory) collected.push('#' + this.selectedCategory.replace(/\s+/g, ''));
                    if (this.selectedDistrict) collected.push('#' + this.selectedDistrict);
                    if (this.selectedAccess) collected.push('#Akses' + this.selectedAccess);
                    this.tags = collected.join(' ');
                }
            }">
                <div class="flex items-center gap-3 mb-8 border-b border-slate-100 pb-4">
                    <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
                        <x-lucide-sparkles class="w-5 h-5" stroke-width="2.5" />
                    </span>
                    <h2 class="text-base font-bold text-[#2B3674]">Kriteria Rekomendasi</h2>
                </div>

                <div class="space-y-6">
                    <!-- Aktivitas -->
                    <div>
                        <label class="block text-sm font-bold text-[#2B3674] mb-3">Aktivitas</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach($activities as $activity)
                                <x-form-checkbox-pill 
                                    name="activities[]"
                                    :value="$activity->id"
                                    :label="$activity->name"
                                    :checked="in_array($activity->id, old('activities', []))"
                                />
                            @endforeach
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    <div>
                        <label class="block text-sm font-bold text-[#2B3674] mb-3">Fasilitas</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach($facilities as $facility)
                                <x-form-checkbox-pill 
                                    name="facilities[]"
                                    :value="$facility->id"
                                    :label="$facility->name"
                                    :checked="in_array($facility->id, old('facilities', []))"
                                />
                            @endforeach
                        </div>
                    </div>

                    <!-- Tipe Perjalanan -->
                    <div>
                        <label class="block text-sm font-bold text-[#2B3674] mb-3">Tipe Perjalanan</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach($travelTypes as $type)
                                <x-form-checkbox-pill 
                                    name="travel_types[]"
                                    :value="$type->id"
                                    :label="$type->name"
                                    :checked="in_array($type->id, old('travel_types', []))"
                                />
                            @endforeach
                        </div>
                    </div>

                    <!-- Waktu Kunjungan -->
                    <div>
                        <label class="block text-sm font-bold text-[#2B3674] mb-3">Waktu Kunjungan</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach($visitTimes as $time)
                                <x-form-checkbox-pill 
                                    name="visit_times[]"
                                    :value="$time->id"
                                    :label="$time->name"
                                    :checked="in_array($time->id, old('visit_times', []))"
                                />
                            @endforeach
                        </div>
                    </div>

                    <!-- Transportasi -->
                    <div>
                        <label class="block text-sm font-bold text-[#2B3674] mb-3">Transportasi</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach($transportations as $transport)
                                <x-form-checkbox-pill 
                                    name="transportations[]"
                                    :value="$transport->id"
                                    :label="$transport->name"
                                    :checked="in_array($transport->id, old('transportations', []))"
                                />
                            @endforeach
                        </div>
                    </div>

                    <!-- Generated Tags -->
                    <div>
                        <label for="tags_display" class="block text-sm font-bold text-[#2B3674] mb-2">Generated Tags</label>
                        <div class="w-full px-5 py-4 bg-[#F4F7FE]/60 rounded-2xl text-sm font-bold font-mono text-[#3F5C7D] border border-dashed border-indigo-100/30 flex flex-wrap gap-2 select-none" id="tags_preview_box" data-categories="{{ json_encode($categories->pluck('name', 'id')->toArray()) }}">
                            <span class="text-slate-400 font-semibold text-xs italic">Tag otomatis terkumpul di sini...</span>
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1.5 ml-1 font-semibold">Ini adalah representasi tag sistem untuk algoritma rekomendasi.</p>
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

    <!-- Client-Side Script for Slug Generator & Dynamic Generated Tags -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Slug Generator
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

            // 2. Dynamic Tags collector
            // Listen to selected Category, Kecamatan, and Access Level changes to update tags preview box
            const previewBox = document.getElementById('tags_preview_box');
            const categoryOptions = JSON.parse(previewBox.dataset.categories);
            
            function collectTags() {
                let tags = [];
                
                // Get Category (from hidden input inside select components)
                const categoryInput = document.querySelector('input[name="destination_category_id"]');
                const categoryVal = categoryInput ? categoryInput.value : '';
                
                // Fetch active label for category
                if (categoryVal) {
                    const categoryName = categoryOptions[categoryVal];
                    if (categoryName) {
                        tags.push('#' + categoryName.replace(/\s+/g, ''));
                    }
                }
                
                // Get Subdistrict (district)
                const districtInput = document.querySelector('input[name="district"]');
                const districtVal = districtInput ? districtInput.value : '';
                if (districtVal) {
                    tags.push('#' + districtVal);
                }
                
                // Get Access Level
                const accessInput = document.querySelector('input[name="access_level"]');
                const accessVal = accessInput ? accessInput.value : '';
                if (accessVal) {
                    tags.push('#Akses' + accessVal);
                }

                // Add active items from relationships (e.g. Activities, Facilities, Transport, etc.)
                document.querySelectorAll('input[name="activities[]"]:checked').forEach(el => {
                    const txt = el.closest('label').querySelector('span').innerText;
                    tags.push('#' + txt.replace(/\s+/g, ''));
                });
                document.querySelectorAll('input[name="facilities[]"]:checked').forEach(el => {
                    const txt = el.closest('label').querySelector('span').innerText;
                    tags.push('#' + txt.replace(/\s+/g, ''));
                });
                document.querySelectorAll('input[name="travel_types[]"]:checked').forEach(el => {
                    const txt = el.closest('label').querySelector('span').innerText;
                    tags.push('#' + txt.replace(/\s+/g, ''));
                });
                document.querySelectorAll('input[name="visit_times[]"]:checked').forEach(el => {
                    const txt = el.closest('label').querySelector('span').innerText;
                    tags.push('#' + txt.replace(/\s+/g, ''));
                });
                document.querySelectorAll('input[name="transportations[]"]:checked').forEach(el => {
                    const txt = el.closest('label').querySelector('span').innerText;
                    tags.push('#' + txt.replace(/\s+/g, ''));
                });

                if (tags.length > 0) {
                    previewBox.innerHTML = tags.map(tag => `<span class="bg-[#F4F7FE] text-[#3F5C7D] px-2.5 py-1 rounded-lg text-xs font-bold border border-indigo-100/10 shadow-sm">${tag}</span>`).join('');
                } else {
                    previewBox.innerHTML = '<span class="text-slate-400 font-semibold text-xs italic">Tag otomatis terkumpul di sini...</span>';
                }
            }

            // Watch for checkbox changes
            document.querySelectorAll('input[type="checkbox"]').forEach(el => {
                el.addEventListener('change', collectTags);
            });

            // Watch for custom select value changes
            // Since hidden inputs are updated by Alpine, we can watch the hidden input value changes using a mutation observer or just polling
            setInterval(collectTags, 800); // Polling is simple and reliable for watching hidden inputs changed by Alpine
        });
    </script>
</x-app-layout>
