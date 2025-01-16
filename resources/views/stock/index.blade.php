@extends('layouts.sidebar')

@section('title', 'Stock Barang')

@section('content')
<h1 style="color: #5B3E99; font-weight: bold; text-align: center;">STOCK BARANG</h1>
<div style="display:flex; justify-content:space-between; align-items:center">
    <a href="{{ route('stock.export') }}" 
        style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #5B3E99; color: #FFF; text-decoration: none; border-radius: 5px; font-weight: bold;">
        Export to Excel
    </a>


    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-responsive-nav-link>
    </form>
</div>

<div style="height: 85%; overflow-y: auto;">
    <table id="stockTable" style="width: 100%; margin-top: 20px; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="text-align: left; padding: 8px; color: #5B3E99;">NO</th>
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Nama Barang</th>
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Tipe Barang</th>
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Vendor</th>
                <th style="text-align: right; padding: 8px; color: #5B3E99;">Jumlah</th>
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Deskripsi</th>
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $index => $stock)
            <tr style="background-color: {{ $index % 2 == 0 ? '#F3F3F3' : '#FFFFFF' }};">
                <td style="padding: 8px; width: 50px;">{{ $index + 1 }}.</td>
                <td style="padding: 8px;">
                    <p style="font-weight: bold;">{{ $stock->barangMasuk->nama_barang }}</p>
                </td>
                <td style="padding: 8px;">{{ $stock->barangMasuk->tipe_barang }}</td>
                <td style="padding: 8px;">{{ $stock->barangMasuk->vendor }}</td>
                <td style="padding: 8px; text-align: right; font-weight: bold; font-size: 18px;">{{ $stock->jumlah }}</td>
                <td style="padding: 8px;">{{ Str::limit($stock->barangMasuk->deskripsi_barang, 30) }}</td>
                <td style="padding: 8px;">
                    <button onclick="openModal({{ $stock->barangMasuk->id }})" class="px-4 py-2 bg-blue-200 text-black border border-purple-500 rounded font-bold hover:bg-purple-500 hover:text-white transition">
                        Detail
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal untuk Detail Barang -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="relative bg-white rounded-lg p-6 w-11/12 max-w-lg">
        <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-800" style="font-size:34px" onclick="closeModal()">×</button>
        <h2 class="text-2xl font-bold text-purple-800 mb-4">DETAIL BARANG</h2>
        <div id="modalBody" class="text-gray-700">
            <!-- Data akan diisi di sini dengan JavaScript -->
        </div>
        <img id="modalImage" class="mt-4 rounded-lg w-full" alt="Gambar Barang" src="">
    </div>
</div>

<script>
  function openModal(id) {  
    fetch(`/barangmasuk/${id}`)  
        .then(response => response.json())  
        .then(data => {  
            const modalBody = document.getElementById('modalBody');  
            const modalImage = document.getElementById('modalImage');  
  
            // Format waktu  
            const date = new Date(data.tanggal_masuk);  
            const formattedTanggalMasuk = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')} ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}`;  
  
            modalBody.innerHTML = `  
                <p><strong>Nama Barang:</strong> ${data.nama_barang}</p>  
                <p><strong>Vendor:</strong> ${data.vendor}</p>  
                <p><strong>Kuantiti:</strong> ${data.kuantiti}</p>  
                <p><strong>Tanggal Masuk:</strong> ${formattedTanggalMasuk}</p>  
                <p><strong>Deskripsi:</strong> ${data.deskripsi_barang || 'Tidak ada'}</p>  
                <p><strong>Tipe Barang:</strong> ${data.tipe_barang || 'Tidak ada'}</p>  
                <p><strong>Serial Number:</strong> ${data.serial_number || 'Tidak ada'}</p>  
                <p><strong>Tempat Penyimpanan:</strong> ${data.tempat_penyimpanan || 'Tidak ada'}</p>  
            `;  
            modalImage.src = data.gambar_barang || 'default-image.jpg';  
            document.getElementById('detailModal').classList.remove('hidden');  
        })  
        .catch(error => console.error('Error fetching data:', error));  
}  

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>

@endsection
