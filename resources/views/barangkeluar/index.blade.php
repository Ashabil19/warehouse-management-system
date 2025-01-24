@extends('layouts.sidebar')      
      
@section('title', 'Barang Keluar - GudangEasy')      
      
@section('content')      
<h1 style="color: #5B3E99; font-weight: bold; text-align: center;">BARANG KELUAR</h1>      
<a href="{{ route('kirimbarang.export') }}"     
    style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #5B3E99; color: #FFF; text-decoration: none; border-radius: 5px; font-weight: bold;">    
    Export to Excel    
</a>    
    
<div style="height: 85%; overflow-y: auto;">      
    <table id="kirimBarangTable" style="width: 100%; margin-top: 20px; border-collapse: collapse;">      
        <thead>      
            <tr>      
                <th style="text-align: left; padding: 8px; color: #5B3E99;">No.</th>      
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Nama Customer</th>      
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Alamat Customer</th>      
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Email Customer</th>      
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Barang</th>      
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Link Resi</th>      
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Actions</th>      
            </tr>      
        </thead>      
        
        <tbody>      
            @foreach ($kirimBarang as $index => $kirim)      
            <tr style="background-color: {{ $index % 2 == 0 ? '#F3F3F3' : '#FFFFFF' }};">      
                <td style="padding: 8px;">{{ $index + 1 }}.</td>      
                <td style="padding: 8px;">{{ $kirim->nama_customer }}</td>      
                <td style="padding: 8px;">{{ $kirim->alamat_customer }}</td>      
                <td style="padding: 8px;">{{ $kirim->email_customer }}</td>      
                <td style="padding: 8px;">{{ $kirim->stock->barangMasuk->nama_barang }}</td>      
                <td style="padding: 8px; word-wrap: break-word; max-width: 150px;">      
                    <a href="#" id="resi_{{ $kirim->id }}" class="text-blue-500 hover:underline">{{ $kirim->link_resi }}</a>      
                </td>      
                <td style="padding: 8px; background-color: #ffffff; border-radius: 5px;">      
                    <button onclick="openModal({{ $kirim->id }})" class="px-2 py-1 bg-blue-500 text-white rounded">  
                        {{ $kirim->link_resi ? 'Ganti Resi' : 'Tambah Link Resi' }}  
                    </button>      
                    <button class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>      
                </td>      
            </tr>      
            @endforeach      
        </tbody>      
    </table>      
</div>      
      
<!-- Modal untuk Input Link Resi -->      
<div id="linkResiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">      
    <div class="relative bg-white rounded-lg p-6 w-11/12 max-w-lg">      
        <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-800" style="font-size:34px" onclick="closeModal()">×</button>      
        <h2 class="text-2xl font-bold text-purple-800 mb-4">Tambah Link Resi</h2>      
        <input type="text" id="link_resi_input" class="border rounded p-2 w-full" placeholder="Masukkan Link Resi">      
        <div class="mt-4">      
            <button onclick="submitLinkResi()" class="px-4 py-2 bg-green-500 text-white rounded">Submit</button>      
            <button onclick="closeModal()" class="px-4 py-2 bg-red-500 text-white rounded">Batal</button>      
        </div>      
    </div>      
</div>      
      
<script>      
    let currentKirimId = null;      
      
    function openModal(id) {      
        currentKirimId = id;      
        document.getElementById('link_resi_input').value = document.getElementById(`resi_${id}`).innerText;      
        document.getElementById('linkResiModal').classList.remove('hidden');      
    }      
      
    function closeModal() {      
        document.getElementById('linkResiModal').classList.add('hidden');      
    }      
      
    function submitLinkResi() {      
        const linkResi = document.getElementById('link_resi_input').value;      
      
        fetch(`/kirimbarang/${currentKirimId}/update-link-resi`, {      
            method: 'PATCH',      
            headers: {      
                'Content-Type': 'application/json',      
                'X-CSRF-TOKEN': '{{ csrf_token() }}'      
            },      
            body: JSON.stringify({ link_resi: linkResi })      
        })      
        .then(response => {      
            if (response.ok) {      
                document.getElementById(`resi_${currentKirimId}`).innerText = linkResi;      
                alert('Link Resi berhasil diperbarui!');      
                closeModal();      
            } else {      
                alert('Terjadi kesalahan saat memperbarui Link Resi.');      
            }      
        })      
        .catch(error => console.error('Error:', error));      
    }      
</script>      
@endsection      
