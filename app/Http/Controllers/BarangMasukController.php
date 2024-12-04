<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangMasukExport;
use App\Exports\KirimBarangExport;


use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use Carbon\Carbon; // Pastikan untuk mengimport Carbon jika belum
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
        $stocks = Stock::all(); // Retrieve all data from Stock
        return view('stock.index', compact('stocks'));
    }
    public function store(Request $request)
    {   // Validasi input
        $request->validate([
            'kode_barang' => 'required|unique:barang_masuk',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga_beli' => 'required|integer',
            'kuantiti' => 'required|integer',
            'deskripsi_barang' => 'nullable',
            'vendor' => 'required',
        ]);

        // Simpan data ke database
        BarangMasuk::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'harga_beli' => $request->harga_beli,
            'kuantiti' => $request->kuantiti,
            'deskripsi_barang' => $request->deskripsi_barang,
            'vendor' => $request->vendor,
        ]);

        // Redirect atau return response
        return redirect()->back()->with('success', 'Barang berhasil ditambahkan');
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
