@extends('layouts.dashboard')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-black  ">
            Buat Kategori
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="{{ route('dashboard.index') }}">Dashboard /</a>
                </li>
                <li class="font-medium">Kategori /</li>
                <li class="font-medium text-red-600">Create</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->
    <div class="flex flex-col gap-9">
        <!-- Contact Form -->
        <div class="rounded-sm border border-gray-300 bg-white shadow-md    ">
            <div class="border-b border-gray-300 px-6 py-4  ">
                <h3 class="font-medium text-black  ">
                    Buat Kategori Baru
                </h3>
            </div>
            <form action="{{ route('dashboard.categories.store') }}" method="POST">
                @csrf
                <div class="p-6.5">
                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black  ">
                            Nama Kategori <span class="text-red-600">*</span>
                        </label>
                        <input type="text" placeholder="contoh: Makanan" name="name" required
                            class="w-full rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-whiter        " />
                        @error('name')
                            <div class="mt-1 text-red-600">
                                <p class="text-xs">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="mb-3 block text-sm font-medium text-black  ">
                            Deskripsi
                        </label>
                        <textarea rows="6" placeholder="Masukan deskripsi mengenai produk" name="description"
                            class="w-full rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-whiter        "></textarea>
                        @error('description')
                            <div class="mt-1 text-red-600">
                                <p class="text-xs">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="px-30 flex flex-row gap-5 justify-center items-center">
                        <a href="{{ url()->previous() }}"
                            class="flex px-15 justify-center rounded border-black border-2 p-3 font-medium text-gray hover:bg-opacity-90">
                            Back
                        </a>
                        <button type="submit"
                            class="flex px-10 justify-center rounded bg-green-600 text-white p-3 font-medium text-gray hover:bg-opacity-90">
                            Create Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
