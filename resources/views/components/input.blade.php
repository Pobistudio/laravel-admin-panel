@props(['name' => '', 'isPassword' => false, 'description' => '' ])
@php
    $classes = "p-3 w-full bg-slate-200 border border-slate-300 rounded-lg focus:outline-slate-400";
@endphp
<div class="flex flex-col gap-1 w-full">
    <div class="relative w-full">
        <input {{ $attributes->merge(['class' => "{$classes}" . ($isPassword ? ' pr-12' : ''), 'name' => $name]) }}>
        @if ($isPassword)
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                <i id="{{ $name }}_open_eye" onclick="togglePassword('{{ $name }}')" class="ri-eye-line text-slate-500 hover:text-slate-700 transition-colors"></i>
                <i id="{{ $name }}_close_eye" onclick="togglePassword('{{ $name }}')" class="ri-eye-close-line text-slate-500 hover:text-slate-700 transition-colors hidden"></i>
            </div>
        @endif
    </div>
    @if ($description)
        <x-input-description>{{ $description }}</x-input-description>
    @endif

    @if ($name)
        <x-error-validation name="{{ $name }}"/>
    @endif
</div>
