@extends('layouts.app')
@section('title', "Create Menu")
@section('page')
<x-form x-data="{ open: false}" method="POST" action="{{ route('menus-create') }}" class="sm:w-1/2 w-full" :border="true" :actionBack="route('menus')">
    <x-label id="label_parent" for="parent">Parent</x-label>
    <x-select name="menu"  :options="$menus" value="{{ old('menu') }}" description="Pilih Default Parent untuk membuat Menu Parent"/>
    <x-label id="label_name" for="name">Name</x-label>
    <x-input type="text" id="name" name="name" value="{{ old('name') }}"/>
    <div class="flex flex-col sm:flex-row w-full gap-4">
        <div class="flex flex-col w-full sm:w-1/2 gap-4">
            <x-label id="label_link" for="link">Link</x-label>
            <x-input type="text" id="link" name="link" value="{{ old('link') }}" description="Default value '#'"/>
        </div>
        <div class="flex flex-col w-full sm:w-1/2 gap-4">
            <x-label id="label_link_alias" for="link_alias">Link alias</x-label>
            <x-input type="text" id="link_alias" name="link_alias" value="{{ old('link_alias') }}" description="Default value '#'"/>
        </div>
    </div>
    <div class="flex flex-col sm:flex-row w-full gap-4">
        <div class="flex flex-col w-full sm:w-1/2 gap-4">
            <x-label id="label_icon" for="icon">Icon</x-label>
            <x-input type="text" id="icon" name="icon" value="{{ old('icon') }}" description="Default value '#'"/>
        </div>
        <div class="flex flex-col w-full sm:w-1/2 gap-4">
            <x-label id="label_order" for="order">Order</x-label>
            <x-input type="text" id="order" name="order" value="{{ old('order') }}" description="Default value '0'"/>
        </div>
    </div>
    <div class="flex justify-end w-full">
        <x-button x-on:click="open = true" type="submit" class="flex items-center justify-center">
            <x-loader-button x-show="open"/>
            Create
        </x-button>
    </div>
</x-form>
@endsection
