@php
    $classes = "text-slate-800 text-sm font-semibold sm:font-medium";
@endphp
<a {{ $attributes->merge(['class' => "{$classes}"]) }}>{{ $slot }}</a>
