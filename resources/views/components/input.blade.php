@php
    $classes = "p-3 bg-slate-200 border border-slate-300 rounded-lg focus:outline-slate-400";
@endphp
<input {{ $attributes->merge(['class' => "{$classes}"]) }}>
