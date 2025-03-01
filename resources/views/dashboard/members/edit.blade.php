@extends('layouts.dashboard')
@section('content')
    <div class="flex flex-col gap-9">
        <!-- Contact Form -->
        <div class="rounded-sm border border-gray-300 bg-white shadow-md dark:border-gray-300dark dark:bg-boxdark">
            <div class="border-b border-gray-300 px-6 py-4 dark:border-gray-300dark">
                <h3 class="font-medium text-black dark:text-white">
                    Buat Member Baru
                </h3>
            </div>
            <form action="{{ route('dashboard.members.update', ['member' => $member->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6.5">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Nama Lengkap <span class="text-red-600">*</span>
                            </label>
                            <input type="text" placeholder="Jhon doe" name="full_name" value="{{ $member->full_name }}" required
                                class="w-full rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-red-600" />
                            @error('full_name')
                                <div class="mt-1 text-red-600">
                                    <p class="text-xs">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Nomor Telepon <span class="text-red-600">*</span>
                            </label>
                            <input ype="tel" pattern="08[0-9]{8,11}" placeholder="08XXXXXXXXX" name="phone_number" value="{{ $member->no_telp }}" required
                                class="w-full rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-red-600" />
                            @error('phone_number')
                                <div class="mt-1 text-red-600">
                                    <p class="text-xs">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Point <span class="text-red-600">*</span>
                            </label>
                            <input type="number" placeholder="contoh: 12000" name="point" value="{{ $member->point }}" required
                                class="w-full rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-red-600" />
                            @error('point')
                                <div class="mt-1 text-red-600">
                                    <p class="text-xs">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Email <span class="text-red-600">*</span>
                            </label>
                            <input type="email" placeholder="someone@yourdomain.com" required name="email" value="{{ $member->email }}"
                                class="w-full rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-white" />
                            @error('email')
                                <div class="mt-1 text-red-600">
                                    <p class="text-xs">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Status <span class="text-red-600">*</span>
                            </label>
                            <div class="relative z-20 bg-transparent dark:bg-form-input">
                                <select name="status" value="{{ $member->status }}"
                                    class="relative z-20 w-full appearance-none rounded border border-gray-300 bg-transparent px-5 py-3 outline-none transition focus:border-red-600 active:border-red-600 dark:border-form-strokedark dark:bg-form-input dark:focus:border-red-600">
                                    <option value="" class="text-body" {{ $member->status === null ? 'selected' : '' }}>
                                        Pilih status member
                                    </option>
                                    <option value="active" class="text-body" {{ $member->status === 'active' ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="inactive" class="text-body" {{ $member->status === 'inactive' ? 'selected' : '' }}>
                                        Tidak Aktif
                                    </option>
                                </select>
                                <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.8">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                                fill=""></path>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            @error('category_id')
                                <div class="mt-1 text-red-600">
                                    <p class="text-xs">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="px-30 flex flex-row gap-5 justify-center items-center">
                        <a href="{{ url()->previous() }}"
                            class="flex px-15 justify-center rounded border-black border-2 p-3 font-medium text-gray hover:bg-opacity-90">
                            Back
                        </a>
                        <button type="submit"
                            class="flex px-10 justify-center rounded bg-green-600 text-white p-3 font-medium text-gray hover:bg-opacity-90">
                            Edit Member
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
