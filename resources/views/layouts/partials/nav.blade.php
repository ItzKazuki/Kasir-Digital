<nav class="flex flex-row justify-between w-full h-20 px-8 items-center bg-white">
    <div>
        <img class="w-30" src="{{ asset('static/logo-340x180.png') }}" alt="">
    </div>
    <div class="flex flex-row gap-10">
        <a class="text-lg font-bold text-red-800" href="">Home</a>
        <a class="text-lg font-bold" href="">Products</a>
        <a class="text-lg font-bold" href="">Categories</a>
        <a class="text-lg font-bold" href="">Discounts</a>
        <a class="text-lg font-bold" href="">Dashboard</a>
    </div>
    <div class="flex flex-row gap-4">
        @auth
        <a class="bg-white hover:bg-red-100 hover:text-red-600 text-red-800 font-semibold py-3 px-8 border border-red-600 rounded-[10px]">Logout</a>
        @else
        <a class="bg-white hover:bg-red-100 hover:text-red-600 text-red-800 font-semibold py-3 px-8 border border-red-600 rounded-[10px]">Login</a>
        @endauth
    </div>
</nav>
