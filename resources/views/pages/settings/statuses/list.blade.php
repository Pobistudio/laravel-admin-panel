@extends('layouts.app')
@section('title', "Statuses")
@section('page')
    <x-table :data="$dataTable" :routeButtonAdd="route('statuses-create')"/>
@endsection
