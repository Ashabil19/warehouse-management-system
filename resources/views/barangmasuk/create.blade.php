@extends('layouts.sidebar')

@section('title', 'Input Barang')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-3xl font-bold text-purple-700 mb-8 text-right">INPUT BARANG</h2>
    
    <form action="{{ route('barangmasuk.store') }}" method="POST" onsubmit="return validateForm(event)">
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
                <input type="text" id="harga_beli" name="harga_beli" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" oninput="formatRupiah(this)">
            </div>
            
            <!-- Nama Barang -->
            <div>
                <label class="block text-gray-600 mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-gray-600 mb-2">Kategori</label>
                <select name="kategori" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Pilih Kategori</option>
                    <option value="Consumable">Consumable</option>
                    <option value="Stock">Stock</option>
                </select>
            </div>

            <!-- Kuantiti -->
            <div>
                <label class="block text-gray-600 mb-2">Kuantiti</label>
                <input type="number" name="kuantiti" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Deskripsi Barang -->
            <div class="col-span-1 row-span-2">
                <label class="block text-gray-600 mb-2">Deskripsi Barang</label>
                <textarea name="deskripsi_barang" rows="5" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <!-- Vendor -->
            <div>
                <label class="block text-gray-600 mb-2">Vendor</label>
                <select name="vendor" class="w-full px-4 py-2 bg-[#CBC3DC] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Pilih Vendor</option>
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
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

<!-- Modal -->
<div id="detailModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-xl font-bold text-purple-700 mb-4">DETAIL BARANG</h2>
        <p id="kode_barang"></p>
        <p id="nama_barang"></p>
        <p id="kuantiti"></p>
        <p id="vendor"></p>
        <p id="kategori"></p>
        <p id="harga_beli"></p>
        <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">Tutup</button>
        <button onclick="submitForm()" class="mt-4 px-4 py-2 bg-green-500 text-white rounded">Kirim</button>
    </div>
</div>

<style>
    #detailModal {
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>

<script>
    function formatRupiah(angka) {
        let numberString = angka.value.replace(/[^,\d]/g, '').toString();
        let split = numberString.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        angka.value = rupiah;
    }

    function validateForm(event) {
        event.preventDefault(); // Mencegah form dari pengiriman otomatis

        // Ambil nilai dari input
        const kodeBarang = document.querySelector('input[name="kode_barang"]').value;
        const namaBarang = document.querySelector('input[name="nama_barang"]').value;
        const hargaBeli = document.querySelector('input[name="harga_beli"]').value;
        const kategori = document.querySelector('select[name="kategori"]').value;
        const kuantiti = document.querySelector('input[name="kuantiti"]').value;
        const deskripsiBarang = document.querySelector('textarea[name="deskripsi_barang"]').value;
        const vendor = document.querySelector('select[name="vendor"]').value;

        // Cek apakah semua field terisi
        if (!kodeBarang || !namaBarang || !hargaBeli || !kategori || !kuantiti || !vendor) {
            alert("Semua field harus diisi!");
            return false;
        }

        // Isi modal dengan data
        document.getElementById('kode_barang').innerText = 'Kode Barang: ' + kodeBarang;
        document.getElementById('nama_barang').innerText = 'Nama Barang: ' + namaBarang;
        document.getElementById('kuantiti').innerText = 'Kuantiti: ' + kuantiti;
        document.getElementById('vendor').innerText = 'Vendor: ' + vendor;
        document.getElementById('kategori').innerText = 'Kategori: ' + kategori;
        document.getElementById('harga_beli').innerText = 'Harga Beli: ' + hargaBeli;

        // Tampilkan modal
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    function submitForm() {
        document.querySelector('form').submit(); // Kirim form
    }
</script>
@endsection
