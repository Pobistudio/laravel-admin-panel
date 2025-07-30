@extends('layouts.base')
@section('content')
    <div class="flex bg-linear-to-bl from-slate-200 to-slate-300 w-screen h-screen overflow-auto hide-scrollbar items-center justify-center">
        @yield('page')
    </div>
@endsection
