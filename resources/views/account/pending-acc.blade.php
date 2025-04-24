<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Pending</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md text-center">
        <div class="text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mt-4">Account Pending</h1>
        <p class="text-gray-600 mt-2">Your account is currently pending approval. Please wait for further updates.</p>
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
