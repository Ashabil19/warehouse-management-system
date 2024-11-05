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

    <!-- Vite & Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-purple-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-1/4 bg-purple-800 text-white p-6 flex flex-col justify-between rounded-r-3xl">
            <div>
                <h1 class="text-2xl font-bold mb-2">GudangEasy</h1>
                <p class="text-sm text-gray-300 mb-8">Simple Stock Management</p>

                <nav class="space-y-4">
                    <a href="/inputbarang" class="flex items-center text-purple-300 hover:text-white space-x-2">
                        <i class="fas fa-box"></i>
                        <span>Input Barang</span>
                    </a>
                    <a href="#" class="flex items-center bg-purple-600 p-2 rounded-md space-x-2">
                        <i class="fas fa-truck"></i>
                        <span>Barang Masuk</span>
                    </a>
                    <a href="#" class="flex items-center text-purple-300 hover:text-white space-x-2">
                        <i class="fas fa-archive"></i>
                        <span>Stok Barang</span>
                    </a>
                    <a href="#" class="flex items-center text-purple-300 hover:text-white space-x-2">
                        <i class="fas fa-paper-plane"></i>
                        <span>Kirim Barang</span>
                    </a>
                    <a href="#" class="flex items-center text-purple-300 hover:text-white space-x-2">
                        <i class="fas fa-arrow-right"></i>
                        <span>Barang Keluar</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10">
            <h2 class="text-3xl font-bold text-purple-800 mb-6">BARANG MASUK</h2>

            <div class="space-y-6">
                <!-- List of Items -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex justify-between items-center">
                        <p class="text-lg font-semibold">1. Kode Barang (HB01) - Nama Barang (HOBO WATER LEVEL)</p>
                        <button class="px-4 py-1 text-sm bg-purple-100 text-purple-600 font-semibold rounded-full hover:bg-purple-200">Stok Barang</button>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex justify-between items-center">
                        <p class="text-lg font-semibold">2. Kode Barang (HB01) - Nama Barang (HOBO WATER LEVEL)</p>
                        <button class="px-4 py-1 text-sm bg-purple-100 text-purple-600 font-semibold rounded-full hover:bg-purple-200">Stok Barang</button>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex justify-between items-center">
                        <p class="text-lg font-semibold">3. Kode Barang (HB01) - Nama Barang (HOBO WATER LEVEL)</p>
                        <button class="px-4 py-1 text-sm bg-purple-100 text-purple-600 font-semibold rounded-full hover:bg-purple-200">Stok Barang</button>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex justify-between items-center">
                        <p class="text-lg font-semibold">4. Kode Barang (HB01) - Nama Barang (HOBO WATER LEVEL)</p>
                        <button class="px-4 py-1 text-sm bg-purple-100 text-purple-600 font-semibold rounded-full hover:bg-purple-200">Stok Barang</button>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex justify-between items-center">
                        <p class="text-lg font-semibold">5. Kode Barang (HB01) - Nama Barang (HOBO WATER LEVEL)</p>
                        <button class="px-4 py-1 text-sm bg-purple-100 text-purple-600 font-semibold rounded-full hover:bg-purple-200">Stok Barang</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- FontAwesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
