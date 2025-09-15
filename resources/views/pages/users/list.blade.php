@extends('layouts.app')
@section('title', "Dashboard")
@section('page')
    <x-table :data="$dataTable" :routeButtonAdd="route('users-create')">
        <x-filter-table class="sm:w-2/3 w-full">
            <x-form method="POST" action="{{ route('users') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="flex flex-col gap-2">
                    <x-label id="label_start_date" for="start_date">Start Date</x-label>
                    <x-datepicker name="start_date" :value="$startDate" placeholder="Select start date" onchange="setRangeMinMaxDate(this, 30, 'end_date')"/>
                </div>
                <div class="flex flex-col gap-2">
                    <x-label id="label_end_date" for="end_date">End Date</x-label>
                    <x-datepicker name="end_date" :value="$endDate" placeholder="Select end date"/>
                </div>
                <div class="flex flex-col gap-2">
                    <x-label id="label_role" for="role">End Date</x-label>
                    <x-select name="role" class="w-[400px]" :options="[
                        ['value' => 'admin', 'label' => 'Admin'],
                        ['value' => 'superadmin', 'label' => 'Super Admin'],
                    ]"/>
                </div>
                <div class="flex">
                    <x-button type="submit" class="bg-teal-500 hover:bg-teal-700 px-6 h-[50px]">Filter</x-button>
                </div>
            </x-form>
        </x-filter-table>
    </x-table>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDate = document.getElementById('start_date');
        setRangeMinMaxDate(startDate, 30, 'end_date');
    });
</script>
@endpush
