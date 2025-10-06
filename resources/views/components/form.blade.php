@props(['border' => false, 'actionBack' => null])
@php
    $borderClasses = "";

    if ($border) {
        $borderClasses = "rounded-lg border border-slate-300 p-3";
    }

    $classes = "flex gap-4 " . $borderClasses;
@endphp
<div class="flex flex-col gap-2">
    @if ($actionBack)
        <x-form-button-back action="{{ $actionBack }}"/>
    @endif
    <form {{ $attributes->merge(['class' => "{$classes}"]) }}>
        @csrf
        {{ $slot }}
    </form>
</div>
