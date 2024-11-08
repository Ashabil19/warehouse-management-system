@extends('layouts.sidebar')

@section('title', 'Barang Keluar')

@section('content')
<div class=" w-full bg-white rounded-lg shadow-md p-6">
    <h2 class="text-center text-purple-600 font-semibold text-xl mb-4">KELUAR BARANG</h2>
    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b border-gray-200 text-left text-gray-600 font-semibold">No.</th>
                <th class="px-6 py-3 border-b border-gray-200 text-left text-gray-600 font-semibold">Kode Barang</th>
                <th class="px-6 py-3 border-b border-gray-200 text-left text-gray-600 font-semibold">Nama Barang</th>
                <th class="px-6 py-3 border-b border-gray-200 text-center text-gray-600 font-semibold">Stok Barang</th>
                <th class="px-6 py-3 border-b border-gray-200 text-center text-gray-600 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Row 1 -->
            <tr>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">1</td>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">HB01</td>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">HOBO WATER LEVEL</td>
                <td class="px-6 py-4 border-b border-gray-200 text-center">
                    <button class="bg-gray-200 text-gray-600 py-1 px-3 rounded-lg text-sm">Stok Barang</button>
                </td>
                <td class="px-6 py-4 border-b border-gray-200 text-center">
                    <span class="text-green-500 text-xl mr-2">✔️</span>
                    <span class="text-red-500 text-xl">❌</span>
                </td>
            </tr>
            <!-- Row 2 -->
            <tr>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">2</td>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">HB01</td>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">HOBO WATER LEVEL</td>
                <td class="px-6 py-4 border-b border-gray-200 text-center">
                    <button class="bg-gray-200 text-gray-600 py-1 px-3 rounded-lg text-sm">Stok Barang</button>
                </td>
                <td class="px-6 py-4 border-b border-gray-200 text-center">
                    <span class="text-green-500 text-xl mr-2">✔️</span>
                    <span class="text-red-500 text-xl">❌</span>
                </td>
            </tr>
            <!-- Row 3 -->
            <tr>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">3</td>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">HB01</td>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">HOBO WATER LEVEL</td>
                <td class="px-6 py-4 border-b border-gray-200 text-center">
                    <button class="bg-gray-200 text-gray-600 py-1 px-3 rounded-lg text-sm">Stok Barang</button>
                </td>
                <td class="px-6 py-4 border-b border-gray-200 text-center">
                    <span class="text-green-500 text-xl mr-2">✔️</span>
                    <span class="text-red-500 text-xl">❌</span>
                </td>
            </tr>
            <!-- Row 4 -->
            <tr>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">4</td>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">HB01</td>
                <td class="px-6 py-4 border-b border-gray-200 text-gray-700">HOBO WATER LEVEL</td>
                <td class="px-6 py-4 border-b border-gray-200 text-center">
                    <button class="bg-gray-200 text-gray-600 py-1 px-3 rounded-lg text-sm">Stok Barang</button>
                </td>
                <td class="px-6 py-4 border-b border-gray-200 text-center">
                    <span class="text-green-500 text-xl mr-2">✔️</span>
                    <span class="text-red-500 text-xl">❌</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
