<aside
    class="absolute left-0 top-0 z-80 flex h-screen w-72 flex-col overflow-y-hidden bg-white duration-300 ease-linear shadow-2xl lg:static lg:translate-x-0">
    <div class="flex items-center justify-between gap-2 px-6 py-5 lg:py-6.5">
        <a href="#">
            <img src="{{ asset('static/logo-340x180.png') }}" alt="Logo" />
        </a>
    </div>
    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <nav class="mt-5 px-4 py-4 lg:mt-3 lg:px-6">
            <div>
                <h3 class="mb-4 ml-4 text-xl font-bold text-gray-800">Kasir</h3>
                <ul class="mb-6 flex flex-col gap-1">
                    <li>
                        <a class="group relative flex items-center gap-2 rounded-sm px-4 py-2 font-medium duration-300 ease-in-out hover:bg-red-100 {{ request()->is('dashboard') ? 'text-red-600 bg-red-50' : '' }}"
                            href="{{ route('dashboard.index') }}">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.10322 0.956299H2.53135C1.5751 0.956299 0.787598 1.7438 0.787598 2.70005V6.27192C0.787598 7.22817 1.5751 8.01567 2.53135 8.01567H6.10322C7.05947 8.01567 7.84697 7.22817 7.84697 6.27192V2.72817C7.8751 1.7438 7.0876 0.956299 6.10322 0.956299ZM6.60947 6.30005C6.60947 6.5813 6.38447 6.8063 6.10322 6.8063H2.53135C2.2501 6.8063 2.0251 6.5813 2.0251 6.30005V2.72817C2.0251 2.44692 2.2501 2.22192 2.53135 2.22192H6.10322C6.38447 2.22192 6.60947 2.44692 6.60947 2.72817V6.30005Z"
                                    fill="" />
                                <path
                                    d="M15.4689 0.956299H11.8971C10.9408 0.956299 10.1533 1.7438 10.1533 2.70005V6.27192C10.1533 7.22817 10.9408 8.01567 11.8971 8.01567H15.4689C16.4252 8.01567 17.2127 7.22817 17.2127 6.27192V2.72817C17.2127 1.7438 16.4252 0.956299 15.4689 0.956299ZM15.9752 6.30005C15.9752 6.5813 15.7502 6.8063 15.4689 6.8063H11.8971C11.6158 6.8063 11.3908 6.5813 11.3908 6.30005V2.72817C11.3908 2.44692 11.6158 2.22192 11.8971 2.22192H15.4689C15.7502 2.22192 15.9752 2.44692 15.9752 2.72817V6.30005Z"
                                    fill="" />
                                <path
                                    d="M6.10322 9.92822H2.53135C1.5751 9.92822 0.787598 10.7157 0.787598 11.672V15.2438C0.787598 16.2001 1.5751 16.9876 2.53135 16.9876H6.10322C7.05947 16.9876 7.84697 16.2001 7.84697 15.2438V11.7001C7.8751 10.7157 7.0876 9.92822 6.10322 9.92822ZM6.60947 15.272C6.60947 15.5532 6.38447 15.7782 6.10322 15.7782H2.53135C2.2501 15.7782 2.0251 15.5532 2.0251 15.272V11.7001C2.0251 11.4188 2.2501 11.1938 2.53135 11.1938H6.10322C6.38447 11.1938 6.60947 11.4188 6.60947 11.7001V15.272Z"
                                    fill="" />
                                <path
                                    d="M15.4689 9.92822H11.8971C10.9408 9.92822 10.1533 10.7157 10.1533 11.672V15.2438C10.1533 16.2001 10.9408 16.9876 11.8971 16.9876H15.4689C16.4252 16.9876 17.2127 16.2001 17.2127 15.2438V11.7001C17.2127 10.7157 16.4252 9.92822 15.4689 9.92822ZM15.9752 15.272C15.9752 15.5532 15.7502 15.7782 15.4689 15.7782H11.8971C11.6158 15.7782 11.3908 15.5532 11.3908 15.272V11.7001C11.3908 11.4188 11.6158 11.1938 11.8971 11.1938H15.4689C15.7502 11.1938 15.9752 11.4188 15.9752 11.7001V15.272Z"
                                    fill="" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="group relative flex items-center gap-2 rounded-sm px-4 py-2 font-medium text-dark bg-dark duration-300 ease-in-out {{ request()->is('dashboard/products') ? 'text-red-600 bg-red-50' : '' }} hover:bg-red-100"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current" width="18" height="18"
                                viewBox="0 0 448 512"
                                fill="none"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M50.7 58.5L0 160l208 0 0-128L93.7 32C75.5 32 58.9 42.3 50.7 58.5zM240 160l208 0L397.3 58.5C389.1 42.3 372.5 32 354.3 32L240 32l0 128zm208 32L0 192 0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-224z" />
                            </svg>

                            Produk

                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current" width="20"
                                height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill="" />
                            </svg>
                        </a>
                        <div
                            class="translate transform overflow-hidden {{ request()->is('dashboard/products') ? '' : 'hidden' }}">
                            <ul class="mb-5.5 mt-4 flex flex-col gap-2 pl-6">
                                <li>
                                    <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/products') ? 'text-red-600' : '' }} hover:text-red-600"
                                        href="{{ route('dashboard.products.index') }}">Daftar Produk
                                    </a>
                                </li>
                                <li>
                                    <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/products/create') ? 'text-red-600' : '' }} hover:text-red-600"
                                        href="{{ route('dashboard.products.create') }}">Tambah Produk
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a class="group relative flex items-center gap-2 rounded-sm px-4 py-2 font-medium text-dark bg-dark duration-300 ease-in-out {{ request()->is('dashboard/categories') ? 'text-red-600 bg-red-50' : '' }} hover:bg-red-100"
                            href="#">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 512 512" fill="none"
                                xmlns="http://www.w3.org/2000/svg"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M345 39.1L472.8 168.4c52.4 53 52.4 138.2 0 191.2L360.8 472.9c-9.3 9.4-24.5 9.5-33.9 .2s-9.5-24.5-.2-33.9L438.6 325.9c33.9-34.3 33.9-89.4 0-123.7L310.9 72.9c-9.3-9.4-9.2-24.6 .2-33.9s24.6-9.2 33.9 .2zM0 229.5L0 80C0 53.5 21.5 32 48 32l149.5 0c17 0 33.3 6.7 45.3 18.7l168 168c25 25 25 65.5 0 90.5L277.3 442.7c-25 25-65.5 25-90.5 0l-168-168C6.7 262.7 0 246.5 0 229.5zM144 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                            </svg>

                            Kategori

                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current" width="20"
                                height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill="" />
                            </svg>
                        </a>
                        <div
                            class="translate transform overflow-hidden {{ request()->is('dashboard/categories') ? '' : 'hidden' }}">
                            <ul class="mb-5.5 mt-4 flex flex-col gap-2 pl-6">
                                <li>
                                    <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/categories') ? 'text-red-600' : '' }} hover:text-red-600"
                                        href="{{ route('dashboard.categories.index') }}">Daftar Kategori
                                    </a>
                                </li>
                                <li>
                                    <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/categories/create') ? 'text-red-600' : '' }} hover:text-red-600"
                                        href="{{ route('dashboard.categories.create') }}">Tambah Kategori
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a class="group relative flex items-center gap-2 rounded-sm px-4 py-2 font-medium text-dark bg-dark duration-300 ease-in-out {{ request()->is('dashboard/discounts') ? 'text-red-600 bg-red-50' : '' }} hover:bg-red-100"
                            href="#">
                            <svg class="fill-current" width="18" height="18" fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M112 224c61.9 0 112-50.1 112-112S173.9 0 112 0 0 50.1 0 112s50.1 112 112 112zm0-160c26.5 0 48 21.5 48 48s-21.5 48-48 48-48-21.5-48-48 21.5-48 48-48zm224 224c-61.9 0-112 50.1-112 112s50.1 112 112 112 112-50.1 112-112-50.1-112-112-112zm0 160c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zM392.3 .2l31.6-.1c19.4-.1 30.9 21.8 19.7 37.8L77.4 501.6a24 24 0 0 1 -19.6 10.2l-33.4 .1c-19.5 0-30.9-21.9-19.7-37.8l368-463.7C377.2 4 384.5 .2 392.3 .2z" />
                            </svg>

                            Diskon

                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current" width="20"
                                height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill="" />
                            </svg>
                        </a>
                        <div
                            class="translate transform overflow-hidden {{ request()->is('dashboard/discounts') ? '' : 'hidden' }}">
                            <ul class="mb-5.5 mt-4 flex flex-col gap-2 pl-6">
                                <li>
                                    <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/discounts') ? 'text-red-600' : '' }} hover:text-red-600"
                                        href="{{ route('dashboard.discounts.index') }}">Daftar Diskon
                                    </a>
                                </li>
                                <li>
                                    <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/discounts/create') ? 'text-red-600' : '' }} hover:text-red-600"
                                        href="{{ route('dashboard.discounts.create') }}">Tambah Diskon
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            @if (auth()->user()->role == 'admin')
                <div>
                    <h3 class="mb-4 ml-4 text-xl font-bold text-gray-800">Admin</h3>
                    <ul class="mb-6 flex flex-col gap-1">
                        <li>
                            <a class="group relative flex items-center gap-2 rounded-sm px-4 py-2 font-medium text-dark bg-dark duration-300 ease-in-out {{ request()->is('dashboard/members') ? 'text-red-600 bg-red-50' : '' }} hover:bg-red-100"
                                href="#">
                                <svg class="fill-current" width="18" height="18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path
                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                                </svg>

                                Member

                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>
                            <div
                                class="translate transform overflow-hidden {{ request()->is('dashboard/members') ? '' : 'hidden' }}">
                                <ul class="mb-5.5 mt-4 flex flex-col gap-2 pl-6">
                                    <li>
                                        <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/members') ? 'text-red-600' : '' }} hover:text-red-600"
                                            href="{{ route('dashboard.members.index') }}">Daftar Member
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/members/create') ? 'text-red-600' : '' }} hover:text-red-600"
                                            href="{{ route('dashboard.members.create') }}">Tambah Member
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a class="group relative flex items-center gap-2 rounded-sm px-4 py-2 font-medium text-dark bg-dark duration-300 ease-in-out {{ request()->is('dashboard/users') ? 'text-red-600 bg-red-50' : '' }} hover:bg-red-100"
                                href="#">
                                <svg class="fill-current" width="18" height="18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path
                                        d="M96 128l0-57.8c0-13.3 8.3-25.3 20.8-30l96-36c7.2-2.7 15.2-2.7 22.5 0l96 36c12.5 4.7 20.8 16.6 20.8 30l0 57.8-.3 0c.2 2.6 .3 5.3 .3 8l0 40c0 70.7-57.3 128-128 128s-128-57.3-128-128l0-40c0-2.7 .1-5.4 .3-8l-.3 0zm48 48c0 44.2 35.8 80 80 80s80-35.8 80-80l0-16-160 0 0 16zM111.9 327.7c10.5-3.4 21.8 .4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5C401 348.6 448 409.4 448 481.3c0 17-13.8 30.7-30.7 30.7L30.7 512C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6zM208 48l0 16-16 0c-4.4 0-8 3.6-8 8l0 16c0 4.4 3.6 8 8 8l16 0 0 16c0 4.4 3.6 8 8 8l16 0c4.4 0 8-3.6 8-8l0-16 16 0c4.4 0 8-3.6 8-8l0-16c0-4.4-3.6-8-8-8l-16 0 0-16c0-4.4-3.6-8-8-8l-16 0c-4.4 0-8 3.6-8 8z" />
                                </svg>

                                User

                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>
                            <div
                                class="translate transform overflow-hidden {{ request()->is('dashboard/users') ? '' : 'hidden' }}">
                                <ul class="mb-5.5 mt-4 flex flex-col gap-2 pl-6">
                                    <li>
                                        <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/users') ? 'text-red-600' : '' }} hover:text-red-600"
                                            href="{{ route('dashboard.users.index') }}">Daftar User
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/users/create') ? 'text-red-600' : '' }} hover:text-red-600"
                                            href="{{ route('dashboard.users.create') }}">Tambah User
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a class="group relative flex items-center gap-2 rounded-sm px-4 py-2 font-medium text-dark bg-dark duration-300 ease-in-out {{ request()->is('dashboard/transactions') ? 'text-red-600 bg-red-50' : '' }} hover:bg-red-100"
                                href="#">
                                <svg class="fill-current" width="18" height="18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path
                                        d="M14 2.2C22.5-1.7 32.5-.3 39.6 5.8L80 40.4 120.4 5.8c9-7.7 22.3-7.7 31.2 0L192 40.4 232.4 5.8c9-7.7 22.3-7.7 31.2 0L304 40.4 344.4 5.8c7.1-6.1 17.1-7.5 25.6-3.6s14 12.4 14 21.8l0 464c0 9.4-5.5 17.9-14 21.8s-18.5 2.5-25.6-3.6L304 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L192 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L80 471.6 39.6 506.2c-7.1 6.1-17.1 7.5-25.6 3.6S0 497.4 0 488L0 24C0 14.6 5.5 6.1 14 2.2zM96 144c-8.8 0-16 7.2-16 16s7.2 16 16 16l192 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L96 144zM80 352c0 8.8 7.2 16 16 16l192 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L96 336c-8.8 0-16 7.2-16 16zM96 240c-8.8 0-16 7.2-16 16s7.2 16 16 16l192 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L96 240z" />
                                </svg>

                                Transaksi

                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>
                            <div
                                class="translate transform overflow-hidden {{ request()->is('dashboard/transactions') ? '' : 'hidden' }}">
                                <ul class="mb-5.5 mt-4 flex flex-col gap-2 pl-6">
                                    <li>
                                        <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/transactions') ? 'text-red-600' : '' }} hover:text-red-600"
                                            href="{{ route('dashboard.transactions.index') }}">Daftar Transaksi
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2 rounded-md px-4 font-medium text-dark duration-300 ease-in-out {{ request()->is('dashboard/transactions/create') ? 'text-red-600' : '' }} hover:text-red-600"
                                            href="">Tambah Transaksi
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="group relative flex items-center gap-2 rounded-sm px-4 py-2 font-medium text-dark bg-dark duration-300 ease-in-out {{ request()->is('dashboard/reports') ? 'text-red-600 bg-red-50' : '' }} hover:bg-red-100"
                                href="">
                                <svg class="fill-current" width="18" height="18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path
                                        d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm64 236c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-64c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-72v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm96-114.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z" />
                                </svg>

                                Laporan
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </nav>
    </div>
</aside>
