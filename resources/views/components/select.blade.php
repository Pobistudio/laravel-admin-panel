
<div x-data="{
    open: false,
    selected: '{{ old($attributes->get('name')) ?? $selected ?? '' }}',
    filter: '',
    defaultOption: 'Pilih opsi...',
    options: {{ json_encode($options) }},
    get selectedLabel() {
        let option = this.options.find(o => o.value == this.selected);
        return option ? option.label : this.defaultOption;
    }
    }"
    @click.away="open = false" class="relative w-full">

    <div @click="open = !open" class="flex items-center justify-between p-3 w-full bg-slate-200 border border-slate-300 rounded-lg focus:outline-slate-400 cursor-pointer hover:border-slate-500">
        <span x-text="selectedLabel" class="text-gray-700 truncate"></span>
        <svg class="w-4 h-4 text-gray-400 transform transition-transform duration-200"
             :class="{ 'rotate-180': open }"
             fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>

    <input type="hidden" id="{{ $attributes->get('name') }}" name="{{ $attributes->get('name') }}" :value="selected">

    <div x-show="open" x-cloakn class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">

        <div class="sticky top-0 p-2 bg-white border-b border-gray-300">
            <input type="text" x-model="filter" @input="open = true" class="w-full px-2 py-1 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Cari...">
        </div>

        <ul class="py-1">
            <template x-for="option in options.filter(o => o.label.toLowerCase().includes(filter.toLowerCase()))" :key="option.value">
                <li @click="selected = option.value; open = false; filter = ''" :class="{ 'bg-blue-50 text-blue-700': selected == option.value }" class="px-4 py-2 cursor-pointer hover:bg-gray-100">
                    <span x-text="option.label"></span>
                </li>
            </template>
        </ul>

    </div>
</div>
