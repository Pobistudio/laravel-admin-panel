@extends('layouts.app')
@section('title', "Create User")
@section('page')
<x-form x-data="{ open: false}" method="POST" action="{{ route('users-create') }}" class="flex-col sm:w-1/2 w-full" :border="true">
    <x-form-button-back action="{{ route('users') }}"/>
    <x-label id="label_name" for="email">Name</x-label>
    <x-input type="text" id="name" name="name" value="{{ old('name') }}"/>
    <x-label id="label_email" for="email">Email</x-label>
    <x-input type="email" id="email" name="email" autocomplete="email" value="{{ old('email') }}"/>
    <x-label id="label_password" for="password">Password</x-label>
    <x-input type="password" id="password" name="password" class="w-full" :isPassword="true"/>
    <div class="flex justify-end w-full">
        <x-button x-on:click="open = true" type="submit" class="flex items-center justify-center">
            <x-loader-button x-show="open"/>
            Create
        </x-button>
    </div>
</x-form>
@endsection
