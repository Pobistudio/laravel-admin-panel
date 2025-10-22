@extends('layouts.app')
@section('title', "Change User Role")
@section('page')
<x-form x-data="{ open: false}" method="POST" action="{{ route('users-change-role', ['id' => $response->id]) }}" class="sm:w-1/2 w-full" :border="true" :actionBack="route('users')">
    <x-label id="label_name" for="name">Name</x-label>
    <x-input type="text" id="name" name="name" value="{{ $response->name }}" disabled/>
    <x-label id="label_email" for="email">Email</x-label>
    <x-input type="email" id="email" name="email" autocomplete="email" value="{{ $response->email }}" disabled/>
    <x-label id="label_role" for="role">Role</x-label>
    <x-select name="role"  :options="$listRoles" value="{{ old('role') }}"/>
    <div class="flex justify-end w-full">
        <x-button x-on:click="open = true" type="submit" class="flex items-center justify-center">
            <x-loader-button x-show="open"/>
            Change Role
        </x-button>
    </div>
</x-form>
@endsection
