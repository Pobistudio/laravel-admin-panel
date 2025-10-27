@props([
    'title' => 'Click to expand',
    'id' => 'collapse-' . uniqid(),
    'icon' => true,
    'variant' => 'default', // default, primary, gradient, bordered
    'open' => false
])

@php
    $variants = [
        'default' => 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-900',
        'primary' => 'bg-blue-500 hover:bg-blue-600 text-white shadow-lg shadow-blue-500/30',
        'gradient' => 'bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white shadow-lg shadow-purple-500/30',
        'bordered' => 'bg-transparent border border-slate-300 text-gray-900'
    ];

    $buttonClass = $variants[$variant] ?? $variants['default'];
@endphp

<div class="w-full" x-data="{ open: {{ $open ? 'true' : 'false' }} }">
    {{-- Button Trigger --}}
    <button
        @click="open = !open"
        type="button"
        class="w-full flex items-center justify-between px-6 py-4 rounded-xl transition-all duration-300 ease-in-out transform hover:bg-slate-200 drop-shadow-md cursor-pointer {{ $buttonClass }}"
        :aria-expanded="open"
        aria-controls="{{ $id }}"
    >
        <span class="font-normal text-lg">{{ $title }}</span>

        @if($icon)
            <svg
                class="w-6 h-6 transition-transform duration-300 ease-in-out"
                :class="{ 'rotate-180': open }"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
            </svg>
        @endif
    </button>

    {{-- Content Area --}}
    <div
        x-show="open"
        x-collapse
        id="{{ $id }}"
        class="overflow-hidden"
    >
        <div class="mt-3 p-6 bg-transparent border border-slate-300 rounded-xl shadow-sm">
            {{ $slot }}
        </div>
    </div>
</div>
