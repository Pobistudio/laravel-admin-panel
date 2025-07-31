
@php
    $classes = "p-3 bg-slate-500 text-white text-lg font-medium rounded-lg drop-shadow-lg cursor-pointer hover:bg-lap-dark hover:drop-shadow-2xl transition-all delay-150";
@endphp
<button {{ $attributes->merge(['class' => "{$classes}"]) }}>{{ $slot }}</button>
