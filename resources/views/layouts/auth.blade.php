<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | {{ $title }}</title>

    {{-- style internal or external --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-gray-100 flex min-h-screen flex-wrap flex-wrap-reverse">
        <div class="w-full md:w-1/2 xl:w-1/3 bg-white flex flex-col px-3 py-20 shadow-2xl">
            @yield('content-auth')
        </div>
        <div class="w-full md:w-1/2 xl:w-2/3 flex items-center justify-center">
            <img src="{{ asset('static/logo-login.svg') }}" class="w-3/4 md:w-1/2" alt="">
        </div>
    </div>

    {{-- script untuk alert atau yang lain --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::sweetalert')

    <script>
        // Force fullscreen for tablets or handphones
        if (window.matchMedia("(max-width: 1024px)").matches) {
            document.documentElement.requestFullscreen().catch(err => {
                console.warn(`Error attempting to enable fullscreen mode: ${err.message}`);
            });
        }
    </script>
</body>

</html>
