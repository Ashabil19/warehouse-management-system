<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangMasukExport;
use App\Exports\KirimBarangExport;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Vendor;
use App\Models\Stock;

class BarangMasukController extends Controller
{
    public function indexBarangMasuk()
    {
        $barangMasuk = BarangMasuk::all(); // Retrieve all data from BarangMasuk
        return view('barangmasuk.index', compact('barangMasuk'));
    }

    public function indexStock()
    {
        $stocks = Stock::all(); // Ambil data stok dari model Stock
        return view('stock.index', compact('stocks'));
    }

    public function create()
    {
        $vendors = Vendor::all(); // Ambil semua data vendor
        return view('barangmasuk.create', compact('vendors'));
    }

    public function store(Request $request)
    {
        // Log semua data yang diterima
        \Log::info('Data yang diterima:', $request->all());

        // Validasi input
        $request->validate([
            'kode_barang' => 'required|unique:barang_masuk',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga_beli' => 'required|integer',
            'kuantiti' => 'required|integer',
            'deskripsi_barang' => 'nullable',
            'vendor' => 'required|exists:vendors,id',
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
            'vendor_id' => 'required|exists:vendors,id',
        ]);

        // Temukan barang dan perbarui data
        $barang = BarangMasuk::findOrFail($id);
        $barang->update($request->all());

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
        return Excel::download(new BarangMasukExport, 'laporan_pembelian.xlsx');
    }

    public function exportStock()
    {
        return Excel::download(new \App\Exports\StockExport, 'laporan_stock.xlsx');
    }

    public function exportKirimBarang()
    {
        return Excel::download(new KirimBarangExport, 'laporan_pengiriman.xlsx');
    }
}
