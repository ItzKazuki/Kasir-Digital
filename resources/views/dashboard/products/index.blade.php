@extends('layouts.dashboard')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-black  ">
            Daftar Produk
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="{{ route('dashboard.index') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-red-600">Produk</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->
    <!-- ====== Table One Start -->
    {{-- <div
        class="rounded-sm border border-gray-300 bg-white px-5 pb-2.5 pt-6 shadow-md     sm:px-7.5 xl:pb-1">
        <div class="flex justify-between items-center">
            <h4 class="mb-6 text-xl font-bold text-black  ">
                Products
            </h4>
            <a href="{{ route('dashboard.products.create') }}"
                class="flex font-bold justify-center rounded bg-red-600 px-6 py-2 text-white hover:bg-red-700">
                Tambah Produk
            </a>
        </div>

        <div class="flex flex-col">
            <div class="grid grid-cols-3 rounded-sm bg-gray-200   sm:grid-cols-7">
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
                <div class="grid grid-cols-3 border-b border-gray-300   sm:grid-cols-7">
                    <div class="flex items-center gap-3 p-2 xl:p-5 col-span-2">
                        <div class="flex-shrink-0">
                            <img class="w-30" src="{{ $product->product_image }}" alt="Brand" />
                        </div>
                        <p class="hidden font-medium text-black   sm:block">
                            {{ $product->name }}
                        </p>
                    </div>

                    <div class="flex items-center justify-center p-2 xl:p-5">
                        <p class="font-medium text-black  ">{{ $product->category->name }}</p>
                    </div>

                    <div class="flex items-center justify-center p-2 xl:p-5">
                        <p class="font-medium text-green-600">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>

                    <div class="hidden items-center justify-center p-2 sm:flex xl:p-5">
                        <p class="font-medium text-black  ">{{ $product->stock }}</p>
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
                                <svg class="fill-current" width="15" height="15" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path
                                        d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                </svg>
                            </span>
                        </a>
                        <form id="delete-product-{{ $product->id }}"
                            action="{{ route('dashboard.products.destroy', ['product' => $product->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="showModal('delete-product-{{ $product->id }}')"
                                class="inline-flex items-center justify-center gap-2 bg-red-500 px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-2 xl:px-5 rounded">
                                <span>
                                    <svg class="fill-current" width="15" height="15"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path
                                            d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div> --}}
    <!-- ====== Table Two Start -->
    <div class="rounded-sm border border-gray-300 bg-white shadow-default    ">
        <div class="flex justify-between items-center px-4 py-6 md:px-6 xl:px-7">
            <h4 class="text-xl font-bold text-black  ">
                Products
            </h4>
            <a href="{{ route('dashboard.products.create') }}"
                class="flex font-bold justify-center rounded bg-red-600 px-6 py-2 text-white hover:bg-red-700">
                Tambah Produk
            </a>
        </div>

        <div
            class="grid grid-cols-6 border-t border-gray-300 px-4 py-4.5   sm:grid-cols-9 md:px-6 2xl:px-7.5">
            <div class="col-span-3 flex items-center">
                <p class="font-medium">Nama Produk</p>
            </div>
            <div class="col-span-2 hidden items-center sm:flex">
                <p class="font-medium">Kategori</p>
            </div>
            <div class="col-span-1 flex items-center">
                <p class="font-medium">Harga</p>
            </div>
            <div class="col-span-1 flex items-center">
                <p class="font-medium">Stok</p>
            </div>
            <div class="col-span-1 flex items-center">
                <p class="font-medium">Estimasi Profit</p>
            </div>
            <div class="col-span-1 flex items-center">
                <p class="font-medium">Aksi</p>
            </div>
        </div>

        @foreach ($products as $product)
            <div
                class="grid grid-cols-6 border-t border-gray-300 px-4 py-4.5   sm:grid-cols-9 md:px-6 2xl:px-7.5">
                <div class="col-span-3 flex items-center">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <div class="h-12.5 w-15 rounded-md">
                            <img src="src/images/product/product-01.png" alt="Product" />
                        </div>
                        <p class="font-medium text-black  ">
                            {{ $product->name }}
                        </p>
                    </div>
                </div>
                <div class="col-span-2 hidden items-center sm:flex">
                    <p class="font-medium text-black  ">{{ $product->category->name }}</p>
                </div>
                <div class="col-span-1 flex items-center">
                    <p class="font-medium text-black  ">Rp. {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>
                <div class="col-span-1 flex items-center">
                    <p class="font-medium text-black  ">{{ $product->stock }}</p>
                </div>
                <div class="col-span-1 flex items-center">
                    <p class="font-medium text-meta-3">Rp. {{ number_format($product->estimasi_keuntungan, 0, ',', '.') }}
                    </p>
                </div>
                <div class="hidden items-center justify-center p-2 sm:flex xl:p-3 gap-4">
                    <a href="{{ route('dashboard.products.edit', $product->id) }}"
                        class="inline-flex items-center justify-center gap-2 bg-yellow-500 px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-2 xl:px-5 rounded">
                        <span>
                            <svg class="fill-current" width="15" height="15" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                            </svg>
                        </span>
                    </a>
                    <form id="delete-product-{{ $product->id }}"
                        action="{{ route('dashboard.products.destroy', ['product' => $product->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="showModal('delete-product-{{ $product->id }}')"
                            class="inline-flex items-center justify-center gap-2 bg-red-500 px-10 py-4 text-center font-medium text-white hover:bg-opacity-90 lg:px-2 xl:px-5 rounded">
                            <span>
                                <svg class="fill-current" width="15" height="15" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path
                                        d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('modals')
    <!-- Modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 z-300 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true" onclick="hideModal()"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                            <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-base font-semibold text-gray-900" id="modal-title">Hapus Produk</h3>
                            <p class="text-sm text-gray-500 mt-2">Are you sure you want to delete this product? This action
                                cannot be undone.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-5">
                    <button id="confirmDeleteBtn" type="button"
                        class="w-full sm:w-auto px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">Hapus</button>
                    <button onclick="hideModal()"
                        class="mt-3 sm:mt-0 w-full sm:w-auto px-3 py-2 bg-white text-gray-900 rounded-md ring-1 ring-gray-300 hover:bg-gray-50">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        let deleteFormId = '';

        function showModal(formId) {
            deleteFormId = formId;
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function hideModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }

        document.getElementById("confirmDeleteBtn").addEventListener("click", function() {
            if (deleteFormId) {
                document.getElementById(deleteFormId).submit();
            }
        });
    </script>
@endpush
