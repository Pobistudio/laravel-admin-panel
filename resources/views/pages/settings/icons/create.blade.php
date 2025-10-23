@extends('layouts.app')
@section('title', "Create Icon")
@section('page')
<x-form x-data="{ open: false, }" method="POST" action="{{ route('icons-create') }}" class="sm:w-1/2 w-full" :border="true" :actionBack="route('icons')">

    <div class="flex flex-row w-full gap-2">
        <div class="flex flex-col w-[70%] gap-4">
            <x-label id="label_name" for="name">Name</x-label>
            <x-input type="text" id="name" name="name" value="{{ old('name') }}"/>
        </div>
        <div class="flex flex-col w-[30%] gap-4">
            <x-label id="label_type" for="type">Type</x-label>
            <x-select id="type" name="type"  :options="$iconTypes" selected="line"/>
        </div>
    </div>

    <div id="preview_icon"></div>

    <div class="flex justify-end w-full">
        <x-button x-on:click="open = true" type="submit" class="flex items-center justify-center">
            <x-loader-button x-show="open"/>
            Create
        </x-button>
    </div>
</x-form>
@endsection
