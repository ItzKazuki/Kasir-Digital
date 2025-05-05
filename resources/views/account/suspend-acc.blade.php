@extends('layouts.account-err')

@section('content')
    <div class="text-red-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M18.364 5.636a9 9 0 11-12.728 0m12.728 0L5.636 18.364" />
        </svg>
    </div>
    <h1 class="text-2xl font-bold text-gray-800 mt-4">Account Suspended</h1>
    <p class="text-gray-600 mt-2">Your account has been suspended. Please contact support for more information.</p>
@endsection
