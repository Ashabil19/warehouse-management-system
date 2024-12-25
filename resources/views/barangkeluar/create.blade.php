@extends('layouts.sidebar')

@section('title', 'Kirim Barang')

@section('content')
<div class="p-10 bg-gray-100 min-h-screen">


    <form action="{{ route('kirimbarang.create') }}" method="POST" class="space-y-6">
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
                            data-kuantiti="{{ $stock->barangmasuk->kuantiti }}"
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

        <!-- Details Section -->
        <div class="bg-gray-100 rounded-lg p-6">
            <h4 class="text-lg font-bold text-indigo-700 mb-4">DETAIL BARANG</h4>
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                <div>
                    <p><strong>Kode Barang:</strong> <span id="kode_barang">-</span></p>
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
            <input type="email" name="email_customer" id="nama_perusahaan" class="mt-1 w-full p-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <button type="submit" class="w-full py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            KIRIM
        </button>
    </form>
    

    {{-- <form action="{{ route('kirimbarang.create') }}" method="POST">
        @csrf <!-- CSRF Token -->
        <label for="barang_id">Barang:</label>
        <select name="barang_id">
            @foreach($barangList as $barang)
                <option value="{{ $barang->id }}">{{ $barang->barangmasuk->nama_product }}</option>
            @endforeach
        </select>
        
        <!-- Input lainnya -->
        <label for="nama_customer">Nama Customer:</label>
        <input type="text" name="nama_customer" required>
    
        <label for="alamat_customer">Alamat Customer:</label>
        <input type="text" name="alamat_customer" required>
    
        <label for="email_customer">Email Customer:</label>
        <input type="email" name="email_customer" required>
    
        <button type="submit">Kirim Barang</button>
    </form> --}}
    

    {{-- <form action="{{ route('kirimbarang.create') }}" method="POST">
        @csrf
    
        <!-- Pilih Barang -->
        <div class="mb-3">
            <label for="barang_id" class="block mb-2 text-sm font-medium text-gray-700">Pilih Barang</label>
            <select 
                name="barang_id" 
                id="barang_id" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" 
                required
            >
                <option value="" disabled selected>Pilih Barang</option>
                @foreach($barangList as $stock)
                    <option 
                        value="{{ $stock->id }}" 
                        data-nama="{{ $stock->barangmasuk->nama_barang }}" 
                        data-kode="{{ $stock->barangmasuk->kode_barang}}" 
                        data-vendor="{{ $stock->barangmasuk->vendor }}" 
                        data-kategori="{{ $stock->barangmasuk->kategori }}" 
                        data-kuantiti="{{ $stock->barangmasuk->kuantiti }}"
                    >
                        {{ $stock->barangmasuk->nama_barang }} ({{ $stock->barangmasuk->kode_barang }})
                    </option>
                @endforeach
            </select>
            @error('barang_id')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
    
        <!-- Detail Barang -->
        <div id="detail-barang" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
            <h2 class="text-purple-800 font-semibold mb-4">DETAIL BARANG</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>Kode Barang: <span id="kode_barang" class="font-semibold"></span></div>
                <div>Vendor: <span id="vendor" class="font-semibold"></span></div>
                <div>Nama Barang: <span id="nama_barang" class="font-semibold"></span></div>
                <div>Kategori: <span id="kategori" class="font-semibold"></span></div>
                <div>Kuantiti: <span id="kuantiti" class="font-semibold"></span></div>
            </div>
        </div>
    
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Customer -->
            <div>
                <label for="nama_customer" class="block text-sm font-medium text-gray-700">Nama Customer</label>
                <input 
                    type="text" 
                    name="nama_customer" 
                    id="nama_customer" 
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-200 focus:border-blue-500" 
                    required 
                    maxlength="255" 
                    value="{{ old('nama_customer') }}"
                >
                @error('nama_customer')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
    
            <!-- Alamat Customer -->
            <div>
                <label for="alamat_customer" class="block text-sm font-medium text-gray-700">Alamat Customer</label>
                <textarea 
                    name="alamat_customer" 
                    id="alamat_customer" 
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-200 focus:border-blue-500" 
                    required 
                    maxlength="500"
                >{{ old('alamat_customer') }}</textarea>
                @error('alamat_customer')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
    
            <!-- Nama Perusahaan -->
            <div>
                <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                <input 
                    type="text" 
                    name="nama_perusahaan" 
                    id="nama_perusahaan" 
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-200 focus:border-blue-500" 
                    maxlength="255"
                >
                @error('nama_perusahaan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
    
        <!-- Submit Button -->
        <button 
            type="submit" 
            class="w-full bg-green-500 text-white p-3 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300"
        >
            KIRIM
        </button>
    </form> --}}
    




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
        });
    </script>
    {{-- <script>
        // Script untuk menampilkan detail barang saat memilih barang
        document.getElementById('barang_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            
            // Update detail barang
            document.getElementById('kode_barang').innerText = selectedOption.getAttribute('data-kode');
            document.getElementById('vendor').innerText = selectedOption.getAttribute('data-vendor');
            document.getElementById('nama_barang').innerText = selectedOption.getAttribute('data-nama');
            document.getElementById('kategori').innerText = selectedOption.getAttribute('data-kategori');
            document.getElementById('kuantiti').innerText = selectedOption.getAttribute('data-kuantiti');
    
            // Tampilkan detail barang
            document.getElementById('detail-barang').classList.remove('hidden');
        });
    </script>
    
</div>

<script>
    const barangSelect = document.getElementById('barang_id');
    const detailBarang = document.getElementById('detail-barang');
    const kodeBarang = document.getElementById('kode_barang');
    const vendor = document.getElementById('vendor');
    const namaBarang = document.getElementById('nama_barang');
    const kategori = document.getElementById('kategori');
    const kuantiti = document.getElementById('kuantiti');

    barangSelect.addEventListener('change', function() {
        const selectedOption = barangSelect.options[barangSelect.selectedIndex];
        kodeBarang.innerText = selectedOption.getAttribute('data-kode');
        vendor.innerText = selectedOption.getAttribute('data-vendor');
        namaBarang.innerText = selectedOption.getAttribute('data-nama');
        kategori.innerText = selectedOption.getAttribute('data-kategori');
        kuantiti.innerText = selectedOption.getAttribute('data-kuantiti');
        
        // Show the detail section
        detailBarang.classList.remove('hidden');
    });
</script> --}}
@endsection
