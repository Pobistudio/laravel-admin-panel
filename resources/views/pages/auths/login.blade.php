@extends('layouts.guest')
@section('title', "Login")
@section('page')
    <div class="flex flex-col sm:flex-row gap-2 w-10/12 min-h-10/12 justify-center bg-lap-cream rounded-4xl">
        <div class="hidden sm:flex flex-col w-1/2 bg-linear-to-bl from-slate-200 to-slate-100 rounded-tl-4xl rounded-bl-4xl p-10 gap-4">
            <div class="flex flex-row gap-2 items-center">
                <x-logo/>
                <x-brand/>
            </div>
            <span class="font-semibold text-5xl sm:text-4xl text-lap-dark text-start w-2/3 pt-7">{{ config('app.desc') }}</span>
            <div class="flex w-full h-full items-center justify-center">
                <img src="{{ asset('assets/images/illustration_login.svg') }}" alt="Login illustration" class="bg-lap-cream rounded-2xl p-2 drop-shadow-sm w-auto" />
            </div>
        </div>
        <div class="flex flex-col w-full sm:w-1/2 p-10 sm:p-5 items-center justify-center">
            <x-form x-data="{ open: false}" method="POST" action="{{ route('login') }}" class="flex-col w-full lg:w-1/2">
                <x-form-title>Welcom to {{ config('app.name') }}</x-form-title>
                <x-label id="label_email" for="email">Email</x-label>
                <x-input type="email" id="email" name="email" autocomplete="email" value="{{ old('email') }}"/>
                <x-label id="label_password" for="password">Password</x-label>
                <x-input id="password" name="password" class="w-full" :isPassword="true"/>
                <x-link href="{{ route('auth-forgot-password') }}" class="text-end w-full">Forgot password?</x-link>
                <x-button x-on:click="open = true" type="submit" class="flex items-center justify-center">
                    <x-loader-button x-show="open"/>
                    Log In
                </x-button>
                <x-copyright/>
            </x-form>
        </div>
    </div>
@endsection
