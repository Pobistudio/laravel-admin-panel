@props(['action', 'grid' => 3])
@php

    $gridClass = match ($grid) {
        1 => 'sm:grid-cols-1',
        2 => 'sm:grid-cols-2',
        3 => 'sm:grid-cols-3',
        4 => 'sm:grid-cols-4',
        5 => 'sm:grid-cols-5',
        6 => 'sm:grid-cols-6',
        default => 'sm:grid-cols-1',
    };

    $baseGridClass = 'grid grid-cols-1 gap-3 ' . $gridClass;
@endphp
<div {{ $attributes->merge(['class' => 'flex flex-col gap-2 p-3']) }}>
    <span class="text-lap-dark font-normal text-base sm:text-sm">Filter</span>
    <x-form method="POST" action="{{ $action }}" :border="true">
        <div class="{{ $baseGridClass }}">
            {{ $slot }}
        </div>
        <div class="flex w-full justify-end">
            <x-button type="submit" class="bg-teal-500 hover:bg-teal-700 px-5 text-sm font-normal">Filter</x-button>
        </div>
    </x-form>
</div>
