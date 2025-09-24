@extends('layouts.app')
@section('title', "Users")
@section('page')
    <x-table :data="$dataTable" :routeButtonAdd="route('users-create')">
        <x-filter-table class="sm:w-2/3 w-full" :action="route('users')">
            <div class="flex flex-col gap-2">
                <x-label id="label_start_date" for="start_date">Start Date</x-label>
                <x-datepicker name="start_date" :value="$startDate" placeholder="Select start date" onchange="setRangeMinMaxDate(this, 30, 'end_date')"/>
            </div>
            <div class="flex flex-col gap-2">
                <x-label id="label_end_date" for="end_date">End Date</x-label>
                <x-datepicker name="end_date" :value="$endDate" placeholder="Select end date"/>
            </div>
            <div class="flex flex-col gap-2">
                <x-label id="label_role" for="role">Role</x-label>
                <x-select name="role"  :options="$listRoles"/>
            </div>
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
