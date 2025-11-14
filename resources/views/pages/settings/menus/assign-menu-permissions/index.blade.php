@extends('layouts.app')
@section('title', "Assign Menu Permissions")
@section('page')

<x-form id="form-assign-menu-permissions" x-data="{ open: false}" method="POST" action="{{ route('assign-menu-permissions') }}" class="w-full" :border="true" :actionBack="route('users')">
    <x-label id="label_role" for="role">Role</x-label>
    <x-select name="role"  :options="$roles" value="{{ old('role') }}"/>
    <div id="menu-permissions-table" class="mt-4">
    </div>
    <div class="flex justify-end w-full">
        <x-button x-on:click="open = true" type="submit" class="flex items-center justify-center">
            <x-loader-button x-show="open"/>
            Assigned
        </x-button>
    </div>
</x-form>
@endsection
@push('scripts')
