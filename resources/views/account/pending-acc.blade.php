@extends('layouts.account-err')

@section('content')
    <div class="text-yellow-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
        </svg>
    </div>
    <h1 class="text-2xl font-bold text-gray-800 mt-4">Account Pending</h1>
    <p class="text-gray-600 mt-2">Your account is currently pending approval. Please wait for further updates.</p>
@endsection
