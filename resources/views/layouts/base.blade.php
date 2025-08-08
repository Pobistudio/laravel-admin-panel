<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.svg') }}" type="image/x-icon">
    <title>
        @if(View::hasSection('title'))
            @yield('title') | {{ config('app.name')}}
        @else
            {{ config('app.name') }}
        @endif
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins">
    <x-alert/>
    @yield('content')
    <x-dialog.dialog/>
    @stack('scripts')
</body>
</html>
