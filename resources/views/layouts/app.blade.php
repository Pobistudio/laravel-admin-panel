@extends('layouts.base')
@section('content')
    <div class="flex flex-row bg-lap-white p-4 h-screen gap-4">
        @include('components.app.sidebar.index')
        @include('components.app.main.index')
    </div>
@endsection
