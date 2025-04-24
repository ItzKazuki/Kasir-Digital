<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Suspended</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md text-center">
        <div class="text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18.364 5.636a9 9 0 11-12.728 0m12.728 0L5.636 18.364" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mt-4">Account Suspended</h1>
        <p class="text-gray-600 mt-2">Your account has been suspended. Please contact support for more information.</p>
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
