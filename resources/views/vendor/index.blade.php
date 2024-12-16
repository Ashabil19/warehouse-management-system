@extends('layouts.sidebar')

@section('title', 'Daftar Vendor')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Vendor</h1>
    <a href="{{ route('vendor.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Vendor</a>

    @if (session('success'))
        <div class="alert alert-success bg-green-200 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Nama Vendor</th>
                <th class="py-2 px-4 border">Informasi Kontak</th>
                <th class="py-2 px-4 border">Alamat</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendors as $vendor)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border">{{ $vendor->id }}</td>
                    <td class="py-2 px-4 border">{{ $vendor->name }}</td>
                    <td class="py-2 px-4 border">{{ $vendor->contact_info }}</td>
                    <td class="py-2 px-4 border">{{ $vendor->address }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('vendor.edit', $vendor->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
