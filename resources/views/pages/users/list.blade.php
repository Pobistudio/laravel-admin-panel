@extends('layouts.app')
@section('title', "Dashboard")
@section('page')
    <x-table :data="$dataTable" :routeButtonAdd="route('users-create')">
        <x-filter-table class="sm:w-2/3 w-full">
            <x-form method="POST" action="{{ route('users') }}" class="flex sm:flex-row flex-col gap-3">
                <div class="flex flex-col gap-2">
                    <x-label id="label_start_date" for="start_date">Start Date</x-label>
                    <x-datepicker name="start_date" placeholder="Select start date" onchange="setRangeMinMaxDate(this, 30, 'end_date')"/>
                </div>
                <div class="flex flex-col gap-2">
                    <x-label id="label_end_date" for="end_date">End Date</x-label>
                    <x-datepicker name="end_date" placeholder="Select end date"/>
                </div>
                <div class="flex flex-col gap-2">
                    <x-label id="label_role" for="role">End Date</x-label>
                    <select name="role" id="role" data-select="true" class="w-[400px] mt-1 block border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="1">admin</option>
                        <option value="2">super admin</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <x-button type="submit" class="bg-teal-500 hover:bg-teal-700 px-6 h-[50px]">Filter</x-button>
                </div>
            </x-form>
        </x-filter-table>
    </x-table>
@endsection
