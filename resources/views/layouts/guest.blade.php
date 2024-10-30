<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        <div class="min-h-screen flex">
            <!-- Left Section -->
            <div class="w-1/2 bg-cover bg-center relative hidden md:flex flex-col items-center justify-center p-10 text-white space-y-4" style="background-image: url('https://www.mintsoft.com/media/chzlxsn3/types_of_warehouse_blog.png?width=1200&height=630&v=1dab8149acd8d70'); background-size: cover; background-position: center;">
                <!-- Semi-transparent overlay -->
                <div class="absolute inset-0 bg-purple-800 opacity-75"></div>
            
                <!-- Content inside the overlay -->
                <div class="relative z-10">
                    <div class="mb-5">
                        {{-- <img src="/path/to/your/logo.png" alt="Logo" class="w-20"> --}}
                        <img src="{{ asset('assets/taharica-logo.png') }}" alt="Logo" class="w-20">
                    </div>
                    <h1 class="text-5xl font-bold">Welcome to GudangEasy</h1>
                    <p class="text-lg">Your trusted warehouse management solution.</p>
                </div>
            </div>
            

            <!-- Right Section (Login Form) -->
            <div class="flex flex-col justify-center items-center w-full md:w-1/2 bg-white p-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
