@extends('layouts.dashboard')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-black dark:text-white">
            Edit Produk
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="{{ route('dashboard.index') }}">Dashboard /</a>
                </li>
                <li class="font-medium">Produk /</li>
                <li class="font-medium text-red-600">Edit</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->
    <div class="flex flex-col gap-9">
        <!-- Contact Form -->
        <div class="rounded-sm border border-gray-300 bg-white shadow-md dark:border-gray-300dark dark:bg-boxdark">
            <div class="border-b border-gray-300 px-6 py-4 dark:border-gray-300dark">
                <h3 class="font-medium text-gray-800 dark:text-white">
                    Edit Produk {{ $product->name }}
                </h3>
            </div>
            <form action="{{ route('dashboard.products.update', ['product' => $product->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6.5">
                    <div class="mb-4 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-2/1">
                            <label class="mb-3 block text-sm font-medium text-gray-800 dark:text-white">
                                Nama Produk <span class="text-red-600">*</span>
                            </label>
                            <input type="text" placeholder="contoh: Nasi Padang" name="name_product"
                                value="{{ $product->name }}" required
                                class="w-full rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-gray-800 outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-red-600" />
                            @error('name_product')
                                <div class="mt-1 text-red-600">
                                    <p class="text-xs">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        @if ($product->barcode)
                            <div class="w-full xl:w-1/2" id="barcodeInputContainer">
                                <label class="mb-3 block text-sm font-medium text-gray-800 dark:text-white">
                                    Barcode Barang <span class="text-red-600">*</span>
                                </label>
                                <input type="text" id="barcodeInput" placeholder="contoh: 8997204401776" name="barcode"
                                    value="{{ $product->barcode }}" readonly
                                    class="w-full cursor-pointer rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-gray-500 outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-red-600" />
                                @error('barcode_product')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                        @endif

                    </div>

                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-gray-800 dark:text-white">
                                Kategori <span class="text-red-600">*</span>
                            </label>
                            <div class="relative z-20 bg-transparent dark:bg-form-input">
                                <select name="category_id"
                                    class="relative z-20 w-full appearance-none rounded border border-gray-300 bg-transparent px-5 py-3 outline-none transition focus:border-red-600 active:border-red-600 dark:border-form-strokedark dark:bg-form-input dark:focus:border-red-600">
                                    <option value="" class="text-gray-800">
                                        Pilih kategori produk
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
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

                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-gray-800 dark:text-white">
                                Diskon
                            </label>
                            <div class="relative z-20 bg-transparent dark:bg-form-input">
                                <select name="discount_id"
                                    class="relative z-20 w-full appearance-none rounded border border-gray-300 bg-transparent px-5 py-3 outline-none transition focus:border-red-600 active:border-red-600 dark:border-form-strokedark dark:bg-form-input dark:focus:border-red-600">
                                    <option value="" class="text-gray-800">
                                        Pilih diskon produk
                                    </option>
                                    @foreach ($discounts as $discount)
                                        <option value="{{ $discount->id }}"
                                            {{ $product->discount_id == $discount->id ? 'selected' : '' }}>
                                            {{ $discount->name }}
                                        </option>
                                    @endforeach
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
                            @error('discount_id')
                                <div class="mt-1 text-red-600">
                                    <p class="text-xs">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-gray-800 dark:text-white">
                                Harga <span class="text-red-600">*</span>
                            </label>
                            <input type="number" placeholder="Enter your first name" required name="price"
                                value="{{ $product->price }}"
                                class="w-full rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-gray-800 outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-white" />
                            @error('price')
                                <div class="mt-1 text-red-600">
                                    <p class="text-xs">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-gray-800 dark:text-white">
                                Stok <span class="text-red-600">*</span>
                            </label>
                            <input type="number" placeholder="Enter your first name" required name="stock"
                                value="{{ $product->stock }}"
                                class="w-full rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-gray-800 outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-white" />
                            @error('stock')
                                <div class="mt-1 text-red-600">
                                    <p class="text-xs">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="w-full xl:w-1/2">
                            <label class="mb-3 block text-sm font-medium text-gray-800 dark:text-white">
                                Expired at
                            </label>
                            <input type="date" placeholder="Enter your first name" name="expired_at"
                                value="{{ $product->expired_at }}"
                                class="w-full rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-gray-800 outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-white" />
                            @error('product_img')
                                <div class="mt-1 text-red-600">
                                    <p class="text-xs">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full">
                            <div class="mb-4">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Attach file <span class="text-red-600">*</span>
                                </label>
                                <input type="file" name="product_img" id="productImgInput"
                                    class="w-full cursor-pointer rounded-lg border-[1.5px] border-gray-300 bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-gray-300 file:bg-red-100 file:px-5 file:py-3 file:hover:bg-red-600 file:hover:bg-opacity-10 focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-red-600"
                                    required />
                                @error('product_img')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Deskripsi
                                </label>
                                <textarea rows="6" placeholder="Masukan deskripsi mengenai produk"
                                    class="w-full rounded border-[1.5px] border-gray-300 bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-red-600 active:border-red-600 disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-red-600">{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="w-full xl:w-1/4">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Preview Produk
                            </label>
                            <img id="previewUploadImage" class="w-full 
                            rounded-lg border border-gray-300" src="{{ $product->product_image }}" alt="">
                        </div>
                    </div>

                    <div class="px-30 flex flex-row gap-5 justify-center items-center">
                        <a href="{{ url()->previous() }}"
                            class="flex px-15 justify-center rounded border-black border-2 p-3 font-medium text-gray hover:bg-opacity-90">
                            Back
                        </a>
                        <button type="submit"
                            class="flex px-10 justify-center rounded bg-green-600 text-white p-3 font-medium text-gray hover:bg-opacity-90">
                            Create Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById("productImgInput").addEventListener("change", function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById("previewUploadImage").src = URL.createObjectURL(file);
            }
        });
    </script>
@endpush