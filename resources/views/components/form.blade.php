@php
    $classes = "flex gap-4";
@endphp
<form {{ $attributes->merge(['class' => "{$classes}"]) }}>
    @csrf
    {{ $slot }}
</form>
