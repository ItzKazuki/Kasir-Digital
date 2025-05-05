<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Can't Access This Page, Sorry</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md text-center">
        @yield('content')
        <div class="mt-6 flex justify-center space-x-4">
            <a href="mailto:support@example.com"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Contact Support</a>
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Logout</button>
            </form>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>

</html>
