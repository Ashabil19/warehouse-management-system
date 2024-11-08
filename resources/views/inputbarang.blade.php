@extends('layouts.sidebar')

@section('title', 'Input Brang')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-3xl font-bold text-purple-700 mb-8 text-right">INPUT BARANG</h2>
    
    <form action="{{ route('barangmasuk') }}" method="POST">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <!-- Kode Barang -->
            <div>
                <label class="block text-gray-600 mb-2">Kode Barang</label>
                <input type="text" name="kode_barang" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Harga Beli -->
            <div>
                <label class="block text-gray-600 mb-2">Harga Beli</label>
                <input type="number" name="harga_beli" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Nama Barang -->
            <div>
                <label class="block text-gray-600 mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-gray-600 mb-2">Kategori</label>
                <input type="text" name="kategori" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Kuantiti -->
            <div>
                <label class="block text-gray-600 mb-2">Kuantiti</label>
                <input type="number" name="kuantiti" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Deskripsi Barang (spans 2 rows vertically) -->
            <div class="col-span-1 row-span-2">
                <label class="block text-gray-600 mb-2">Deskripsi Barang</label>
                <textarea name="deskripsi_barang" rows="5" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <!-- Vendor -->
            <div>
                <label class="block text-gray-600 mb-2">Vendor</label>
                <input type="text" name="vendor" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-8 text-left">
            <button type="submit" class="px-24 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold rounded-full hover:from-green-600 hover:to-green-800">
                INPUT
            </button>
        </div>
        
    </form>
</div>

@endsection
