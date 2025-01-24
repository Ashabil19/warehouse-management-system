@extends('layouts.sidebar')  
  
@section('title', 'Kirim Barang - GudangEasy')  
  
@section('content')  
<div class="p-10 bg-gray-100 min-h-screen">  
    <form action="{{ route('kirimbarang.store') }}" method="POST" class="space-y-6">  
        @csrf  
  
        <!-- Search Bar -->  
        <div class="mb-6">  
            <label for="barang_id" class="block mb-2 text-sm font-medium text-gray-700">Pilih Barang</label>  
            <div class="flex items-center bg-indigo-100 rounded-lg p-4">  
                <select   
                    name="barang_id"   
                    id="barang_id"   
                    class="w-full bg-transparent text-gray-600 placeholder-gray-500 focus:outline-none focus:ring focus:ring-indigo-200"   
                    required  
                >  
                    <option value="" disabled selected>Pilih Barang</option>  
                    @foreach($barangList as $stock)  
                        @if($stock->jumlah > 0) <!-- Only show items with quantity > 0 -->  
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
                        @endif  
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
            <span id="errorMessage" class="text-sm text-red-500" style="display: none;">Jumlah tidak mencukupi</span>  
            @error('jumlah_kirim')  
                <span class="text-sm text-red-500">{{ $message }}</span>  
            @enderror  
        </div>  
  
        <!-- Details Section -->  
        <div class="bg-gray-100 rounded-lg p-6">  
            <h4 class="text-lg font-bold text-indigo-700 mb-4">DETAIL BARANG</h4>  
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">  
                <div>  
                    <p><strong>Nama Barang:</strong> <span id="nama_barang">-</span></p>  
                    <p><strong>Kuantiti:</strong> <span id="kuantiti">-</span></p>  
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
        const jumlahKirim = document.getElementById('jumlah_kirim');  
        const errorMessage = document.getElementById('errorMessage');  
  
        selectBarang.addEventListener('change', function() {  
            const selectedOption = selectBarang.options[selectBarang.selectedIndex];  
            const kuantiti = parseInt(selectedOption.getAttribute('data-kuantiti'));  
  
            // Update detail fields  
            document.getElementById('nama_barang').textContent = selectedOption.getAttribute('data-nama') || '-';  
            document.getElementById('vendor').textContent = selectedOption.getAttribute('data-vendor') || '-';  
            document.getElementById('kategori').textContent = selectedOption.getAttribute('data-kategori') || '-';  
            document.getElementById('kuantiti').textContent = kuantiti || '-';  
  
            // Clear error message  
            errorMessage.style.display = 'none';  
            jumlahKirim.value = ''; // Reset the input  
        });  
  
        jumlahKirim.addEventListener('input', function() {  
            const selectedOption = selectBarang.options[selectBarang.selectedIndex];  
            const kuantiti = parseInt(selectedOption.getAttribute('data-kuantiti'));  
            const jumlah = parseInt(this.value);  
  
            if (jumlah > kuantiti) {  
                errorMessage.style.display = 'inline';  
            } else {  
                errorMessage.style.display = 'none';  
            }  
        });  
    </script>  
</div>  
@endsection  
