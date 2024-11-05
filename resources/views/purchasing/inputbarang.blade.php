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
                    <a href="/inputbarang" class="flex items-center bg-purple-600 p-2 rounded-md space-x-2">
                        <i class="fas fa-box"></i>
                        <span>Nama Barang</span>
                    </a>
                    <a href="/purchasing" class="flex items-center text-purple-300 hover:text-white space-x-2">
                        <i class="fas fa-truck"></i>
                        <span>Barang Masuk</span>
                    </a>
                    <a href="/logistik" class="flex items-center text-purple-300 hover:text-white space-x-2">
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
        <div class="flex-1 p-10">
            <h2 class="text-2xl font-bold text-purple-800 mb-8 text-right">INPUT BARANG</h2>
        
            <form action="#" method="POST" class="grid grid-cols-2 gap-6">
                <!-- Kode Barang -->
                <div class="flex flex-col">
                    <label for="kode-barang" class="text-sm font-medium text-gray-700">Kode Barang</label>
                    <input type="text" id="kode-barang" name="kode-barang" class="mt-1 p-3 border border-purple-200 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 bg-purple-50">
                </div>
        
                <!-- Harga Beli -->
                <div class="flex flex-col">
                    <label for="harga-beli" class="text-sm font-medium text-gray-700">Harga Beli</label>
                    <input type="number" id="harga-beli" name="harga-beli" class="mt-1 p-3 border border-purple-200 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 bg-purple-50">
                </div>
        
                <!-- Nama Barang -->
                <div class="flex flex-col">
                    <label for="nama-barang" class="text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" id="nama-barang" name="nama-barang" class="mt-1 p-3 border border-purple-200 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 bg-purple-50">
                </div>
        
                <!-- Kategori -->
                <div class="flex flex-col">
                    <label for="kategori" class="text-sm font-medium text-gray-700">Kategori</label>
                    <select id="kategori" name="kategori" class="mt-1 p-3 border border-purple-200 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 bg-purple-50">
                        <option value="water-level">Water Level</option>
                        <option value="hardness-tester">Hardness Tester</option>
                    </select>
                </div>
        
                <!-- Kuantiti -->
                <div class="flex flex-col">
                    <label for="kuantiti" class="text-sm font-medium text-gray-700">Kuantiti</label>
                    <input type="number" id="kuantiti" name="kuantiti" class="mt-1 p-3 border border-purple-200 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 bg-purple-50">
                </div>
        
                <!-- Vendor -->
                <div class="flex flex-col">
                    <label for="vendor" class="text-sm font-medium text-gray-700">Vendor</label>
                    <select id="vendor" name="vendor" class="mt-1 p-3 border border-purple-200 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 bg-purple-50">
                        <option value="hobo">Hobo</option>
                        <option value="rika">Rika</option>
                        <option value="time">Time</option>
                    </select>
                </div>
        
                <!-- Deskripsi Barang (Text Area) -->
                <div class="flex flex-col col-span-2">
                    <label for="deskripsi-barang" class="text-sm font-medium text-gray-700">Deskripsi Barang</label>
                    <textarea id="deskripsi-barang" name="deskripsi-barang" rows="3" class="mt-1 p-3 border border-purple-200 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 bg-purple-50"></textarea>
                </div>
        
                <!-- Tombol Input -->
                <div class="col-span-2 text-center">
                    <button type="submit" class="px-6 py-2 bg-green-500 text-white font-semibold rounded-full hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">INPUT</button>
                </div>
            </form>
        
        </div>
        
    </div>

    <!-- FontAwesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
