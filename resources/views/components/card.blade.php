@props(['title', 'value', 'color' => 'bg-white'])

@php
    $classes = "flex flex-col $color drop-shadow-xl rounded-xl gap-3 p-5 items-center justify-center";
@endphp

<div {{ $attributes->merge(['class' => "{$classes}"]) }}>
    <span class="font-normal text-slate-400 text-lg">{{ $title }}</span>
    <span class="font-bold text-lap-dark text-3xl">{{ $value }}</span>
</div>
