<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangMasukExport;
use App\Exports\KirimBarangExport;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Vendor; // Pastikan untuk mengimpor model Vendor
use App\Models\Stock; // Pastikan Stock di-import

class BarangMasukController extends Controller
{
    public function indexBarangMasuk()
    {
        $barangMasuk = BarangMasuk::all(); // Retrieve all data from BarangMasuk
        return view('barangmasuk.index', compact('barangMasuk'));
    }
    public function indexStock()
    {
        // Ambil data stok dari model Stock
        $stocks = Stock::all(); // Atau sesuaikan dengan logika yang kamu butuhkan
        return view('stock.index', compact('stocks')); // Pastikan ada view yang sesuai
    }

    public function create()
    {
        $vendors = Vendor::all(); // Ambil semua data vendor
        return view('barangmasuk.create', compact('vendors'));
    }

    // public function store(Request $request)
    // {
    //     // Log semua data yang diterima
    //     \Log::info('Data yang diterima:', $request->all());
    
    //     // Validasi input
    //     $request->validate([
    //         'kode_barang' => 'required|unique:barang_masuk',
    //         'nama_barang' => 'required',
    //         'kategori' => 'required',
    //         'harga_beli' => 'required|integer',
    //         'kuantiti' => 'required|integer',
    //         'deskripsi_barang' => 'nullable',
    //         'vendor' => 'required|integer|exists:vendors,id', // Pastikan ini sesuai dengan kolom di database
    //     ]);
    
    //     // Simpan data ke database
    //     BarangMasuk::create([
    //         'kode_barang' => $request->kode_barang,
    //         'nama_barang' => $request->nama_barang,
    //         'kategori' => $request->kategori,
    //         'harga_beli' => $request->harga_beli,
    //         'kuantiti' => $request->kuantiti,
    //         'deskripsi_barang' => $request->deskripsi_barang,
    //         'vendor' => $request->vendor, // Pastikan ini sesuai dengan kolom di database
    //     ]);
    
    //     // Redirect atau return response
    //     return redirect()->back()->with('success', 'Barang berhasil ditambahkan');
    // }
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'kode_barang' => 'required|unique:barang_masuk',
        'nama_barang' => 'required',
        'kategori' => 'required',
        'harga_beli' => 'required|integer',
        'kuantiti' => 'required|integer',
        'deskripsi_barang' => 'nullable',
        'vendor' => 'required|exists:vendors,id', // Pastikan ini sesuai dengan kolom di database
    ]);

    // Simpan data ke database
    BarangMasuk::create($request->all());

    // Redirect kembali ke halaman input barang
    return redirect()->back()->with('success', 'Barang berhasil ditambahkan');
}

 
    

    
    

    public function edit($id)
    {
        $barang = BarangMasuk::findOrFail($id);
        $vendors = Vendor::all(); // Ambil semua data vendor
        return view('barangmasuk.edit', compact('barang', 'vendors'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|unique:barang_masuk,kode_barang,' . $id,
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga_beli' => 'required|integer',
            'kuantiti' => 'required|integer',
            'deskripsi_barang' => 'nullable',
            'vendor_id' => 'required|exists:vendors,id', // Validasi vendor_id
        ]);

        // Temukan barang dan perbarui data
        $barang = BarangMasuk::findOrFail($id);
        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'harga_beli' => $request->harga_beli,
            'kuantiti' => $request->kuantiti,
            'deskripsi_barang' => $request->deskripsi_barang,
            'vendor_id' => $request->vendor_id, // Simpan vendor_id
        ]);

        return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = BarangMasuk::findOrFail($id);
        $barang->delete();
        return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil dihapus.');
    }

    public function accept($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        Stock::create([
            'id_barangmasuk' => $barangMasuk->id,
            'tanggal_masuk' => now(),
            'jumlah' => $barangMasuk->kuantiti,
        ]);
        // Update status di tabel barang_masuk
        $barangMasuk->status = 'accepted';
        $barangMasuk->save(); // Explicitly save to ensure persistence
        return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil dipindahkan ke stok');
    }

    public function getDetails($id)
    {
        $barang = BarangMasuk::findOrFail($id);
        return response()->json([
            'kode_barang' => $barang->kode_barang,
            'nama_barang' => $barang->nama_barang,
            'kuantiti' => $barang->kuantiti,
            'vendor' => $barang->vendor,
            'kategori' => $barang->kategori,
            'harga_beli' => 'Rp ' . number_format($barang->harga_beli, 0, ',', '.')
        ]);
    }

    public function exportBarangMasuk()
    {
        return Excel::download(new BarangMasukExport, 'barang_masuk.xlsx');
    }

    public function exportStock()
    {
        return Excel::download(new \App\Exports\StockExport, 'stock.xlsx');
    }

    public function exportKirimBarang()
    {
        return Excel::download(new KirimBarangExport, 'kirim_barang.xlsx');
    }
}
