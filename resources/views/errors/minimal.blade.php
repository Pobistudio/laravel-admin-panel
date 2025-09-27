@extends('layouts.base')
@section('content')
<div class="flex min-h-screen min-w-screen items-center justify-center bg-lap-dark">
    <div class="flex flex-col gap-4 items-center">
        <img src="{{ asset('assets/images/illustration_errors.svg') }}" alt="Error" class="rounded-full bg-lap-navy p-2 drop-shadow-sm w-[500px]" />
        <div class="flex flex-col p-4 items-center">
            <div class="text-lg text-lap-cream tracking-wider">
                @yield('code')
            </div>

            <div class="text-lg text-lap-cream uppercase tracking-wider">
                @yield('message')
            </div>
        </div>
        <a href="{{ url()->previous()}}" class="bg-lap-cream text-lap-navy px-4 py-3 rounded-lg hover:drop-shadow-2xl">Go Back</a>
    </div>
</div>
@endsection
