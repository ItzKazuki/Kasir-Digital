<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir Digital | {{ $title }}</title>

    {{-- style internal or external --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-gray-100 flex min-h-screen">
        <div class="w-1/3 bg-white flex flex-col px-3 py-20 shadow-2xl">
            @yield('content-auth')
        </div>
        <div class="w-full flex items-center justify-center">
            <img src="{{ asset('static/logo-login.svg') }}" class="w-1/2" alt="">
        </div>
    </div>

    {{-- script untuk alert atau yang lain --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::sweetalert')
</body>

</html>
