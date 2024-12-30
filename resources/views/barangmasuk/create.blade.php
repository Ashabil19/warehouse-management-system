@extends('layouts.sidebar')

@section('title', 'Input Barang')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-3xl font-bold text-purple-700 mb-8 text-right">INPUT BARANG</h2>
    
    <form id="barangMasukForm" action="{{ route('barangmasuk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <!-- Kode Barang -->
            <div>
                <label class="block text-gray-600 mb-2">Kode Barang</label>
                <input type="text" name="kode_barang" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>

            <!-- Harga Beli -->
            <div>
                <label class="block text-gray-600 mb-2">Harga Beli</label>
                <input type="number" name="harga_beli" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>

            <!-- Nama Barang -->
            <div>
                <label class="block text-gray-600 mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-gray-600 mb-2">Kategori</label>
                <select name="kategori" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Consumable">Consumable</option>
                    <option value="Stock">Stock</option>
                </select>
            </div>

            <!-- Kuantiti -->
            <div>
                <label class="block text-gray-600 mb-2">Kuantiti</label>
                <input type="number" name="kuantiti" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>

            <!-- Deskripsi Barang -->
            <div class="col-span-1 row-span-2">
                <label class="block text-gray-600 mb-2">Deskripsi Barang</label>
                <textarea name="deskripsi_barang" rows="5" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <!-- Vendor -->
            <div>
                <label class="block text-gray-600 mb-2">Vendor</label>
                <select name="vendor" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <option value="">Pilih Vendor</option>
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tipe Barang -->
            <div>
                <label class="block text-gray-600 mb-2">Tipe Barang</label>
                <input type="text" name="tipe_barang" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Serial Number -->
            <div>
                <label class="block text-gray-600 mb-2">Serial Number</label>
                <input type="text" name="serial_number" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Tempat Penyimpanan -->
            <div>
                <label class="block text-gray-600 mb-2">Tempat Penyimpanan</label>
                <input type="text" name="tempat_penyimpanan" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Gambar -->
            <div>
                <label class="block text-gray-600 mb-2">Gambar</label>
                <input type="file" name="attachment_gambar" accept="image/*" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-8 text-left">
            <button type="button" onclick="showModal()" class="px-24 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold rounded-full hover:from-green-600 hover:to-green-800">
                INPUT
            </button>
        </div>
    </form>
</div>

<!-- Modal Konfirmasi -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="relative bg-white rounded-lg p-6 w-11/12 max-w-lg">
        <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-800" style="font-size:34px" onclick="closeModal()">×</button>
        <h2 class="text-2xl font-bold text-purple-800 mb-4">Konfirmasi Input Barang</h2>
        <p>Apakah Anda yakin ingin menambahkan barang ini?</p>
        <div class="mt-4">
            <button onclick="submitForm()" class="px-4 py-2 bg-green-500 text-white rounded">Ya</button>
            <button onclick="closeModal()" class="px-4 py-2 bg-red-500 text-white rounded">Tidak</button>
        </div>
    </div>
</div>

<script>
    function showModal() {
        document.getElementById('confirmModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('confirmModal').classList.add('hidden');
    }

    function submitForm() {
        document.getElementById('barangMasukForm').submit();
    }
</script>

@endsection