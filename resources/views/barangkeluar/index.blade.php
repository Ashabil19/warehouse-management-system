@extends('layouts.sidebar')

@section('title', 'Barang Keluar')

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
                <td style="padding: 8px;">
                    <input type="text" 
                           value="{{ $kirim->link_resi }}" 
                           placeholder="Link Resi" 
                           class="border rounded p-1" 
                           id="link_resi_{{ $kirim->id }}" 
                           onkeypress="if(event.key === 'Enter') { updateLinkResi({{ $kirim->id }}); }">
                </td>
                <td style="padding: 8px;">
                    <button class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>





<script>
    function updateLinkResi(id) {
        const linkResi = document.getElementById(`link_resi_${id}`).value;

        fetch(`/kirimbarang/${id}/update-link-resi`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ link_resi: linkResi })
        })
        .then(response => {
            if (response.ok) {
                alert('Link Resi berhasil diperbarui!');
            } else {
                alert('Terjadi kesalahan saat memperbarui Link Resi.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection
