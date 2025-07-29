@extends('layouts.guest')
@section('title', "Login")
@section('page')
    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-2 w-1/3 min-h-1/3 justify-center bg-lap-cream rounded-xl p-4 drop-shadow-lg">
        <label class="text-lap-dark font-normal text-base block">Email</label>
        <input type="email" class="p-3 bg-white border border-lap-dark rounded-lg block focus:outline-none drop-shadow-lg"/>
        <label class="text-lap-dark font-normal text-base block">Password</label>
        <input type="password" class="p-3 bg-lap-cream border border-lap-dark rounded-lg block focus:outline-none drop-shadow-lg"/>
        <button type="submit" class="p-3 bg-lap-dark text-white text-lg font-medium rounded-lg drop-shadow-lg cursor-pointer hover:bg-slate-700 transition-all delay-150">Log In</button>
    </form>
@endsection
