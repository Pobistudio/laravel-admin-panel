@props(['name' => ''])
@php
    $classes = "p-3 bg-slate-200 border border-slate-300 rounded-lg focus:outline-slate-400";
@endphp
<div class="flex flex-col gap-1">
    <input {{ $attributes->merge(['class' => "{$classes}", 'name' => $name]) }}>
    @if ($name)
        <x-error-validation name="{{ $name }}"/>
    @endif
</div>
