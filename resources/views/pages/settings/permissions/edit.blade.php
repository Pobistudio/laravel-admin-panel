@extends('layouts.app')
@section('title', "Edit Permission")
@section('page')
<x-form x-data="{ open: false}" method="POST" action="{{ route('permissions-edit', ['id' => $response->id]) }}" class="sm:w-1/2 w-full" :border="true" :actionBack="route('permissions')">
    <x-label id="label_name" for="name">Name</x-label>
    <x-input type="text" id="name" name="name" value="{{ $response->name }}"/>
    <div class="flex justify-end w-full">
        <x-button x-on:click="open = true" type="submit" class="flex items-center justify-center">
            <x-loader-button x-show="open"/>
            Update
        </x-button>
    </div>
</x-form>
@endsection
