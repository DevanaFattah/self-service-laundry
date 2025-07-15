<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Self-Service Laundry</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flowbite.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        
    </style>
</head>
<body class="bg-gradient-to-br from-white-900 via-purple-500 to-blue-600 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 bg-white/81 backdrop-blur-md rounded-2xl shadow-xl transform transition-all duration-300 fade-in hover-glow hover:scale-105" >
        <div class="text-center mb-8">
            <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Welcome</h2>
            <p class="text-md text-black-300 mt-2">Selamat datang kembali di Laundry Merdeka</p>
        </div>
        @if (session('error'))
                    <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                @endif
        <form method="POST" action="/v1/auth" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                <div class="mt-1">
                    <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 placeholder-gray-400" placeholder="Enter your email" required>
                </div>
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <div class="mt-1">
                    <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 placeholder-gray-400" placeholder="Enter your password" required>
                </div>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-6 rounded-xl hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-105">
                Sign In
            </button>
            <div class="text-center">
                <p class="text-sm text-gray-600">Don't have an account? <a href="#" class="text-blue-400 hover:text-blue-600 transition duration-200 underline-offset-2 hover:underline">Ask Admin now!</a></p>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/flowbite.js') }}"></script>
</body>
</html>