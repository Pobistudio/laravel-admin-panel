@extends('layouts.app')
@section('title', "Dashboard")
@section('page')
    <x-table :data="$dataTable" :routeButtonAdd="route('users-create')">
        <x-filter-table class="sm:w-1/2 w-full">
            <x-form method="POST" action="{{ route('users') }}" class="flex sm:flex-row flex-col gap-3">
                <div class="flex flex-col gap-2">
                    <x-label id="label_start_date" for="email">Start Date</x-label>
                    <x-datepicker name="start_date" placeholder="Select start date" onchange="setRangeMinMaxDate(this, 30, 'end_date')"/>
                </div>
                <div class="flex flex-col gap-2">
                    <x-label id="label_end_date" for="email">End Date</x-label>
                    <x-datepicker name="end_date" placeholder="Select end date"/>
                </div>
                <div class="flex items-end">
                    <x-button type="submit" class="bg-teal-500 hover:bg-teal-700 px-6 h-[50px]">Filter</x-button>
                </div>
            </x-form>
        </x-filter-table>
    </x-table>
@endsection
