@extends('layouts.auth')

@section('content-auth')
    <div class="mx-auto">
        <img class="w-50 my-2" src="{{ asset('static/logo-340x180.png') }}" alt="">
        <h4 class="text-lg font-bold">Login into your account</h4>
    </div>
    <div class="p-8">
        <form action="{{ route('auth.authenticate') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                    Email Address
                </label>
                <div class="relative">
                    <input
                        class="w-full px-4 py-3 pr-12 leading-tight text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:shadow-outline"
                        id="email" name="email" type="email" placeholder="someone@domain.com">
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 text-white bg-red-600 rounded-r-lg">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                    Password
                </label>
                <div class="relative">
                    <input
                        class="w-full px-4 py-3 pr-12 leading-tight text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:shadow-outline"
                        id="password" name="password" type="password" placeholder="Enter your password">
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 text-white bg-red-600 rounded-r-lg">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                @if ($errors->has('email'))
                    <div class="mt-2 text-red-600">
                        <p class="text-xs">{{ $errors->first('email') }}</p>
                    </div>
                @endif
                <div class="mt-2 text-right">
                    <a href="{{ route('auth.forgot') }}" class="text-sm text-blue-500 hover:underline">Forgot Password?</a>
                </div>
            </div>
            <div class="mb-6">
                <button
                    class="w-full px-4 py-3 font-bold text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline"
                    type="submit">
                    Login Now
                </button>
            </div>
            <div class="flex items-center justify-center mb-6">
                <hr class="w-full border-gray-300">
                <span class="absolute px-3 text-gray-500 bg-white">OR</span>
            </div>
            <div>
                <a href="{{ route('auth.register') }}">
                    <button
                        class="w-full px-4 py-3 font-bold text-red-600 border border-red-600 rounded-lg hover:bg-red-700 hover:text-white focus:outline-none focus:shadow-outline"
                        type="button">
                        Signup Now
                    </button>
                </a>
            </div>
        </form>
    </div>
@endsection
