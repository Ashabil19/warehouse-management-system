<!DOCTYPE html>    
<html lang="en">    
<head>    
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>@yield('title')</title>    
    @php  
    $isProduction = app()->environment('production');  
    $manifestPath = $isProduction ? '../public_html/build/manifest.json' : public_path('build/manifest.json');  
@endphp  
  
@if ($isProduction && file_exists($manifestPath))  
    @php  
        $manifest = json_decode(file_get_contents($manifestPath), true);  
    @endphp  
    <link rel="stylesheet" href="{{ config('app.url') }}/build/{{ $manifest['resources/css/app.css']['file'] }}">  
    <script type="module" src="{{ config('app.url') }}/build/{{ $manifest['resources/js/app.js']['file'] }}"></script>  
@else  
    @viteReactRefresh  
    @vite(['resources/js/app.js', 'resources/css/app.css'])  
@endif     
    <style>    
        body {    
            overflow: hidden; /* Mencegah scroll pada body */    
        }    
        .sidebar {    
            overflow-y: auto; /* Scroll untuk sidebar */    
            height: 100vh; /* Mengatur tinggi sidebar */    
        }    
        .main-content {    
            overflow-y: auto; /* Scroll untuk konten utama */    
            height: 100vh; /* Mengatur tinggi konten utama */    
        }    
    </style>    
</head>    
<body class="flex h-screen bg-gray-900">    
    
    <!-- Sidebar -->    
    <aside class="w-64 p-6 flex flex-col items-start space-y-6 text-white sidebar" style="background-color: #CBC3DCB2;">    
        <!-- Header Section -->    
        <div class="flex flex-col items-start mb-8">    
            <h1 class="text-2xl font-bold text-purple-800">GudangEasy</h1>    
            <p class="text-sm font-light text-gray-200">Simple Stock Management</p>    
        </div>    
    
        <!-- Sidebar Navigation Links -->    
        <ul class="flex flex-col space-y-4 w-full">    
            <li>    
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold    
                    {{ request()->routeIs('home') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">    
                    Home    
                </a>    
            </li>    
    
            @if(Auth::check())    
                @if(Auth::user()->role == 'purchasing')    
                    <li>    
                        <a href="{{ route('vendor.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg    
                            {{ request()->routeIs('vendor.*') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white font-semibold' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">    
                            Vendor    
                        </a>    
                    </li>    
                    <li>    
                        <a href="{{ route('inputbarang') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold    
                            {{ request()->routeIs('inputbarang') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">    
                            Input Barang    
                        </a>    
                    </li>    
                    <li>    
                        <a href="{{ route('barangmasuk.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg    
                            {{ request()->routeIs('barangmasuk.index') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white font-semibold' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">    
                            Barang Masuk    
                        </a>    
                    </li>    
                    <li>    
                        <a href="{{ route('stock.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg    
                            {{ request()->routeIs('stock.index') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">    
                            Stock    
                        </a>    
                    </li>    
                @elseif(Auth::user()->role == 'logistik')    
                    <li>    
                        <a href="{{ route('barangmasuk.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg    
                            {{ request()->routeIs('barangmasuk.index') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white font-semibold' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">    
                            Barang Masuk    
                        </a>    
                    </li>    
                    <li>    
                        <a href="{{ route('stock.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg    
                            {{ request()->routeIs('stock.index') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">    
                            Stock Barang    
                        </a>    
                    </li>    
                    <li>    
                        <a href="{{ route('kirimbarang.create') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg    
                            {{ request()->routeIs('kirimbarang.create') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">    
                            Kirim Barang    
                        </a>    
                    </li>    
                    <li>  
                        <a href="{{ route('barangkeluar.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg  
                            {{ request()->routeIs('barangkeluar.index') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white' : 'text-gray-800 hover:text-white hover:bg-gray-600' }}">  
                            Barang Keluar  
                        </a>  
                    </li>  
                      
                @endif    
                <li>    
                    <form method="POST" action="{{ route('logout') }}">    
                        @csrf    
                        <a href="{{ route('logout') }}"    
                            class="flex items-center gap-3 px-4 py-2 rounded-lg bg-red-500    
                                   text-gray-800 hover:text-white hover:bg-red-600    
                                   {{ request()->routeIs('logout') ? 'bg-gradient-to-r from-blue-700 to-purple-600 text-white font-semibold' : '' }}"    
                            onclick="event.preventDefault(); this.closest('form').submit();">    
                            Log Out    
                        </a>    
                    </form>    
                </li>    
            @else    
                <li>    
                    <a href="{{ route('login') }}?redirect=/inputbarang" class="flex items-center gap-3 px-4 py-2 rounded-lg    
                        text-gray-800 hover:text-white hover:bg-gray-600">    
                        Purchasing    
                    </a>    
                </li>    
                <li>    
                    <a href="{{ route('login') }}?redirect=/barangmasuk" class="flex items-center gap-3 px-4 py-2 rounded-lg    
                        text-gray-800 hover:text-white hover:bg-gray-600">    
                        Logistik    
                    </a>    
                </li>    
            @endif    
        </ul>    
    </aside>    
    
    <!-- Main Content -->    
    <main class="flex-1 p-6 bg-gray-100 overflow-y-auto main-content">    
        @yield('content')    
    </main>    
    
</body>    
</html>    
