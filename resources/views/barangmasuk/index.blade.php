@extends('layouts.sidebar')

@section('title', 'Barang Masuk')

@section('content')

<h1 style="color: #5B3E99; font-weight: bold; text-align: center;">BARANG MASUK</h1>
<a href="{{ route('barangmasuk.export') }}" 
   style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #5B3E99; color: #FFF; text-decoration: none; border-radius: 5px; font-weight: bold;">
   Export to Excel
</a>

    <div style="height: 85%; overflow-y: auto;"> <!-- Add this div wrapper -->
        <table class="w-full mt-5 border-collapse">
            <thead>
                <tr>
                    <th class="text-left px-4 py-2 font-bold">No.</th>
                    <th class="text-left px-4 py-2 font-bold">Kode Barang</th>
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
                        <td class="px-4 py-2">{{ $barang->kode_barang }}</td>
                        <td class="px-4 py-2">{{ $barang->nama_barang }}</td>
                        <td class="px-4 py-2">{{ $barang->vendor }}</td>
                        <td class="px-4 py-2">{{ $barang->kuantiti }}</td>
                        <td class="px-4 py-2">{{ $barang->created_at }}</td>


                        <td class="px-4 py-2">
                            <button onclick="openModal({{ $barang->id }})" class="px-4 py-2 bg-blue-200 text-black border border-purple-500 rounded font-bold hover:bg-purple-500 hover:text-white transition">
                                Details
                            </button>
                            
                            <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                                <div class="relative bg-white rounded-lg p-6 w-11/12 max-w-lg">
                                    <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-800" style="font-size:34px" onclick="closeModal()">×</button>
                                    <h2 class="text-2xl font-bold text-purple-800 mb-4">DETAIL BARANG</h2>
                                    <div id="modalBody">
                                        <!-- Data will be populated here with JavaScript -->
                                    </div>
                                </div>
                            </div>

                            @if($barang->status === 'pending')
                                <form action="{{ route('barangmasuk.accept', $barang->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin memindahkan barang ini ke stok?');" class="inline-block px-6 py-2 bg-[#90eb74] text-black border border-[#159b25] rounded font-bold hover:bg-[#75e155]">
                                        Accept
                                    </button>
                                </form>

                                <form action="{{ route('barangmasuk.destroy', $barang->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');" class="inline-block px-6 py-2 bg-[#cb5656] text-black border border-[#c01111] rounded font-bold hover:bg-[#9e3d3d]">
                                        Reject
                                    </button>
                                </form>
                            @else
                                <span class="text-green-600 font-bold ml-6">Accepted !</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- End of div wrapper -->

    <script src="{{ asset('js/modal.js') }}"></script>

@endsection