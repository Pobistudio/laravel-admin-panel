<div class="flex flex-col gap-1 w-full">
    <div class="relative w-full" data-select-component
        data-name="{{ $attributes->get('name') }}"
        data-multiple="{{ isset($multiple) && $multiple ? 'true' : 'false' }}"
        data-placeholder="{{ $placeholder ?? 'Pilih opsi...' }}"
        data-options='@json($options)'
        data-selected='@json(old($attributes->get("name"), $selected ?? (isset($multiple) && $multiple ? [] : "")))'>

    <!-- Main trigger button -->
        <div class="select-trigger flex items-center justify-between p-3 w-full bg-slate-200 border border-slate-300 rounded-lg focus:outline-slate-400 cursor-pointer hover:border-slate-500 min-h-[48px]">
            <div class="flex-1 min-w-0">
                <span class="select-label text-gray-700 truncate"></span>
                <div class="select-badges flex-wrap gap-1.5 -m-1 hidden"></div>
            </div>

            <svg class="select-arrow w-4 h-4 text-gray-400 transform transition-transform duration-200 flex-shrink-0 ml-2"
                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>

        <!-- Hidden inputs container -->
        <div class="hidden-inputs"></div>

        <!-- Dropdown -->
        <div class="select-dropdown absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto hidden">
            <div class="sticky top-0 p-2 bg-white border-b border-gray-300">
                <input type="text" class="select-filter w-full px-2 py-1 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Cari...">
            </div>

            <ul class="select-options py-1"></ul>
        </div>
    </div>
    @if ($attributes->get('description'))
        <x-input-description>{{ $attributes->get('description') }}</x-input-description>
    @endif

    @if ($attributes->get('name'))
        <x-error-validation name="{{ $attributes->get('name') }}"/>
    @endif
</div>

