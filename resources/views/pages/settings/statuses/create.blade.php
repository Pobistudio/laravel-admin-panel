@extends('layouts.app')
@section('title', "Create Status")
@section('page')
<x-form x-data="{ open: false}" method="POST" action="{{ route('statuses-create') }}" class="sm:w-1/2 w-full" :border="true" :actionBack="route('users')">
    <x-label id="label_name" for="email">Name</x-label>
    <x-input type="text" id="name" name="name" value="{{ old('name') }}"/>
    <div class="flex justify-end w-full">
        <x-button x-on:click="open = true" type="submit" class="flex items-center justify-center">
            <x-loader-button x-show="open"/>
            Create
        </x-button>
    </div>
</x-form>
@endsection
