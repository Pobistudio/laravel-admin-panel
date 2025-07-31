@php
    $classes = "text-lap-dark font-normal text-base sm:text-sm";
@endphp
<label {{ $attributes->merge(['class' => "{$classes}"]) }}>
    {{ $slot }}
</label>
