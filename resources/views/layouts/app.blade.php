<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir Digital | {{ $title }}</title>

    {{-- style internal or external --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @include('layouts.partials.nav')

    <div class="p-8">
        @yield('content')
    </div>
</body>
</html>
