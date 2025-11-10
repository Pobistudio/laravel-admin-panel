@extends('layouts.app')
@section('title', "Assign Menu Permissions")
@section('page')

<x-form x-data="{ open: false}" method="POST" action="{{ route('assign-menu-permissions') }}" class="sm:w-1/2 w-full" :border="true" :actionBack="route('users')">
    <x-label id="label_role" for="role">Role</x-label>
    <x-select name="role"  :options="$roles" value="{{ old('role') }}" onchange="onchangeRoleSelect()"/>
</x-form>
@endsection
@push('scripts')
<script>
function onchangeRoleSelect() {
    const role = document.getElementById('role');
    console.log(role.value);

}
</script>
@endpush
