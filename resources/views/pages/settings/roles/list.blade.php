@extends('layouts.app')
@section('title', "Roles")
@section('page')
    <x-table :data="$dataTable" :routeButtonAdd="route('roles-create')"/>
@endsection
