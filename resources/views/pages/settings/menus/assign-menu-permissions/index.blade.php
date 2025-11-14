@extends('layouts.app')
@section('title', "Assign Menu Permissions")
@section('page')

<x-form id="form-assign-menu-permissions" x-data="{ open: false}" method="POST" action="{{ route('assign-menu-permissions') }}" class="sm:w-1/2 w-full" :border="true" :actionBack="route('users')">
    <x-label id="label_role" for="role">Role</x-label>
    <x-select name="role"  :options="$roles" value="{{ old('role') }}"/>
</x-form>
@endsection
@push('scripts')
