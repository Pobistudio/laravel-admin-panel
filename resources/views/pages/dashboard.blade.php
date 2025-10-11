@extends('layouts.app')
@section('title', "Dashboard")
@section('page')
<div class="grid grid-cols-1 md:grid-cols-5">
    @foreach ($dashboardData as $item)
        <x-card :title="$item['title']" :value="$item['value']" :color="$item['color']"/>
    @endforeach
</div>
@endsection
