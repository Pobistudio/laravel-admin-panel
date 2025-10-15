@extends('layouts.app')
@section('title', "Permissions")
@section('page')
    <x-table :data="$dataTable" :routeButtonAdd="route('permissions-create')"/>
@endsection
