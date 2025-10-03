@extends('layouts.base')
@section('content')
    <div class="flex flex-row bg-white min-h-screen gap-1">
        <x-app.sidebar/>
        @include('components.app.main.index')
    </div>
@endsection
