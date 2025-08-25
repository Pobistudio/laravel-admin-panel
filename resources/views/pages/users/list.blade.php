@extends('layouts.app')
@section('title', "Dashboard")
@section('page')
    {{ $dataTable->table() }}
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
