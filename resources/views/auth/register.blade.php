@extends('layouts.auth')

@section('content-auth')
    <div class="mx-auto">
        <img class="w-50 my-2" src="{{ asset('static/logo-340x180.png') }}" alt="">
        <h4 class="text-lg font-bold">Create an a new account</h4>
    </div>
    <div class="p-8">
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="full_name">
                    Full Name
                </label>
                <div class="relative">
                    <input
                        class="w-full px-4 py-3 pr-12 leading-tight text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:shadow-outline"
                        id="full_name" name="full_name" type="text" placeholder="Jhon Doe" value="{{ old('full_name') }}" required>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 text-white bg-red-600 rounded-r-lg">
                        <i class="fas fa-id-card"></i>
                    </div>
                </div>
                @error('full_name')
                    <div class="mt-2 text-red-600">
                        <p class="text-xs">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="username">
                    Username
                </label>
                <div class="relative">
                    <input
                        class="w-full px-4 py-3 pr-12 leading-tight text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:shadow-outline"
                        id="username" name="username" type="text" placeholder="yourname" value="{{ old('username') }}"  required>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 text-white bg-red-600 rounded-r-lg">
                        <i class="fas fa-at"></i>
                    </div>
                </div>
                @error('username')
                    <div class="mt-2 text-red-600">
                        <p class="text-xs">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                    Email Address
                </label>
                <div class="relative">
                    <input
                        class="w-full px-4 py-3 pr-12 leading-tight text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:shadow-outline"
                        id="email" name="email" type="email" placeholder="someone@domain.com" value="{{ old('email') }}" required>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 text-white bg-red-600 rounded-r-lg">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                @error('email')
                    <div class="mt-2 text-red-600">
                        <p class="text-xs">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="phone_number">
                    Nomor Telepon
                </label>
                <div class="relative">
                    <input
                        class="w-full px-4 py-3 pr-12 leading-tight text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:shadow-outline"
                        id="phone_number" name="phone_number" type="tel" pattern="08[0-9]{8,11}" value="{{ old('phone_number') }}"
                        placeholder="08XXXXXXXXXX" required>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 text-white bg-red-600 rounded-r-lg">
                        <i class="fas fa-phone"></i>
                    </div>
                </div>
                @error('phone_number')
                    <div class="mt-2 text-red-600">
                        <p class="text-xs">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                    Password
                </label>
                <div class="relative">
                    <input
                        class="w-full px-4 py-3 pr-12 leading-tight text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:shadow-outline"
                        id="password" name="password" type="password" placeholder="Enter your password" required>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 text-white bg-red-600 rounded-r-lg">
                        <i class="fas fa-lock"></i>
                    </div>
                    @error('password')
                    <div class="mt-2 text-red-600">
                        <p class="text-xs">{{ $message }}</p>
                    </div>
                @enderror
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                    Confirm Password
                </label>
                <div class="relative">
                    <input
                        class="w-full px-4 py-3 pr-12 leading-tight text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:shadow-outline"
                        id="password" name="password_confirmation" type="password" placeholder="Enter your password" required>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 text-white bg-red-600 rounded-r-lg">
                        <i class="fas fa-user-lock"></i>
                    </div>
                </div>
                @error('password')
                    <div class="mt-2 text-red-600">
                        <p class="text-xs">{{ $message }}</p>
                    </div>
                @enderror
                <div class="mt-2 text-right">
                    <a href="{{ route('auth.forgot') }}" class="text-sm text-blue-500 hover:underline">Forgot Password?</a>
                </div>
            </div>
            <div class="mb-6">
                <button
                    class="w-full px-4 py-3 font-bold text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline"
                    type="submit">
                    Signup Now
                </button>
            </div>
            <div class="flex items-center justify-center mb-6">
                <hr class="w-full border-gray-300">
                <span class="absolute px-3 text-gray-500 bg-white">OR</span>
            </div>
            <div>
                <a href="{{ route('auth.login') }}">
                <button
                    class="w-full px-4 py-3 font-bold text-red-600 border border-red-600 rounded-lg hover:bg-red-700 hover:text-white focus:outline-none focus:shadow-outline"
                    type="button">
                    Login Now
                </button>
            </a>
            </div>
        </form>
    </div>
@endsection
