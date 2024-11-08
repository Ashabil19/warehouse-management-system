@extends('layouts.sidebar')

@section('title', 'Kirim Barang')

@section('content')
<div class="p-10 bg-gray-50 min-h-screen">
    <!-- Search Bar -->
    <div class="flex items-center mb-6">
        <input type="text" placeholder="Kode Barang (HB01) - Nama Barang (HOBO WATER LEVEL)" class="w-full px-4 py-2 text-sm bg-gray-100 border border-gray-300 rounded-l-md focus:outline-none focus:border-purple-500" />
        <button class="px-4 py-2 bg-purple-600 text-white rounded-r-md hover:bg-purple-700">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <!-- Detail Barang -->
    <div class="bg-gray-100 p-6 rounded-lg mb-6 shadow">
        <h2 class="text-lg font-semibold text-purple-800 mb-4">DETAIL BARANG</h2>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p><span class="font-semibold">Kode Barang:</span> HBO 01</p>
                <p><span class="font-semibold">Nama Barang:</span> HOBO WATER LEVEL</p>
                <p><span class="font-semibold">Kuantiti:</span> 12</p>
            </div>
            <div>
                <p><span class="font-semibold">Vendor:</span> ONSET</p>
                <p><span class="font-semibold">Kategori:</span> WATER LEVEL</p>
            </div>
        </div>
    </div>

    <!-- Form Customer -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-2 gap-6 mb-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Nama Customer</label>
                <input type="text" class="w-full px-4 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:border-purple-500 bg-gray-100" />
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Alamat Customer</label>
                <textarea class="w-full px-4 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:border-purple-500 bg-gray-100" rows="3"></textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Nama Perusahaan</label>
                <input type="text" class="w-full px-4 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:border-purple-500 bg-gray-100" />
            </div>
        </div>
        <button class="px-6 py-2 bg-green-500 text-white font-semibold rounded hover:bg-green-600">KIRIM</button>
    </div>
</div>

@endsection
