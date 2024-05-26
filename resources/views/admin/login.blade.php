<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/flowbite/dist/flowbite.min.css" rel="stylesheet">
</head>
<body class="h-screen flex items-center justify-center p-4 bg-cover bg-center bg-fixed" style="background-image: url('assets/img/bgelitery.png');">
    <div class="w-full max-w-md p-6 rounded-xl bg-white bg-opacity-90 backdrop-filter backdrop-blur-lg shadow-xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Welcome Back!</h1>
            <p class="text-gray-500">Sign in to continue</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div class="group">
                <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                <div class="relative mt-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12V13C16 14.886 14.886 16 13 16H7C5.114 16 4 14.886 4 13V7C4 5.114 5.114 4 7 4H13C14.886 4 16 5.114 16 7V8"></path>
                        </svg>
                    </span>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
            </div>

            <div class="group">
                <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                <div class="relative mt-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12V13C16 14.886 14.886 16 13 16H7C5.114 16 4 14.886 4 13V7C4 5.114 5.114 4 7 4H13C14.886 4 16 5.114 16 7V8"></path>
                        </svg>
                    </span>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>
                <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
            </div>

            <button type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Sign In
            </button>
        </form>
    </div>
    <script src="https://unpkg.com/flowbite/dist/flowbite.min.js"></script>
</body>
</html>
