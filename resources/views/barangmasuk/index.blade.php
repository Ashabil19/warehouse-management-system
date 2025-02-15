@extends('layouts.sidebar')        
  
@section('title', 'Barang Masuk')        
  
@section('content')        
  
<h1 style="color: #5B3E99; font-weight: bold; text-align: center;">BARANG MASUK</h1>      
  
@if(auth()->user()->role === 'purchasing')        
    <a href="{{ route('barangmasuk.export') }}"         
        style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #5B3E99; color: #FFF; text-decoration: none; border-radius: 5px; font-weight: bold;">        
        Export to Excel        
    </a>        
@endif        
  
@if(auth()->user()->role === 'logistik')        
    <a href="{{ route('exports.logistik') }}"         
        style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #5B3E99; color: #FFF; text-decoration: none; border-radius: 5px; font-weight: bold;">        
        Export to Excel        
    </a>        
@endif      
  
<div style="height: 85%; overflow-y: auto;">        
    <table class="w-full mt-5 border-collapse">        
        <thead>        
            <tr>        
                <th class="text-left px-4 py-2 font-bold">No.</th>        
                <th class="text-left px-4 py-2 font-bold">Nama Barang</th>        
                <th class="text-left px-4 py-2 font-bold">Vendor</th>        
                <th class="text-left px-4 py-2 font-bold">Kuantiti</th>        
                <th class="text-left px-4 py-2 font-bold">Tanggal</th>        
                <th class="text-left px-4 py-2 font-bold">Actions</th>        
            </tr>        
        </thead>        
        <tbody>        
            @foreach ($barangMasuk as $index => $barang)        
                <tr>        
                    <td class="px-4 py-2">{{ $index + 1 }}</td>        
                    <td class="px-4 py-2">{{ $barang->nama_barang }}</td>        
                    <td class="px-4 py-2">{{ $barang->vendor }}</td>        
                    <td class="px-4 py-2">{{ $barang->kuantiti }}</td>        
                    <td class="px-4 py-2">{{ $barang->created_at }}</td>        
  
                    <td class="px-4 py-2">        
                        <button onclick="openModal({{ $barang->id }})" class="px-4 py-2 bg-blue-200 text-black border border-purple-500 rounded font-bold hover:bg-purple-500 hover:text-white transition">        
                            Details        
                        </button>        
  
                        @if(auth()->user()->role === 'logistik')        
                            @if($barang->status === 'pending')        
                                <button onclick="openAcceptModal('{{ route('barangmasuk.accept', $barang->id) }}')" class="inline-block px-6 py-2 bg-[#90eb74] text-black border border-[#159b25] rounded font-bold hover:bg-[#75e155]">        
                                    Accept        
                                </button>        
  
                                <form action="{{ route('barangmasuk.reject', $barang->id) }}" method="POST" class="inline">        
                                    @csrf        
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menolak barang ini?');" class="inline-block px-6 py-2 bg-[#cb5656] text-black border border-[#c01111] rounded font-bold hover:bg-[#9e3d3d]">        
                                        Reject        
                                    </button>        
                                </form>        
                            @else        
                                <span class="font-bold ml-6 {{ $barang->status === 'rejected' ? 'text-red-600' : 'text-green-600' }}">        
                                    {{ ucfirst($barang->status) }} !        
                                </span>        
                            @endif        
  
                            <form action="{{ route('barangmasuk.destroy', $barang->id) }}" method="POST" class="inline">        
                                @csrf        
                                @method('DELETE')        
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');" class="inline-block px-6 py-2 bg-red-500 text-white border border-red-700 rounded font-bold hover:bg-red-700">        
                                    Delete        
                                </button>        
                            </form>        
                        @endif        
                    </td>        
                </tr>        
            @endforeach        
        </tbody>        
    </table>        
</div>        
  
<!-- Modal Konfirmasi Accept -->        
<div id="acceptModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">        
    <div class="relative bg-white rounded-lg p-6 w-11/12 max-w-lg">        
        <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-800" style="font-size:34px" onclick="closeAcceptModal()">×</button>        
        <h2 class="text-2xl font-bold text-purple-800 mb-4">Konfirmasi Accept</h2>        
        <p>Apakah Anda yakin ingin memindahkan barang ini ke stok?</p>        
        <div class="mt-4">        
            <button id="confirmAcceptButton" class="px-4 py-2 bg-[#90eb74] text-black border border-[#159b25] rounded font-bold hover:bg-[#75e155]">        
                Ya, Accept        
            </button>        
            <button onclick="closeAcceptModal()" class="px-4 py-2 bg-gray-300 text-black border border-gray-500 rounded font-bold hover:bg-gray-400">        
                Batal        
            </button>        
        </div>        
    </div>        
</div>        
  
<!-- Modal -->        
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">        
    <div class="relative bg-white rounded-lg p-6 w-11/12 max-w-lg">        
        <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-800" style="font-size:34px" onclick="closeModal()">×</button>        
        <h2 class="text-2xl font-bold text-purple-800 mb-4">DETAIL BARANG</h2>        
        <div id="modalBody">        
            <!-- Data will be populated here with JavaScript -->        
        </div>        
    </div>        
</div>        
  
<script>        
let acceptUrl = '';        
  
function openAcceptModal(url) {        
    acceptUrl = url; // Simpan URL untuk pengiriman        
    document.getElementById('acceptModal').classList.remove('hidden');        
}        
  
function closeAcceptModal() {        
    document.getElementById('acceptModal').classList.add('hidden');        
}        
  
document.getElementById('confirmAcceptButton').addEventListener('click', function() {        
    const form = document.createElement('form');        
    form.method = 'POST';        
    form.action = acceptUrl;        
  
    const csrfInput = document.createElement('input');        
    csrfInput.type = 'hidden';        
    csrfInput.name = '_token';        
    csrfInput.value = '{{ csrf_token() }}'; // Token CSRF        
  
    form.appendChild(csrfInput);        
  
    document.body.appendChild(form);        
    form.submit(); // Kirim formulir        
});        
  
function openModal(id) {        
    fetch(`/barangmasuk/${id}`)        
        .then(response => {        
            if (!response.ok) {        
                throw new Error(`HTTP error! Status: ${response.status}`);        
            }        
            return response.json();        
        })        
        .then(data => {        
            const modalBody = document.getElementById('modalBody');        
            modalBody.innerHTML = `        
                <p><strong>Nama Barang:</strong> ${data.nama_barang}</p>        
                <p><strong>Vendor:</strong> ${data.vendor}</p>        
                <p><strong>Kuantiti:</strong> ${data.kuantiti}</p>        
                <p><strong>Tanggal Masuk:</strong> ${data.created_at}</p>        
                <p><strong>Deskripsi:</strong> ${data.deskripsi_barang}</p>        
                <p><strong>Tipe Barang:</strong> ${data.tipe_barang}</p>        
                <p><strong>Serial Number:</strong> ${data.serial_number}</p>        
                <p><strong>Tempat Penyimpanan:</strong> ${data.tempat_penyimpanan}</p>        
            `;        
            document.getElementById('detailModal').classList.remove('hidden');        
        })        
        .catch(error => console.error('Error fetching data:', error));        
}        
  
function closeModal() {        
    document.getElementById('detailModal').classList.add('hidden');        
}        
</script>        
  
@endsection        
