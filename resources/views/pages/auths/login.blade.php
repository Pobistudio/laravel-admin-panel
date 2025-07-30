@extends('layouts.guest')
@section('title', "Login")
@section('page')
    <div class="flex flex-col sm:flex-row gap-2 w-10/12 min-h-10/12 justify-center bg-lap-cream rounded-2xl">
        <div class=" hidden sm:flex flex-col w-1/2 bg-linear-to-bl from-slate-200 to-slate-100 rounded-tl-2xl rounded-bl-2xl p-10 gap-4">
            <div class="flex flex-row gap-2 items-center">
                <x-logo/>
                <x-brand/>
            </div>
            <span class="font-semibold text-5xl sm:text-4xl text-lap-dark text-start w-2/3 pt-7">{{ config('app.desc') }}</span>
            <img src="{{ asset('assets/images/illustration_brainstorming.svg') }}" alt="Login illustration" class="bg-lap-cream rounded-2xl p-2 drop-shadow-sm" />
        </div>
        <div class="flex flex-col w-full sm:w-1/2 p-10 sm:p-5 items-center justify-center">
            <form method="POST" action="{{ route('login') }}" class="flex flex-col w-full lg:w-1/2 gap-4">
                <span class="font-bold text-lap-dark text-lg sm:text-sm">Welcom to {{ config('app.name') }}</span>
                <label class="text-lap-dark font-normal text-base sm:text-sm block">Email</label>
                <input type="email" class="p-3 bg-slate-200 border border-slate-300 rounded-lg block focus:outline-slate-400"/>
                <label class="text-lap-dark font-normal text-base sm:text-sm block">Password</label>
                <input type="password" class="p-3 bg-slate-200 border border-slate-300 rounded-lg block focus:outline-slate-400"/>
                <a href="#" class="text-slate-800 text-end text-sm font-semibold sm:font-medium w-full">Forgot password?</a>
                <button type="submit" class="relative group p-3 bg-slate-500 text-white text-lg font-medium rounded-lg drop-shadow-lg cursor-pointer hover:bg-lap-dark hover:drop-shadow-2xl transition-all delay-150">Log In</button>
                <small class="text-lap-navy text-center w-full pt-16">&copy;{{ date('Y') }} all rights reserved</small>
            </form>
        </div>
    </div>
@endsection
