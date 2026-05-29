@props([
    'name',
    'value' => null,
    'options' => [],
    'placeholder' => 'Pilih opsi...',
    'dependsOn' => null
])

@php
    $selectedLabel = $placeholder;
    if ($value !== null && $value !== '') {
        if (is_array($options) && count($options) > 0 && is_array(reset($options))) {
            foreach ($options as $opt) {
                if (isset($opt['value']) && $opt['value'] == $value) {
                    $selectedLabel = $opt['label'];
                    break;
                }
            }
        } else {
            $selectedLabel = $options[$value] ?? $placeholder;
        }
    }
@endphp

<div x-data="{ 
        open: false, 
        name: '{{ $name }}',
        selected: '{{ $value ?? '' }}',
        selectedLabel: '{{ $selectedLabel }}',
        rawOptions: @js($options),
        optionsList: [],
        search: '',
        dependsOn: '{{ $dependsOn ?? '' }}',
        parentValue: '',
        init() {
            if (Array.isArray(this.rawOptions)) {
                if (this.rawOptions.length > 0 && typeof this.rawOptions[0] === 'object' && this.rawOptions[0] !== null) {
                    this.optionsList = this.rawOptions.map(item => ({
                        value: item.value.toString(),
                        label: item.label,
                        category_id: item.category_id ? item.category_id.toString() : null
                    }));
                } else {
                    this.optionsList = this.rawOptions.map((label, idx) => ({ value: idx.toString(), label: label }));
                }
            } else {
                this.optionsList = Object.keys(this.rawOptions).map(key => ({ value: key, label: this.rawOptions[key] }));
            }

            if (this.dependsOn) {
                this.$nextTick(() => {
                    let parentEl = document.querySelector('input[name=\'' + this.dependsOn + '\']');
                    if (parentEl) {
                        let parentComponent = parentEl.closest('[x-data]');
                        if (parentComponent && window.Alpine) {
                            this.parentValue = window.Alpine.$data(parentComponent).selected;
                        } else {
                            this.parentValue = parentEl.value;
                        }
                    }
                });
            }
        },
        select(val, label) {
            this.selected = val;
            this.selectedLabel = label;
            this.open = false;
            this.search = '';
            this.$dispatch('select-changed-' + this.name, { value: val });
        },
        filteredOptions() {
            let list = this.optionsList;
            if (this.dependsOn) {
                list = list.filter(item => item.category_id === this.parentValue);
            }
            if (!this.search) {
                return list;
            }
            let searchLower = this.search.toLowerCase();
            return list.filter(item => item.label.toLowerCase().includes(searchLower));
        },
        handleDependsChanged(newParentValue) {
            this.parentValue = newParentValue ? newParentValue.toString() : '';
            // Check if the current selected option belongs to the new parent. If not, reset it.
            let currentSelectedOption = this.optionsList.find(item => item.value === this.selected);
            if (!currentSelectedOption || currentSelectedOption.category_id !== this.parentValue) {
                this.selected = '';
                this.selectedLabel = '{{ $placeholder }}';
            }
        }
     }" 
     class="relative w-full"
     @click.outside="open = false; search = ''"
     @if($dependsOn)
        x-on:select-changed-{{ $dependsOn }}.window="handleDependsChanged($event.detail.value)"
     @endif>
     
    <!-- Hidden Input for Form Submission -->
    <input type="hidden" name="{{ $name }}" :value="selected">

    <!-- Trigger Button -->
    <button type="button" 
            @click="open = !open"
            class="w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold flex items-center justify-between cursor-pointer text-left">
        <span x-text="selectedLabel"></span>
        <span class="text-[#3F5C7D] transition-transform duration-200" :class="open ? 'rotate-180' : ''">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        </span>
    </button>

    <!-- Dropdown List -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
         class="absolute z-50 mt-2 w-full bg-white rounded-2xl border border-indigo-100/30 shadow-xl shadow-indigo-100/10 overflow-hidden flex flex-col py-1.5"
         style="display: none;">
         
        <!-- Search Field (Only show when options length is greater than 3) -->
        <div x-show="optionsList.length > 3" class="px-3 pb-2 pt-1 border-b border-slate-100">
            <input type="text" 
                   x-model="search" 
                   placeholder="Cari..." 
                   class="w-full px-4 py-2 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none text-xs font-semibold"
                   @click.stop>
        </div>

        <!-- Scrollable Options Container -->
        <div class="max-h-40 overflow-y-auto flex-1 mt-1.5">
            <template x-for="item in filteredOptions()" :key="item.value">
                <button type="button"
                        @click="select(item.value, item.label)"
                        class="w-full px-5 py-3 text-left text-sm font-semibold transition-colors duration-150 flex items-center justify-between"
                        :class="selected == item.value ? 'text-[#3F5C7D] bg-[#3F5C7D]/10' : 'text-slate-600 hover:bg-[#F4F7FE] hover:text-[#2B3674]'">
                    <span x-text="item.label"></span>
                    <template x-if="selected == item.value">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4 text-[#3F5C7D]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </template>
                </button>
            </template>

            <!-- Empty Search State -->
            <div x-show="filteredOptions().length === 0" class="px-5 py-4 text-center text-xs text-slate-400 font-bold">
                Opsi tidak ditemukan
            </div>
        </div>
    </div>
</div>
