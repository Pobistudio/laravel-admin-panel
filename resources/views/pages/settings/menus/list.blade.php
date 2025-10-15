@extends('layouts.app')
@section('title', "Menus")
@section('page')
    <x-table :data="$dataTable" :routeButtonAdd="route('permissions-create')"/>
@endsection
