<div x-data="{
    open: false,
    selected: {{ isset($multiple) && $multiple ? 'JSON.parse(\'' . json_encode(old($attributes->get('name'), $selected ?? [])) . '\')' : '\'' . (old($attributes->get('name')) ?? $selected ?? '') . '\'' }},
    filter: '',
    defaultOption: '{{ $placeholder ?? 'Pilih opsi...' }}',
    multiple: {{ isset($multiple) && $multiple ? 'true' : 'false' }},
    options: {{ json_encode($options) }},
    get selectedLabel() {
        if (this.multiple) {
            if (!Array.isArray(this.selected) || this.selected.length === 0) {
                return this.defaultOption;
            }
            return this.selected.length + ' item terpilih';
        } else {
            let option = this.options.find(o => o.value == this.selected);
            return option ? option.label : this.defaultOption;
        }
    },
    get selectedItems() {
        if (!this.multiple || !Array.isArray(this.selected)) return [];
        return this.selected.map(val => {
            let option = this.options.find(o => o.value == val);
            return option ? { value: val, label: option.label } : null;
        }).filter(item => item !== null);
    },
    toggleOption(value) {
        if (this.multiple) {
            if (!Array.isArray(this.selected)) {
                this.selected = [];
            }
            let index = this.selected.indexOf(value);
            if (index > -1) {
                this.selected.splice(index, 1);
            } else {
                this.selected.push(value);
            }
        } else {
            this.selected = value;
            this.open = false;
        }
        this.filter = '';
    },
    removeItem(value) {
        if (this.multiple && Array.isArray(this.selected)) {
            let index = this.selected.indexOf(value);
            if (index > -1) {
                this.selected.splice(index, 1);
            }
        }
    },
    isSelected(value) {
        if (this.multiple) {
            return Array.isArray(this.selected) && this.selected.includes(value);
        }
        return this.selected == value;
    }
    }"
    @click.away="open = false" class="relative w-full">

    <!-- Main trigger button -->
    <div @click="open = !open" class="flex items-center justify-between p-3 w-full bg-slate-200 border border-slate-300 rounded-lg focus:outline-slate-400 cursor-pointer hover:border-slate-500 min-h-[48px]">
        <div class="flex-1 min-w-0">
            <template x-if="!multiple || selectedItems.length === 0">
                <span x-text="selectedLabel" class="text-gray-700 truncate"></span>
            </template>

            <!-- Badges for multiple select -->
            <template x-if="multiple && selectedItems.length > 0">
                <div class="flex flex-wrap gap-1.5 -m-1">
                    <template x-for="item in selectedItems" :key="item.value">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-md border border-blue-200">
                            <span x-text="item.label" class="max-w-[150px] truncate"></span>
                            <button @click.stop="removeItem(item.value)" type="button" class="hover:bg-blue-200 rounded-full p-0.5 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </span>
                    </template>
                </div>
            </template>
        </div>

        <svg class="w-4 h-4 text-gray-400 transform transition-transform duration-200 flex-shrink-0 ml-2"
             :class="{ 'rotate-180': open }"
             fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>

    <!-- Hidden inputs -->
    <template x-if="multiple">
        <div>
            <template x-for="(val, index) in selected" :key="index">
                <input type="hidden" :name="'{{ $attributes->get('name') }}[]'" :value="val">
            </template>
        </div>
    </template>
    <template x-if="!multiple">
        <input type="hidden" id="{{ $attributes->get('name') }}" name="{{ $attributes->get('name') }}" :value="selected">
    </template>

    <!-- Dropdown -->
    <div x-show="open" x-cloak class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">

        <div class="sticky top-0 p-2 bg-white border-b border-gray-300">
            <input type="text" x-model="filter" @input="open = true" class="w-full px-2 py-1 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Cari...">
        </div>

        <ul class="py-1">
            <template x-for="option in options.filter(o => o.label.toLowerCase().includes(filter.toLowerCase()))" :key="option.value">
                <li @click="toggleOption(option.value)"
                    :class="{ 'bg-blue-50 text-blue-700': isSelected(option.value) }"
                    class="px-4 py-2 cursor-pointer hover:bg-gray-100 flex items-center justify-between transition-colors">
                    <span x-text="option.label"></span>
                    <template x-if="multiple && isSelected(option.value)">
                        <svg class="w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </template>
                </li>
            </template>
        </ul>

    </div>
</div>
