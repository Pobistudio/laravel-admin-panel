@extends('layouts.app')
@section('title', "Dashboard")
@section('page')
    <x-table :data="$dataTable" :routeButtonAdd="route('users-create')">
        filter
    </x-table>
@endsection
