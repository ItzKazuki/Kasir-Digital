@extends('layouts.dashboard')
@section('content')
    <div class="mx-auto max-w-270">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-3xl font-bold text-black">
                Create User
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="{{ route('dashboard.index') }}">Dashboard /</a>
                    </li>
                    <li class="font-medium text-red-600">Create User</li>
                </ol>
            </nav>
        </div>
        <!-- Breadcrumb End -->

        <!-- ====== Create User Section Start -->
        <div class="grid grid-cols-5 gap-8">
            <div class="col-span-5 xl:col-span-3">
                <div class="rounded-sm border border-gray-300 bg-white shadow-default">
                    <div class="border-b border-gray-300 px-7 py-4">
                        <h3 class="font-medium text-black">
                            User Information
                        </h3>
                    </div>
                    <div class="p-7">
                        <form action="{{ route('dashboard.users.store') }}" method="POST">
                            @csrf
                            <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                                <div class="w-full sm:w-1/2">
                                    <label class="mb-3 block text-sm font-medium text-black" for="fullName">Full Name</label>
                                    <input
                                        class="w-full rounded border border-gray-300 bg-gray-200 py-3 px-4.5 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                        type="text" name="full_name" id="full_name" placeholder="John Doe" />
                                    @error('full_name')
                                        <div class="mt-1 text-red-600">
                                            <p class="text-xs">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div class="w-full sm:w-1/2">
                                    <label class="mb-3 block text-sm font-medium text-black" for="phoneNumber">Phone Number</label>
                                    <input
                                        class="w-full rounded border border-gray-300 bg-gray-200 px-4.5 py-3 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                        type="tel" pattern="08[0-9]{8,11}" name="phone_number" id="phone_number"
                                        placeholder="08XXXXXXXXXX" />
                                    @error('phone_number')
                                        <div class="mt-1 text-red-600">
                                            <p class="text-xs">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-5.5">
                                <label class="mb-3 block text-sm font-medium text-black" for="emailAddress">Email Address</label>
                                <input
                                    class="w-full rounded border border-gray-300 bg-gray-200 py-3 px-4.5 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                    type="email" name="email" id="email" placeholder="someone@domain.com" />
                                @error('email')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-5.5">
                                <label class="mb-3 block text-sm font-medium text-black" for="username">Username</label>
                                <input
                                    class="w-full rounded border border-gray-300 bg-gray-200 px-4.5 py-3 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                    type="text" name="username" id="username" placeholder="yourname" />
                                @error('username')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-5.5">
                                <label class="mb-3 block text-sm font-medium text-black" for="password">Password</label>
                                <input
                                    class="w-full rounded border border-gray-300 bg-gray-200 px-4.5 py-3 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                    type="password" name="password" id="password" placeholder="********" />
                                @error('password')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-5.5">
                                <label class="mb-3 block text-sm font-medium text-black" for="role">Role</label>
                                <select
                                    class="w-full rounded border border-gray-300 bg-gray-200 px-4.5 py-3 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                    name="role" id="role">
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                </select>
                                @error('role')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-4.5">
                                <button
                                    class="flex justify-center rounded border border-gray-300 px-6 py-2 font-medium text-black hover:shadow-1"
                                    type="reset">
                                    Cancel
                                </button>
                                <button
                                    class="flex justify-center rounded bg-red-600 px-6 py-2 font-medium text-white hover:bg-opacity-90"
                                    type="submit">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====== Create User Section End -->
    </div>
@endsection
