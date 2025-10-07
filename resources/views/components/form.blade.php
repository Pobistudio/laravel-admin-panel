@props(['border' => false, 'actionBack' => null])
@php
    $borderClasses = "";

    if ($border) {
        $borderClasses = "rounded-lg border border-slate-300 p-3";
    }

    $classes = "flex flex-col gap-4 " . $borderClasses;
@endphp
<form {{ $attributes->merge(['class' => "{$classes}"]) }}>
    @if ($actionBack)
        <x-form-button-back action="{{ $actionBack }}"/>
    @endif
    @csrf
    {{ $slot }}
</form>
