@extends('layouts.dashboard')
@section('content')

        <!-- ====== Table One Start -->
        <div
            class="rounded-sm border border-gray-300 bg-white px-5 pb-2.5 pt-6 shadow-md dark:border-gray-300dark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="flex justify-between items-center">
                <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
                    Products
                </h4>
                <a href="{{ route('dashboard.products.create') }}" class="flex font-bold justify-center rounded bg-red-600 px-6 py-2 text-white hover:bg-red-700">
                    Tambah Produk
                </a>
            </div>

            <div class="flex flex-col">
                <div class="grid grid-cols-3 rounded-sm bg-gray-200 dark:bg-meta-4 sm:grid-cols-7">
                    <div class="p-2 xl:p-5 col-span-2">
                        <h5 class="text-sm font-medium uppercase xsm:text-base">Nama Produk</h5>
                    </div>
                    <div class="p-2 text-center xl:p-5">
                        <h5 class="text-sm font-medium uppercase xsm:text-base">Kategori</h5>
                    </div>
                    <div class="p-2 text-center xl:p-5">
                        <h5 class="text-sm font-medium uppercase xsm:text-base">Harga</h5>
                    </div>
                    <div class="hidden p-2 text-center sm:block xl:p-5">
                        <h5 class="text-sm font-medium uppercase xsm:text-base">Stok</h5>
                    </div>
                    <div class="hidden p-2 text-center sm:block xl:p-5">
                        <h5 class="text-sm font-medium uppercase xsm:text-base">Exp date</h5>
                    </div>
                    <div class="hidden p-2 text-center sm:block xl:p-5">
                        <h5 class="text-sm font-medium uppercase xsm:text-base">Aksi</h5>
                    </div>
                </div>

                @foreach ($products as $product)
                    <div class="grid grid-cols-3 border-b border-gray-300 dark:border-gray-300dark sm:grid-cols-7">
                        <div class="flex items-center gap-3 p-2 xl:p-5 col-span-2">
                            <div class="flex-shrink-0">
                                <img class="w-30" src="{{ Storage::url('static/images/products/' . $product->image_url) }}" alt="Brand" />
                            </div>
                            <p class="hidden font-medium text-black dark:text-white sm:block">
                                {{ $product->name }}
                            </p>
                        </div>

                        <div class="flex items-center justify-center p-2 xl:p-5">
                            <p class="font-medium text-black dark:text-white">{{ $product->category->name }}</p>
                        </div>

                        <div class="flex items-center justify-center p-2 xl:p-5">
                            <p class="font-medium text-green-600">Rp. {{ number_format($product->price, 2, ',', '.') }}</p>
                        </div>

                        <div class="hidden items-center justify-center p-2 sm:flex xl:p-5">
                            <p class="font-medium text-black dark:text-white">{{ $product->stock }}</p>
                        </div>

                        <div class="hidden items-center justify-center p-2 sm:flex xl:p-5">
                            @if ($product->expired_at == null)
                                <p
                                    class="inline-flex rounded-full bg-opacity-10 px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100">
                                    tidak expired
                                </p>
                            @else
                                <p
                                    class="inline-flex rounded-full bg-opacity-10 px-3 py-1 text-sm font-medium {{ \Carbon\Carbon::parse($product->expired_at)->isPast() ? 'text-red-600 bg-red-100' : 'text-green-600 bg-green-100' }}">
                                    {{ $product->expired_at }}</p>
                            @endif
                        </div>

                        <div class="hidden items-center justify-center p-2 sm:flex xl:p-3 gap-4">
                            <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                class="inline-flex items-center justify-center gap-2 bg-yellow-500 px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-2 xl:px-5 rounded">
                                <span>
                                    <svg class="fill-current" width="15" height="15"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path
                                            d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                    </svg>
                                </span>
                            </a>
                            <a href="#"
                                class="inline-flex items-center justify-center gap-2 bg-red-500 px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-2 xl:px-5 rounded">
                                <span>
                                    <svg class="fill-current" width="15" height="15"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path
                                            d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
