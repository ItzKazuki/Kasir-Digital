<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasie Digital | Kasir</title>

    {{-- style internal or external --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="flex h-screen overflow-hidden bg-gray-100">

    <div id="loadingProcessTransaction"
        class="fixed left-0 top-0 z-999999 h-screen w-screen items-center flex-col justify-center bg-white"
        style="display: none;">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-red-600 border-t-transparent">
        </div>
        <p class="mt-4 font-bold text-xl">Memproses Transaksi</p>
    </div>

    <!-- Sidebar Kiri -->
    <aside
        class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-white duration-300 ease-linear shadow-md lg:static lg:translate-x-0">
        <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
            <a href="#">
                <img src="{{ asset('static/logo-340x180.png') }}" alt="Logo" />
            </a>
        </div>
        <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">

            <nav class="mt-5 px-4 py-4 lg:mt-3 lg:px-6">
                <div>
                    <h3 class="mb-4 ml-4 text-xl font-bold text-bodydark2">Kategori</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium duration-300 ease-in-out {{ !request('category') ? 'bg-red-100 text-red-600' : '' }} hover:bg-red-200"
                                href="{{ route('dashboard.kasir.products.index') }}">
                                All
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium duration-300 ease-in-out hover:bg-red-200 {{ request('category') == $category->name ? 'bg-red-100 text-red-600' : '' }}"
                                    href="{{ route('dashboard.kasir.products.index', ['category' => $category->name]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-bold text-medium duration-300 ease-in-out hover:bg-red-200"
                                href="{{ route('dashboard.index') }}">
                                Kembali ke Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden bg-gray-100">
        <header class="sticky top-0 z-999 flex w-full bg-white drop-shadow-1">
            <div class="flex flex-grow items-center justify-between px-4 py-4 shadow-2 md:px-6 2xl:px-11">
                <div class="flex items-center gap-2 sm:gap-4 lg:hidden">

                </div>
                <div class="hidden sm:block">

                </div>

                <div class="flex items-center gap-3 2xsm:gap-7">
                    <ul class="flex items-center gap-2 2xsm:gap-4">
                        <!-- Chat Notification Area -->
                        <li class="relative" x-data="{ dropdownOpen: false, notifying: true }" @click.outside="dropdownOpen = false">
                            <button
                                class="relative flex h-8.5 w-8.5 items-center justify-center rounded-full border-0 bg-red-100 hover:text-red-800 "
                                id="cart-button">
                                <svg width="18" class="fill-current duration-300 ease-in-out text-red-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path
                                        d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                                </svg>
                            </button>
                        </li>
                        <!-- Chat Notification Area -->
                    </ul>

                    <!-- User Area -->
                    <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                        <a class="flex items-center gap-4" href="#"
                            @click.prevent="dropdownOpen = ! dropdownOpen">
                            <span class="hidden text-right lg:block">
                                <span
                                    class="block text-sm font-medium text-black  ">{{ auth()->user()->full_name }}</span>
                                <span class="block text-xs font-medium">{{ ucfirst(auth()->user()->role) }}</span>
                            </span>

                            <span class="h-12 w-12 rounded-full">
                                <img class="rounded-full aspect-square object-cover"
                                    src="{{ auth()->user()->profile_image ? auth()->user()->profile_image : Avatar::create(auth()->user()->full_name)->toBase64() }}"
                                    alt="User" />
                            </span>

                            <svg :class="dropdownOpen && 'rotate-180'" class="hidden fill-current sm:block"
                                width="12" height="8" viewBox="0 0 12 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"
                                    fill="" />
                            </svg>
                        </a>

                        <!-- Dropdown Start -->
                        <div x-show="dropdownOpen"
                            class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-sm border border-gray-100 bg-white shadow-default    ">
                            <ul class="flex flex-col gap-5 border-b border-gray-100 px-6 py-7.5  ">
                                <li>
                                    <a href="{{ route('dashboard.profile') }}"
                                        class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out {{ request()->is('dashboard/profile*') ? 'text-red-600' : 'text-gray-600' }} lg:text-base">
                                        <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11 9.62499C8.42188 9.62499 6.35938 7.59687 6.35938 5.12187C6.35938 2.64687 8.42188 0.618744 11 0.618744C13.5781 0.618744 15.6406 2.64687 15.6406 5.12187C15.6406 7.59687 13.5781 9.62499 11 9.62499ZM11 2.16562C9.28125 2.16562 7.90625 3.50624 7.90625 5.12187C7.90625 6.73749 9.28125 8.07812 11 8.07812C12.7188 8.07812 14.0938 6.73749 14.0938 5.12187C14.0938 3.50624 12.7188 2.16562 11 2.16562Z"
                                                fill="" />
                                            <path
                                                d="M17.7719 21.4156H4.2281C3.5406 21.4156 2.9906 20.8656 2.9906 20.1781V17.0844C2.9906 13.7156 5.7406 10.9656 9.10935 10.9656H12.925C16.2937 10.9656 19.0437 13.7156 19.0437 17.0844V20.1781C19.0094 20.8312 18.4594 21.4156 17.7719 21.4156ZM4.53748 19.8687H17.4969V17.0844C17.4969 14.575 15.4344 12.5125 12.925 12.5125H9.07498C6.5656 12.5125 4.5031 14.575 4.5031 17.0844V19.8687H4.53748Z"
                                                fill="" />
                                        </svg>
                                        My Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard.settings') }}"
                                        class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out {{ request()->is('dashboard/settings*') ? 'text-red-600' : 'text-gray-600' }} lg:text-base">
                                        <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20.8656 8.86874C20.5219 8.49062 20.0406 8.28437 19.525 8.28437H19.4219C19.25 8.28437 19.1125 8.18124 19.0781 8.04374C19.0437 7.90624 18.975 7.80312 18.9406 7.66562C18.8719 7.52812 18.9406 7.39062 19.0437 7.28749L19.1125 7.21874C19.4906 6.87499 19.6969 6.39374 19.6969 5.87812C19.6969 5.36249 19.525 4.88124 19.1469 4.50312L17.8062 3.12812C17.0844 2.37187 15.8469 2.33749 15.0906 3.09374L14.9875 3.16249C14.8844 3.26562 14.7125 3.29999 14.5406 3.23124C14.4031 3.16249 14.2656 3.09374 14.0937 3.05937C13.9219 2.99062 13.8187 2.85312 13.8187 2.71562V2.54374C13.8187 1.47812 12.9594 0.618744 11.8937 0.618744H9.96875C9.45312 0.618744 8.97187 0.824994 8.62812 1.16874C8.25 1.54687 8.07812 2.02812 8.07812 2.50937V2.64687C8.07812 2.78437 7.975 2.92187 7.8375 2.99062C7.76875 3.02499 7.73437 3.02499 7.66562 3.05937C7.52812 3.12812 7.35625 3.09374 7.25312 2.99062L7.18437 2.88749C6.84062 2.50937 6.35937 2.30312 5.84375 2.30312C5.32812 2.30312 4.84687 2.47499 4.46875 2.85312L3.09375 4.19374C2.3375 4.91562 2.30312 6.15312 3.05937 6.90937L3.12812 7.01249C3.23125 7.11562 3.26562 7.28749 3.19687 7.39062C3.12812 7.52812 3.09375 7.63124 3.025 7.76874C2.95625 7.90624 2.85312 7.97499 2.68125 7.97499H2.57812C2.0625 7.97499 1.58125 8.14687 1.20312 8.52499C0.824996 8.86874 0.618746 9.34999 0.618746 9.86562L0.584371 11.7906C0.549996 12.8562 1.40937 13.7156 2.475 13.75H2.57812C2.75 13.75 2.8875 13.8531 2.92187 13.9906C2.99062 14.0937 3.05937 14.1969 3.09375 14.3344C3.12812 14.4719 3.09375 14.6094 2.99062 14.7125L2.92187 14.7812C2.54375 15.125 2.3375 15.6062 2.3375 16.1219C2.3375 16.6375 2.50937 17.1187 2.8875 17.4969L4.22812 18.8719C4.95 19.6281 6.1875 19.6625 6.94375 18.9062L7.04687 18.8375C7.15 18.7344 7.32187 18.7 7.49375 18.7687C7.63125 18.8375 7.76875 18.9062 7.94062 18.9406C8.1125 19.0094 8.21562 19.1469 8.21562 19.2844V19.4219C8.21562 20.4875 9.075 21.3469 10.1406 21.3469H12.0656C13.1312 21.3469 13.9906 20.4875 13.9906 19.4219V19.2844C13.9906 19.1469 14.0937 19.0094 14.2312 18.9406C14.3 18.9062 14.3344 18.9062 14.4031 18.8719C14.575 18.8031 14.7125 18.8375 14.8156 18.9406L14.8844 19.0437C15.2281 19.4219 15.7094 19.6281 16.225 19.6281C16.7406 19.6281 17.2219 19.4562 17.6 19.0781L18.975 17.7375C19.7312 17.0156 19.7656 15.7781 19.0094 15.0219L18.9406 14.9187C18.8375 14.8156 18.8031 14.6437 18.8719 14.5406C18.9406 14.4031 18.975 14.3 19.0437 14.1625C19.1125 14.025 19.25 13.9562 19.3875 13.9562H19.4906H19.525C20.5562 13.9562 21.4156 13.1312 21.45 12.0656L21.4844 10.1406C21.4156 9.72812 21.2094 9.21249 20.8656 8.86874ZM19.8344 12.1C19.8344 12.3062 19.6625 12.4781 19.4562 12.4781H19.3531H19.3187C18.5281 12.4781 17.8062 12.9594 17.5312 13.6469C17.4969 13.75 17.4281 13.8531 17.3937 13.9562C17.0844 14.6437 17.2219 15.5031 17.7719 16.0531L17.8406 16.1562C17.9781 16.2937 17.9781 16.5344 17.8406 16.6719L16.4656 18.0125C16.3625 18.1156 16.2594 18.1156 16.1906 18.1156C16.1219 18.1156 16.0187 18.1156 15.9156 18.0125L15.8469 17.9094C15.2969 17.325 14.4719 17.1531 13.7156 17.4969L13.5781 17.5656C12.8219 17.875 12.3406 18.5625 12.3406 19.3531V19.4906C12.3406 19.6969 12.1687 19.8687 11.9625 19.8687H10.0375C9.83125 19.8687 9.65937 19.6969 9.65937 19.4906V19.3531C9.65937 18.5625 9.17812 17.8406 8.42187 17.5656C8.31875 17.5312 8.18125 17.4625 8.07812 17.4281C7.80312 17.2906 7.52812 17.2562 7.25312 17.2562C6.77187 17.2562 6.29062 17.4281 5.9125 17.8062L5.84375 17.8406C5.70625 17.9781 5.46562 17.9781 5.32812 17.8406L3.9875 16.4656C3.88437 16.3625 3.88437 16.2594 3.88437 16.1906C3.88437 16.1219 3.88437 16.0187 3.9875 15.9156L4.05625 15.8469C4.64062 15.2969 4.8125 14.4375 4.50312 13.75C4.46875 13.6469 4.43437 13.5437 4.36562 13.4406C4.09062 12.7187 3.40312 12.2031 2.6125 12.2031H2.50937C2.30312 12.2031 2.13125 12.0312 2.13125 11.825L2.16562 9.89999C2.16562 9.76249 2.23437 9.69374 2.26875 9.62499C2.30312 9.59062 2.40625 9.52187 2.54375 9.52187H2.64687C3.4375 9.55624 4.15937 9.07499 4.46875 8.35312C4.50312 8.24999 4.57187 8.14687 4.60625 8.04374C4.91562 7.35624 4.77812 6.49687 4.22812 5.94687L4.15937 5.84374C4.02187 5.70624 4.02187 5.46562 4.15937 5.32812L5.53437 3.98749C5.6375 3.88437 5.74062 3.88437 5.80937 3.88437C5.87812 3.88437 5.98125 3.88437 6.08437 3.98749L6.15312 4.09062C6.70312 4.67499 7.52812 4.84687 8.28437 4.53749L8.42187 4.46874C9.17812 4.15937 9.65937 3.47187 9.65937 2.68124V2.54374C9.65937 2.40624 9.72812 2.33749 9.7625 2.26874C9.79687 2.19999 9.9 2.16562 10.0375 2.16562H11.9625C12.1687 2.16562 12.3406 2.33749 12.3406 2.54374V2.68124C12.3406 3.47187 12.8219 4.19374 13.5781 4.46874C13.6812 4.50312 13.8187 4.57187 13.9219 4.60624C14.6437 4.94999 15.5031 4.81249 16.0875 4.26249L16.1906 4.19374C16.3281 4.05624 16.5687 4.05624 16.7062 4.19374L18.0469 5.56874C18.15 5.67187 18.15 5.77499 18.15 5.84374C18.15 5.91249 18.1156 6.01562 18.0469 6.11874L17.9781 6.18749C17.3594 6.70312 17.1875 7.56249 17.4625 8.24999C17.4969 8.35312 17.5312 8.45624 17.6 8.55937C17.875 9.28124 18.5625 9.79687 19.3531 9.79687H19.4562C19.5937 9.79687 19.6625 9.86562 19.7312 9.89999C19.8 9.93437 19.8344 10.0375 19.8344 10.175V12.1Z"
                                                fill="" />
                                            <path
                                                d="M11 6.32498C8.42189 6.32498 6.32501 8.42186 6.32501 11C6.32501 13.5781 8.42189 15.675 11 15.675C13.5781 15.675 15.675 13.5781 15.675 11C15.675 8.42186 13.5781 6.32498 11 6.32498ZM11 14.1281C9.28126 14.1281 7.87189 12.7187 7.87189 11C7.87189 9.28123 9.28126 7.87186 11 7.87186C12.7188 7.87186 14.1281 9.28123 14.1281 11C14.1281 12.7187 12.7188 14.1281 11 14.1281Z"
                                                fill="" />
                                        </svg>
                                        Account Settings
                                    </a>
                                </li>
                            </ul>
                            <form id="logoutForm" action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="button" onclick="showLogoutModal()"
                                    class="flex items-center gap-3.5 px-6 py-4 text-sm font-medium duration-300 ease-in-out hover: text-gray-600 lg:text-base">
                                    <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.5375 0.618744H11.6531C10.7594 0.618744 10.0031 1.37499 10.0031 2.26874V4.64062C10.0031 5.05312 10.3469 5.39687 10.7594 5.39687C11.1719 5.39687 11.55 5.05312 11.55 4.64062V2.23437C11.55 2.16562 11.5844 2.13124 11.6531 2.13124H15.5375C16.3625 2.13124 17.0156 2.78437 17.0156 3.60937V18.3562C17.0156 19.1812 16.3625 19.8344 15.5375 19.8344H11.6531C11.5844 19.8344 11.55 19.8 11.55 19.7312V17.3594C11.55 16.9469 11.2062 16.6031 10.7594 16.6031C10.3125 16.6031 10.0031 16.9469 10.0031 17.3594V19.7312C10.0031 20.625 10.7594 21.3812 11.6531 21.3812H15.5375C17.2219 21.3812 18.5625 20.0062 18.5625 18.3562V3.64374C18.5625 1.95937 17.1875 0.618744 15.5375 0.618744Z"
                                            fill="" />
                                        <path
                                            d="M6.05001 11.7563H12.2031C12.6156 11.7563 12.9594 11.4125 12.9594 11C12.9594 10.5875 12.6156 10.2438 12.2031 10.2438H6.08439L8.21564 8.07813C8.52501 7.76875 8.52501 7.2875 8.21564 6.97812C7.90626 6.66875 7.42501 6.66875 7.11564 6.97812L3.67814 10.4844C3.36876 10.7938 3.36876 11.275 3.67814 11.5844L7.11564 15.0906C7.25314 15.2281 7.45939 15.3312 7.66564 15.3312C7.87189 15.3312 8.04376 15.2625 8.21564 15.125C8.52501 14.8156 8.52501 14.3344 8.21564 14.025L6.05001 11.7563Z"
                                            fill="" />
                                    </svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                        <!-- Dropdown End -->
                    </div>
                    <!-- User Area -->
                </div>
            </div>
        </header>

        <main>
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white p-4 rounded-lg shadow-md {{ $product->stock <= 0 ? 'bg-gray-400 cursor-not-allowed' : '' }}"
                            @if ($product->stock > 0) onclick="addToCart({{ $product->id }})" style="cursor: pointer;" @endif>
                            <img alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-lg"
                                height="200" src="{{ $product->product_image }}" width="300" />
                            <div class="mt-4 text-center">
                                <h2 class="text-lg font-bold">
                                    {{ $product->name }}
                                </h2>
                                <p class="text-gray-700">
                                    Rp. {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <p id="product-{{ $product->id }}-stock" class="text-gray-500">
                                    Stok: {{ $product->stock }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>

    </div>

    <!-- Aside Keranjang (Tersembunyi secara default) -->
    <aside id="cart-aside"
        class="absolute right-0 top-0 h-screen w-2/6 bg-white shadow-lg mt-20 transform translate-x-full transition-transform duration-300 flex flex-col">
        <div class="p-4 flex justify-between items-center bg-gray-200">
            <h2 class="text-lg font-semibold">Keranjang</h2>
            <button id="close-cart" class="text-red-500">✖</button>
        </div>
        <div class="" id="cart">
            <div id="cartContent">
                <div class="p-4 overflow-y-auto flex-1" id="containerCart"></div>
                <div class="p-4 bg-white sticky bottom-0">
                    <p id="subtotalCart" class="pb-3 text-xl font-bold">Total Transaksi: Rp. </p>
                    <button class="w-full bg-red-500 text-white py-2 rounded" onclick="processTransaction()">Proses
                        Transaksi</button>
                </div>
            </div>
            <div id="emptyCartMessage" class="p-4 text-center text-gray-500 hidden">Cart Kosong</div>
        </div>

        <div class="hidden p-4" id="transactionConfirm">
            <div class="mb-4">
                <div class="flex justify-between items-center mb-2">
                    <label class="block text-black">Member</label>
                    <button class="bg-red-500 text-white py-1 px-4 rounded-lg">Tambah Member</button>
                </div>
                <div class="flex">
                    <input id="phone_number_member" type="text"
                        class="flex-grow p-2 border border-gray-400 rounded-l-lg" placeholder="">
                    <button id="searchMemberBtn" class="bg-red-500 text-white p-3 rounded-r-lg"
                        onclick="searchMember()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="mb-4">
                <p id="totalBelanja" class="text-black">Total Belanja: Rp. 0</p>
                <p id="pajak" class="text-black">Pajak: Rp. 0</p>
                <p id="diskon" class="text-black">Diskon: Rp. 0</p>
            </div>
            <hr class="border-gray-400 mb-4">
            <div class="mb-4">
                <label id="uangMasuk" class="block text-black mb-2 font-bold text-xl">Uang: Rp. 0</label>
                <input id="uang" type="number" class="w-full p-2 border border-gray-400 rounded-lg"
                    placeholder="">
            </div>
            <div class="mb-4">
                <p id="uangKeluar" class="text-black">Kembalian: Rp. 0</p>
            </div>
            <div class="mb-4 bg-white sticky bottom-0">
                <div class="mb-4 flex items-center">
                    <label class="block text-black mb-2 flex-grow">Metode Pembayaran</label>
                    <div class="relative w-1/2">
                        <select id="metode_pembayaran"
                            class="appearance-none w-full bg-red-500 text-white p-2 rounded-lg">
                            <option value="cash">Cash</option>
                            <option value="qris">Qris</option>
                            <option value="debit">Debit Card</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <button onclick="createTransaction()" id="createTransaction"
                    class="bg-red-500 text-white w-full py-2 rounded-lg">Bayar
                    Sekarang</button>
            </div>
        </div>
    </aside>

    <div id="logoutConfirmModal" class="fixed inset-0 z-300 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true" onclick="hideLogoutModal()">
        </div>

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
                            <h3 class="text-base font-semibold text-gray-900" id="modal-title">Kamu Yakin Mau Keluar?
                            </h3>
                            <p class="text-sm text-gray-500 mt-2">Are you sure you want to leave this website? This
                                action
                                cannot be undone.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-5">
                    <button id="confirmLogoutBtn" type="button"
                        class="w-full sm:w-auto px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">Logout</button>
                    <button onclick="hideLogoutModal()"
                        class="mt-3 sm:mt-0 w-full sm:w-auto px-3 py-2 bg-white text-gray-900 rounded-md ring-1 ring-gray-300 hover:bg-gray-50">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    @include('sweetalert::sweetalert');

    document.addEventListener('DOMContentLoaded', function() {
        axios.get('/dashboard/kasir/cart/products/show')
            .then(resCart => {
                const containerCart = document.getElementById('containerCart');
                const subtotalCart = document.getElementById('subtotalCart');

                if (resCart.data.message == "Cart is empty") {
                    document.getElementById('emptyCartMessage').classList.remove('hidden');
                    document.getElementById('cartContent').classList.add('hidden');
                } else {
                    document.getElementById('emptyCartMessage').classList.add('hidden');
                    document.getElementById('cartContent').classList.remove('hidden');
                }
                containerCart.innerHTML = ''; // Clear the existing content
                subtotalCart.innerHTML =
                    `Total Transaksi: Rp. ${resCart.data.subtotal.toLocaleString('id-ID')}`;
                document.getElementById('totalBelanja').innerText =
                    `Total Belanja: Rp. ${resCart.data.subtotal.toLocaleString('id-ID')}`;
                Object.values(resCart.data.cartItems).forEach(item => {
                    const cartItem = `
                        <div class="bg-gray-200 p-4 rounded-lg flex items-center mb-4 relative">
                            <div class="absolute left-0 top-0 bottom-0 bg-red-500 w-2 rounded-l-lg"></div>
                            <div class="ml-4">
                                <img alt="${item.name}" class="w-16 h-16 rounded-lg" src="${item.attributes.image}" />
                            </div>
                            <div class="flex-1 ml-4">
                                <p>${item.name}</p>
                            </div>
                            <div class="flex items-center">
                                <button class="bg-red-500 text-white px-2 py-1 rounded-l" onclick="updateCartQuantity(${item.id}, 'decrement')">-</button>
                                <span class="px-2">${item.quantity}</span>
                                <button class="bg-red-500 text-white px-2 py-1 rounded-r" onclick="updateCartQuantity(${item.id}, 'increment')">+</button>
                            </div>
                            <button class="bg-red-500 text-white px-2 py-1 rounded ml-4" onclick="removeFromCart(${item.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                    containerCart.insertAdjacentHTML('beforeend', cartItem);
                });
            })
            .catch(error => {
                console.error('Error fetching cart content:', error);
            });
    });

    document.getElementById('uang').addEventListener('change', kalkulasiUang);

    function searchMember() {
        const phoneNumber = document.getElementById('phone_number_member').value;
        if (!phoneNumber) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Nomor telepon tidak boleh kosong',
            });
            return;
        }

        axios.post(`/dashboard/kasir/members/search`, {
                phone: phoneNumber
            })
            .then(response => {
                if (response.data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Member Ditemukan',
                        text: `Member: ${response.data.full_name}`,
                    });
                    document.getElementById('phone_number_member').readOnly = true;
                    document.querySelector('#searchMemberBtn').disabled = true;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Member Tidak Ditemukan',
                        text: 'Member dengan nomor telepon tersebut tidak ditemukan',
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mencari member',
                });
            });
    }

    function kalkulasiUang(e) {
        const uangMasuk = parseFloat(e.target.value);
        const totalBelanja = parseFloat(document.getElementById('totalBelanja').innerText.replace('Total Belanja: Rp. ',
            '').replace(/\./g, ''));
        const uangKeluar = uangMasuk - totalBelanja;

        document.getElementById('uangMasuk').innerText = `Uang: Rp. ${uangMasuk.toLocaleString('id-ID')}`;
        if (uangKeluar < 0) {
            document.getElementById('uangKeluar').innerHTML =
                `<p class="text-red-600 font-bold">Uang kurang: Rp. ${Math.abs(uangKeluar).toLocaleString('id-ID')}</p>`;
        } else {
            document.getElementById('uangKeluar').innerText = `Kembalian: Rp. ${uangKeluar.toLocaleString('id-ID')}`;
        }
    }

    function processTransaction() {
        const cart = document.getElementById('cart');
        const processTransaction = document.getElementById('transactionConfirm');

        cart.classList.add('hidden');
        cart.classList.remove('block');
        processTransaction.classList.add('block');
        processTransaction.classList.remove('hidden');
    }

    function createTransaction() {
        const uangMasuk = parseFloat(document.getElementById('uang').value);
        const member = parseInt(document.getElementById('phone_number_member').value);
        const totalBelanja = parseFloat(document.getElementById('totalBelanja').innerText.replace('Total Belanja: Rp. ',
            '').replace(/\./g, ''));
        const uangKeluar = uangMasuk - totalBelanja;
        const paymentMethod = document.getElementById('metode_pembayaran').value;

        if (uangKeluar < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Uang Kurang',
                text: `Uang yang dimasukkan kurang Rp. ${Math.abs(uangKeluar).toLocaleString('id-ID')}`,
            });
            return;
        }

        const createTransactionButton = document.getElementById('createTransaction');
        createTransactionButton.disabled = true;
        createTransactionButton.classList.add('cursor-not-allowed');
        createTransactionButton.innerText = 'Memproses transaksi';

        document.getElementById('loadingProcessTransaction').style.display = 'flex';

        axios.post('/dashboard/kasir/transactions/add', {
                total: totalBelanja,
                cash: uangMasuk,
                no_telp_member: member,
                metode_pembayaran: paymentMethod
            })
            .then(response => {
                if (response.data.redirect) {
                    window.location.href = response.data.redirect;
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Transaksi berhasil dibuat!',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    window.location.reload();
                }
            })
            .catch(error => {
                let message = error.response.data.message ? error.response.data.message :
                    'Terjadi kesalahan saat membuat transaksi';
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: message,
                    timer: 1500,
                    showConfirmButton: false
                });
            });

    }

    function fetchCartItem() {
        axios.get('/dashboard/kasir/cart/products/show')
            .then(resCart => {
                const containerCart = document.getElementById('containerCart');
                const subtotalCart = document.getElementById('subtotalCart');

                if (resCart.data.message == "Cart is empty") {
                    document.getElementById('emptyCartMessage').classList.remove('hidden');
                    document.getElementById('cartContent').classList.add('hidden');
                } else {
                    document.getElementById('emptyCartMessage').classList.add('hidden');
                    document.getElementById('cartContent').classList.remove('hidden');
                }

                containerCart.innerHTML = ''; // Clear the existing content
                subtotalCart.innerHTML = `Total Transaksi: Rp. ${resCart.data.subtotal.toLocaleString('id-ID')}`;
                document.getElementById('totalBelanja').innerText =
                    `Total Belanja: Rp. ${resCart.data.subtotal.toLocaleString('id-ID')}`;
                Object.values(resCart.data.cartItems).forEach(item => {
                    const cartItem = `
                                <div class="bg-gray-200 p-4 rounded-lg flex items-center mb-4 relative">
                                    <div class="absolute left-0 top-0 bottom-0 bg-red-500 w-2 rounded-l-lg"></div>
                                    <div class="ml-4">
                                        <img alt="${item.name}" class="w-16 h-16 rounded-lg" src="${item.attributes.image}" />
                                    </div>
                                    <div class="flex-1 ml-4">
                                        <p>${item.name}</p>
                                    </div>
                                    <div class="flex items-center">
                                        <button class="bg-red-500 text-white px-2 py-1 rounded-l" onclick="updateCartQuantity(${item.id}, 'decrement')">-</button>
                                        <span class="px-2">${item.quantity}</span>
                                        <button class="bg-red-500 text-white px-2 py-1 rounded-r" onclick="updateCartQuantity(${item.id}, 'increment')">+</button>
                                    </div>
                                    <button class="bg-red-500 text-white px-2 py-1 rounded ml-4" onclick="removeFromCart(${item.id})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            `;
                    containerCart.insertAdjacentHTML('beforeend', cartItem);
                });
            })
            .catch(error => {
                console.error('Error fetching cart content:', error);
            });
    }

    function updateCartQuantity(cartProductId, action) {
        const url = `/dashboard/kasir/cart/products/${cartProductId}/${action}`;
        axios.post(url)
            .then(response => {
                // Fetch the updated cart content
                fetchCartItem();
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: `Terjadi kesalahan saat meng${action === 'increment' ? 'tambah' : 'kurang'}kan produk.`,
                });
            });
    }

    function removeFromCart(cartProductId) {
        axios.post(`/dashboard/kasir/cart/products/${cartProductId}/remove`)
            .then(response => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Produk berhasil dihapus dari keranjang!',
                    timer: 1500,
                    showConfirmButton: false
                });
                // Fetch the updated cart content
                fetchCartItem();
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat menghapus produk dari keranjang.',
                });
            });
    }

    function addToCart(id) {
        axios.post(`/dashboard/kasir/cart/products/${id}/add`)
            .then(response => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Produk berhasil ditambahkan ke keranjang!',
                    timer: 1500,
                    showConfirmButton: false
                });
                // Fetch the updated cart content
                fetchCartItem();
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat menambahkan produk ke keranjang.',
                });
            });
    }

    document.getElementById('cart-button').addEventListener('click', function() {
        document.getElementById('cart-aside').classList.remove('translate-x-full');
    });

    document.getElementById('close-cart').addEventListener('click', function() {
        document.getElementById('cart-aside').classList.add('translate-x-full');
    });

    function showLogoutModal() {
        document.getElementById('logoutConfirmModal').classList.remove('hidden');
    }

    function hideLogoutModal() {
        document.getElementById('logoutConfirmModal').classList.add('hidden');
    }

    document.getElementById("confirmLogoutBtn").addEventListener("click", function() {
        document.getElementById('logoutForm').submit();
    });
</script>
<script defer src="{{ asset('js/dashboard.js') }}"></script>

</html>
