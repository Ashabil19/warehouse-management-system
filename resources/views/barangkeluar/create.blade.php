@extends('layouts.sidebar')

@section('title', 'Kirim Barang')

@section('content')
<div class="p-10 bg-gray-100 min-h-screen">
    <form action="{{ route('kirimbarang.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Search Bar -->
        <div class="mb-6">
            <label for="barang_id" class="block mb-2 text-sm font-medium text-gray-700">Pilih Barang</label>
            <div class="flex items-center bg-indigo-100 rounded-lg p-4">
                <div class="bg-indigo-500 text-white rounded-full p-2 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l-6-6m0 0l6-6m-6 6h20"/>
                    </svg>
                </div>
                <select 
                    name="barang_id" 
                    id="barang_id" 
                    class="w-full bg-transparent text-gray-600 placeholder-gray-500 focus:outline-none focus:ring focus:ring-indigo-200" 
                    required
                >
                    <option value="" disabled selected>Pilih Barang</option>
                    @foreach($barangList as $stock)
                        <option 
                            value="{{ $stock->id }}" 
                            data-nama="{{ $stock->barangmasuk->nama_barang }}" 
                            data-kode="{{ $stock->barangmasuk->kode_barang }}" 
                            data-vendor="{{ $stock->barangmasuk->vendor }}" 
                            data-kategori="{{ $stock->barangmasuk->kategori }}" 
                            data-kuantiti="{{ $stock->jumlah }}"
                        >
                            {{ $stock->barangmasuk->nama_barang }} ({{ $stock->barangmasuk->kode_barang }})
                        </option>
                    @endforeach
                </select>
            </div>
            @error('barang_id')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Jumlah Kirim Field -->
        <div class="mb-6">
            <label for="jumlah_kirim" class="block mb-2 text-sm font-medium text-gray-700">Jumlah Kirim</label>
            <input type="number" name="jumlah_kirim" id="jumlah_kirim" class="mt-1 w-full p-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            @error('jumlah_kirim')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Details Section -->
        <div class="bg-gray-100 rounded-lg p-6">
            <h4 class="text-lg font-bold text-indigo-700 mb-4">DETAIL BARANG</h4>
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                <div>
                    <p><strong>Kode Barang:</strong> <span id="kode_barang">-</span></p>
                    <p><strong>Nama Barang:</strong> <span id="nama_barang">-</span></p>
                    <p><strong>Kuantiti:</strong> <span id="kuantiti">-</span></p>
                    <p><strong>Gambar:</strong></p>
                    <img id="gambar_barang" src="" alt="Gambar Barang" class="mt-2" style="max-width: 100%; height: auto; display: none;">
                </div>
                <div>
                    <p><strong>Vendor:</strong> <span id="vendor">-</span></p>
                    <p><strong>Kategori:</strong> <span id="kategori">-</span></p>
                </div>
            </div>
        </div>

        <!-- Input Fields -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="nama_customer" class="block text-sm font-medium text-gray-700">Nama Customer</label>
                <input type="text" name="nama_customer" id="nama_customer" class="mt-1 w-full p-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
            <div>
                <label for="alamat_customer" class="block text-sm font-medium text-gray-700">Alamat Customer</label>
                <input type="text" name="alamat_customer" id="alamat_customer" class="mt-1 w-full p-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
        </div>

        <div>
            <label for="email_customer" class="block text-sm font-medium text-gray-700">Email Customer</label>
            <input type="email" name="email_customer" id="email_customer" class="mt-1 w-full p-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label for="no_surat_jalan" class="block text-sm font-medium text-gray-700">No Surat Jalan</label>
            <input type="text" name="no_surat_jalan" id="no_surat_jalan" class="mt-1 w-full p-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label for="no_po" class="block text-sm font-medium text-gray-700">No PO</label>
            <input type="text" name="no_po" id="no_po" class="mt-1 w-full p-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label for="no_telepon" class="block text-sm font-medium text-gray-700">No Telepon</label>
            <input type="text" name="no_telepon" id="no_telepon" class="mt-1 w-full p-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label for="pic" class="block text-sm font-medium text-gray-700">PIC (Person In Charge)</label>
            <input type="text" name="pic" id="pic" class="mt-1 w-full p-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label for="shipper" class="block text-sm font-medium text-gray-700">Shipper</label>
            <input type="text" name="shipper" id="shipper" class="mt-1 w-full p-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="mt-1 w-full p-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        <button type="submit" class="w-full py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            KIRIM
        </button>
    </form>

    <script>
        const selectBarang = document.getElementById('barang_id');
        selectBarang.addEventListener('change', function() {
            const selectedOption = selectBarang.options[selectBarang.selectedIndex];

            // Update detail fields
            document.getElementById('kode_barang').textContent = selectedOption.getAttribute('data-kode') || '-';
            document.getElementById('nama_barang').textContent = selectedOption.getAttribute('data-nama') || '-';
            document.getElementById('vendor').textContent = selectedOption.getAttribute('data-vendor') || '-';
            document.getElementById('kategori').textContent = selectedOption.getAttribute('data-kategori') || '-';
            document.getElementById('kuantiti').textContent = selectedOption.getAttribute('data-kuantiti') || '-';

            // Update image
            const gambar = selectedOption.getAttribute('data-gambar');
            const gambarElement = document.getElementById('gambar_barang');
            if (gambar) {
                gambarElement.src = gambar;
                gambarElement.style.display = 'block'; // Show the image
            } else {
                gambarElement.src = '';
                gambarElement.style.display = 'none'; // Hide the image
            }
        });
    </script>
</div>
@endsection
