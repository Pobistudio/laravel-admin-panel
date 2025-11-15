@extends('layouts.app')
@section('title', "Profile")
@section('page_title', "Hello ".$name)
@section('page')
<div class="flex sm:flex-row flex-col gap-10">
    <x-form x-data="{ open: false}" method="POST" action="{{ route('users-create') }}" class="sm:w-1/2 w-full pt-8" :border="true">
        <x-label id="label_name" for="name">Name</x-label>
        <x-input type="text" id="name" name="name" value="{{ $user->name }}"/>
        <x-label id="label_email" for="email">Email</x-label>
        <x-input type="email" id="email" name="email" autocomplete="email" value="{{ $user->email }}"/>
        <div class="flex justify-end w-full">
            <x-button x-on:click="open = true" type="submit" class="flex items-center justify-center">
                <x-loader-button x-show="open"/>
                Update
            </x-button>
        </div>
    </x-form>
    <x-form x-data="{ open: false}" method="POST" action="{{ route('users-create') }}" class="sm:w-1/2 w-full pt-8" :border="true">
        <x-label id="label_new_password" for="new_password">New Password</x-label>
        <x-input type="password" id="new_password" name="new_password" :isPassword="true"/>
        <x-label id="label_confirm_password" for="confirm_password">Confirm Password</x-label>
        <x-input type="password" id="confirm_password" name="confirm_password" :isPassword="true"/>
        <div class="flex justify-end w-full">
            <x-button x-on:click="open = true" type="submit" class="flex items-center justify-center">
                <x-loader-button x-show="open"/>
                Change Password
            </x-button>
        </div>
    </x-form>
</div>
@endsection
