<!-- resources/views/layouts/sidebar.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex h-screen bg-gray-900">

    <!-- Sidebar -->
    <aside class="w-64 p-6  flex flex-col items-start space-y-6 text-white" style="background-color: #CBC3DCB2;" >
        <!-- Header Section -->
        <div class="flex flex-col items-start mb-8">
            <h1 class="text-2xl font-bold text-purple-800">GudangEasy</h1>
            <p class="text-sm font-light text-gray-200">Simple Stock Management</p>
        </div>

        <!-- Navigation Links -->
        <!-- Sidebar Navigation Links -->
        <ul class="flex flex-col space-y-4 w-full">
            <!-- Nama Barang Link -->
            <li>
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold 
                    {{ request()->routeIs('home') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-7a1 1 0 10-2 0v2a1 1 0 102 0v-2zm-1-3a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd" />
                    </svg>
                    Home
                </a>
            </li>

            <li>
                <a href="{{ route('inputbarang') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold 
                    {{ request()->routeIs('inputbarang') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-7a1 1 0 10-2 0v2a1 1 0 102 0v-2zm-1-3a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd" />
                    </svg>
                    Input Barang
                </a>
            </li>

            <!-- Barang Masuk Link -->
            <li>
                <a href="{{ route('barangmasuk') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg 
                    {{ request()->routeIs('barangmasuk') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white font-semibold' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16 2a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4a2 2 0 012-2h12zm-2 7V7h-2v2H9V7H7v2H5v2h2v2h2v-2h2v2h2v-2h2V9h-2z" clip-rule="evenodd" />
                    </svg>
                    Barang Masuk
                </a>
            </li>

             <!-- Stock Link -->
             <li>
                <a href="{{ route('stock') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg 
                    {{ request()->routeIs('stock') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white font-semibold' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16 2a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4a2 2 0 012-2h12zm-2 7V7h-2v2H9V7H7v2H5v2h2v2h2v-2h2v2h2v-2h2V9h-2z" clip-rule="evenodd" />
                    </svg>
                    Stock
                </a>
            </li>

             <!-- Kirim Barang Link -->
             <li>
                <a href="{{ route('kirimbarang') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg 
                    {{ request()->routeIs('kirimbarang') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white font-semibold' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16 2a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4a2 2 0 012-2h12zm-2 7V7h-2v2H9V7H7v2H5v2h2v2h2v-2h2v2h2v-2h2V9h-2z" clip-rule="evenodd" />
                    </svg>
                    Kirim Barang
                </a>
            </li>

             <!--  Barang Keluar Link -->
             <li>
                <a href="{{ route('barangkeluar') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg 
                    {{ request()->routeIs('barangkeluar') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white font-semibold' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16 2a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4a2 2 0 012-2h12zm-2 7V7h-2v2H9V7H7v2H5v2h2v2h2v-2h2v2h2v-2h2V9h-2z" clip-rule="evenodd" />
                    </svg>
                    Barang Keluar 
                </a>
            </li>
        </ul>

    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-100">
        @yield('content')
    </main>

</body>
</html>
