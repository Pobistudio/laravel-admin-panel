@extends('layouts.app')
@section('title', "Icons")
@section('page')
    <x-table :data="$dataTable" :routeButtonAdd="route('icons-create')"/>
@endsection
