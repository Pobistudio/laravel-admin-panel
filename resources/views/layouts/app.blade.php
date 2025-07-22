@extends('layouts.base')
@section('content')
    <div class="flex flex-row bg-white h-screen gap-1">
        @include('components.app.sidebar.index')
        @include('components.app.main.index')
    </div>
@endsection
