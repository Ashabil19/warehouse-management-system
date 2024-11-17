@extends('layouts.sidebar')

@section('title', 'Kirim Barang')

@section('content')
<div class="p-10 bg-gray-50 min-h-screen">
    <!-- Flash Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Dropdown untuk Kode Barang -->
    <form action="/kirim-barang" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="flex items-center mb-6">
            <input list="barang-list" id="barang" name="barang" placeholder="Cari Barang..." 
                class="w-full px-4 py-2 text-sm bg-gray-100 border border-gray-300 rounded-l-md focus:outline-none focus:border-purple-500" />
            <datalist id="barang-list">
                <option value="HB01 - HOBO WATER LEVEL"></option>
                <option value="HB02 - TEMPERATURE SENSOR"></option>
                <option value="HB03 - PRESSURE SENSOR"></option>
            </datalist>
            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-r-md hover:bg-purple-700">
                <i class="fas fa-search">Search</i>
            </button>
        </div>

        <!-- Detail Barang -->
        <div class="bg-gray-100 p-6 rounded-lg mb-6 shadow">
            <h2 class="text-lg font-semibold text-purple-800 mb-4">DETAIL BARANG</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p><span class="font-semibold">Kode Barang:</span> HB01</p>
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
        <div class="grid grid-cols-2 gap-6 mb-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Nama Customer / perusahaan</label>
                <input type="text" name="nama_customer" class="w-full px-4 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:border-purple-500 bg-gray-100" />
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Alamat Customer</label>
                <textarea name="alamat_customer" class="w-full px-4 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:border-purple-500 bg-gray-100" rows="3"></textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Email Customer</label>
                <input type="email" name="email_customer" class="w-full px-4 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:border-purple-500 bg-gray-100" />
            </div>
        </div>
        <button type="submit" class="px-6 py-2 bg-green-500 text-white font-semibold rounded hover:bg-green-600">KIRIM</button>
    </form>
</div>
@endsection
