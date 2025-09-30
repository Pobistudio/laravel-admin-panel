@props(['border' => false])
@php
    $borderClasses = "";

    if ($border) {
        $borderClasses = "rounded-lg border border-slate-300 p-3";
    }

    $classes = "flex gap-4 " . $borderClasses;
@endphp
<form {{ $attributes->merge(['class' => "{$classes}"]) }}>
    @csrf
    {{ $slot }}
</form>
