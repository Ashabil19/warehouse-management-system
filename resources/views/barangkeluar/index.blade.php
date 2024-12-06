@extends('layouts.sidebar')

@section('title', 'Detail Kirim Barang')

@section('content')


<h1 style="color: #5B3E99; font-weight: bold; text-align: center;">BARANG KELUAR</h1>
<a href="{{ route('kirimbarang.export') }}" 
   style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #5B3E99; color: #FFF; text-decoration: none; border-radius: 5px; font-weight: bold;">
   Export to Excel
</a>
<div class="p-10 bg-gray-100 ">
    {{-- <h1 class="text-2xl font-semibold text-gray-800 mb-4">Detail Kirim Barang</h1>
    <div class="flex justify-end mb-4">
        <a href="{{ route('kirimbarang.export') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
            Export to Excel
        </a>
    </div> --}}
    
    <div style="height: 70%; overflow-y: auto;"> <!-- Add this div wrapper -->
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nomor</th>  <!-- Ganti ID menjadi Nomor -->
                    <th class="px-4 py-2">Nama Customer</th>
                    <th class="px-4 py-2">Alamat Customer</th>
                    <th class="px-4 py-2">Nama Barang</th>
                    <th class="px-4 py-2">Email Customer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kirimBarang as $index => $item) <!-- Menambahkan $index untuk nomor urut -->
                <tr>
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>  <!-- Menampilkan Nomor -->
                    <td class="border px-4 py-2">{{ $item->nama_customer }}</td>
                    <td class="border px-4 py-2">{{ $item->alamat_customer }}</td>
                    
                    <!-- Menampilkan nama_barang yang ada di relasi barangMasuk -->
                    <td class="border px-4 py-2">
                        @if($item->stock && $item->stock->barangMasuk)
                            {{ $item->stock->barangMasuk->nama_barang }}  <!-- Mengakses nama_barang dari barangMasuk -->
                        @else
                            Tidak Tersedia
                        @endif
                    </td>
                    
                    <td class="border px-4 py-2">{{ $item->email_customer }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- End of div wrapper -->
    
</div>
@endsection