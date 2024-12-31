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
                <input type="text" name="kode_barang" id="kode_barang" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>

            <!-- Harga Beli -->
            <div>
                <label class="block text-gray-600 mb-2">Harga Beli</label>
                <input type="text" name="harga_beli" id="harga_beli" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required oninput="formatCurrency(this)">
            </div>

            <!-- Nama Barang -->
            <div>
                <label class="block text-gray-600 mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-gray-600 mb-2">Kategori</label>
                <select name="kategori" id="kategori" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Consumable">Consumable</option>
                    <option value="Stock">Stock</option>
                </select>
            </div>

            <!-- Kuantiti -->
            <div>
                <label class="block text-gray-600 mb-2">Kuantiti</label>
                <input type="text" name="kuantiti" id="kuantiti" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required oninput="formatCurrency(this)">
            </div>

            <!-- Deskripsi Barang -->
            <div class="col-span-1 row-span-2">
                <label class="block text-gray-600 mb-2">Deskripsi Barang</label>
                <textarea name="deskripsi_barang" id="deskripsi_barang" rows="5" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <!-- Vendor -->
            <div>
                <label class="block text-gray-600 mb-2">Vendor</label>
                <select name="vendor" id="vendor" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <option value="">Pilih Vendor</option>
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tipe Barang -->
            <div>
                <label class="block text-gray-600 mb-2">Tipe Barang</label>
                <input type="text" name="tipe_barang" id="tipe_barang" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Serial Number -->
            <div>
                <label class="block text-gray-600 mb-2">Serial Number</label>
                <input type="text" name="serial_number" id="serial_number" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Tempat Penyimpanan -->
            <div>
                <label class="block text-gray-600 mb-2">Tempat Penyimpanan</label>
                <input type="text" name="tempat_penyimpanan" id="tempat_penyimpanan" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Gambar -->
            <div>
                <label class="block text-gray-600 mb-2">Gambar</label>
                <input type="file" name="attachment_gambar" id="attachment_gambar" accept="image/*" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
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
            <p><strong>Kode Barang:</strong> <span id="modal_kode_barang"></span></p>
            <p><strong>Nama Barang:</strong> <span id="modal_nama_barang"></span></p>
            <p><strong>Harga Beli:</strong> <span id="modal_harga_beli"></span></p>
            <p><strong>Kuantiti:</strong> <span id="modal_kuantiti"></span></p>
            <p><strong>Kategori:</strong> <span id="modal_kategori"></span></p>
            <p><strong>Deskripsi Barang:</strong> <span id="modal_deskripsi_barang"></span></p>
            <p><strong>Vendor:</strong> <span id="modal_vendor"></span></p>
            <p><strong>Tipe Barang:</strong> <span id="modal_tipe_barang"></span></p>
            <p><strong>Serial Number:</strong> <span id="modal_serial_number"></span></p>
            <p><strong>Tempat Penyimpanan:</strong> <span id="modal_tempat_penyimpanan"></span></p>
            <p><strong>Gambar:</strong> <img id="modal_gambar" src="" alt="Gambar" class="mt-2" style="max-width: 100%; height: auto;"></p>
        </div>

        <div class="mt-4">
            <button onclick="submitForm()" class="px-4 py-2 bg-green-500 text-white rounded">Ya</button>
            <button onclick="closeModal()" class="px-4 py-2 bg-red-500 text-white rounded">Tidak</button>
        </div>
    </div>
</div>

<script>
    function formatCurrency(input) {
        // Menghapus semua karakter yang bukan angka
        let value = input.value.replace(/[^0-9]/g, '');
        
        // Format menjadi mata uang dengan titik sebagai pemisah ribuan
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Mengupdate nilai input
        input.value = value;
    }

    function showModal() {
        // Ambil nilai dari form
        document.getElementById('modal_kode_barang').innerText = document.getElementById('kode_barang').value;
        document.getElementById('modal_nama_barang').innerText = document.getElementById('nama_barang').value;
        document.getElementById('modal_harga_beli').innerText = document.getElementById('harga_beli').value;
        document.getElementById('modal_kuantiti').innerText = document.getElementById('kuantiti').value;
        document.getElementById('modal_kategori').innerText = document.getElementById('kategori').value;
        document.getElementById('modal_deskripsi_barang').innerText = document.getElementById('deskripsi_barang').value;
        document.getElementById('modal_vendor').innerText = document.getElementById('vendor').value;
        document.getElementById('modal_tipe_barang').innerText = document.getElementById('tipe_barang').value;
        document.getElementById('modal_serial_number').innerText = document.getElementById('serial_number').value;
        document.getElementById('modal_tempat_penyimpanan').innerText = document.getElementById('tempat_penyimpanan').value;

        // Ambil gambar jika ada
        const fileInput = document.getElementById('attachment_gambar');
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('modal_gambar').src = e.target.result;
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('modal_gambar').src = '';
        }

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
