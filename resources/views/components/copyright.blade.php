@php
    $classes = "text-lap-navy text-center w-full pt-16";
@endphp
<small {{ $attributes->merge(['class' => "{$classes}"]) }}>&copy;{{ date('Y').' '.config('app.name') }} </small>
