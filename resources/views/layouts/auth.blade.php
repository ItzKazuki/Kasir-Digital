<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir Digital | Login</title>

    {{-- style internal or external --}}
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
</body>
</html>
