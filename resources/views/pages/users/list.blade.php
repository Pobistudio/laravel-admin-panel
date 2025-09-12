@extends('layouts.app')
@section('title', "Dashboard")
@section('page')
    <x-table :data="$dataTable" :routeButtonAdd="route('users-create')">
        <x-filter-table class="sm:w-1/2 w-full">
            <div class="flex sm:flex-row flex-col gap-3">
                <div class="flex flex-col gap-2">
                    <x-label id="label_start_date" for="email">Start Date</x-label>
                    <x-datepicker name="start_date" placeholder="Select start date" onchange="setMinDate(this)"/>
                </div>
                <div class="flex flex-col gap-2">
                    <x-label id="label_end_date" for="email">End Date</x-label>
                    <x-datepicker name="end_date" placeholder="Select end date"/>
                </div>
            </div>
        </x-filter-table>
    </x-table>
@endsection
@push('scripts')
<script>
    function setMinDate(e) {
        const startDateString = e.value;
        const startDate = new Date(startDateString + 'T00:00:00');
        startDate.setDate(startDate.getDate() + 1);
        const endDate   = document.getElementById('end_date');
        flatpickr(endDate, {
    minDate: startDate
});

    }
</script>
@endpush
