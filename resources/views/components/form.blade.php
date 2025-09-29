@php
    $classes = "flex gap-4 rounded-lg border border-slate-300 p-3";
@endphp
<form {{ $attributes->merge(['class' => "{$classes}"]) }}>
    @csrf
    {{ $slot }}
</form>
