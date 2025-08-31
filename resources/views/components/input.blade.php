@props(['name' => '', 'isPassword' => false ])
@php
    $classes = "p-3 w-full bg-slate-200 border border-slate-300 rounded-lg focus:outline-slate-400";
@endphp
<div class="flex flex-col gap-1 w-full">
    <div class="flex flex-row gap-1">
        <input {{ $attributes->merge(['class' => "{$classes}", 'name' => $name]) }}>
        @if ($isPassword)
            <div class="flex w-[10%] items-center justify-center cursor-pointer">
                <i id="{{ $name }}_open_eye" onclick="togglePassword('{{ $name }}')" class="ri-eye-line"></i>
                <i id="{{ $name }}_close_eye" onclick="togglePassword('{{ $name }}')" class="ri-eye-close-line hidden"></i>
            </div>
        @endif
    </div>
    @if ($name)
        <x-error-validation name="{{ $name }}"/>
    @endif
</div>
