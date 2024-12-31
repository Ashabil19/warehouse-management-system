@extends('layouts.sidebar')

@section('title', 'Tambah Vendor')

@section('content')
<div class="container max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-purple-700 mb-8">Tambah Vendor</h1>

    <form action="{{ route('vendor.store') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label for="name" class="block text-gray-600 mb-2">Nama Vendor</label>
            <input type="text" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" id="name" name="name" required>
        </div>
        <div class="mb-6">
            <label for="contact_info" class="block text-gray-600 mb-2">Informasi Kontak</label>
            <input type="text" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" id="contact_info" name="contact_info">
        </div>
        <div class="mb-6">
            <label for="address" class="block text-gray-600 mb-2">Alamat</label>
            <input type="text" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" id="address" name="address">
        </div>
        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold rounded-full hover:from-green-600 hover:to-green-800">Simpan</button>
        <a href="{{ route('vendor.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-full hover:bg-gray-400">Kembali</a>
    </form>
</div>
@endsection
