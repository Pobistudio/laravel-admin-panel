@extends('layouts.app')
@section('title', "Menus")
@section('page')
    @section('additional_table_button')
        <a href="#" class="p-3 bg-teal-500 text-white text-sm font-normal rounded-lg hover:bg-teal-700 hover:drop-shadow-2xl transition-all delay-150 cursor-pointer">Assign Permission</a>
    @endsection
    <x-table :data="$dataTable" :routeButtonAdd="route('permissions-create')"/>
@endsection
