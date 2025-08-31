@extends('layouts.guest')
@section('title', "Forgot Password")
@section('page')
    <div class="flex flex-col sm:flex-row gap-2 w-10/12 min-h-10/12 justify-center bg-lap-cream rounded-4xl">
        <div class="hidden sm:flex flex-col w-1/2 bg-linear-to-bl from-slate-200 to-slate-100 rounded-tl-4xl rounded-bl-4xl p-10 gap-4">
            <div class="flex flex-row gap-2 items-center">
                <x-logo/>
                <x-brand/>
            </div>
            <span class="font-semibold text-5xl sm:text-4xl text-lap-dark text-start w-2/3 pt-7">{{ config('app.desc') }}</span>
            <div class="flex w-full h-full items-center justify-center">
                <img src="{{ asset('assets/images/illustration_forgot_password.svg') }}" alt="Forgot password illustration" class="bg-lap-cream rounded-2xl p-2 drop-shadow-sm w-[500px]" />
            </div>
        </div>
        <div class="flex flex-col w-full sm:w-1/2 p-10 sm:p-5 items-center justify-center">
            <x-form method="POST" action="{{ route('auth-forgot-password') }}" class="flex-col w-full lg:w-1/2">
                <x-form-title>Forgot Password ?</x-form-title>
                <x-label for="email">Email</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}"/>
                <x-label for="new_password">New Password</x-label>
                <x-input type="password" id="new_password" name="new_password" value="{{ old('new_password') }}" :isPassword="true"/>
                <x-label for="confirm_password">Confirm Password</x-label>
                <x-input type="password" id="confirm_password" name="confirm_password" :isPassword="true"/>
                <x-button type="submit">Change Password</x-button>
                <x-link href="{{ route('login') }}" class="text-center w-full">Back to Login</x-link>
                <x-copyright/>
            </x-form>
        </div>
    </div>
@endsection
