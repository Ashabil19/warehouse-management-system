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
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|unique:barang_masuk',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga_beli' => 'required|integer',
            'kuantiti' => 'required|integer',
            'deskripsi_barang' => 'nullable',
            'vendor' => 'required|exists:vendors,id', // Pastikan ini sesuai dengan kolom di database
            'tipe_barang' => 'nullable|string', // Validasi untuk tipe_barang
            'serial_number' => 'nullable|string', // Validasi untuk serial_number
            'tempat_penyimpanan' => 'nullable|string', // Validasi untuk tempat_penyimpanan
        ]);

        // Simpan data ke database
        $data = $request->all();
        $data['tanggal_masuk'] = now(); // Set tanggal masuk ke timestamp saat ini

        BarangMasuk::create($data);

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
            'vendor' => 'required|exists:vendors,id', // Validasi vendor
            'tipe_barang' => 'nullable|string', // Validasi untuk tipe_barang
            'serial_number' => 'nullable|string', // Validasi untuk serial_number
            'tempat_penyimpanan' => 'nullable|string', // Validasi untuk tempat_penyimpanan
        ]);

        // Temukan barang dan perbarui data
        $barang = BarangMasuk::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil diperbarui.');
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

    public function reject($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->status = 'rejected';
        $barangMasuk->save();
        return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil ditolak.');
    }

    public function destroy($id)
    {
        $barang = BarangMasuk::findOrFail($id);
        $barang->delete();
        return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil dihapus.');
    }

    public function exportBarangMasuk()
    {
        return Excel::download(new BarangMasukExport, 'barang_masuk.xlsx');
    }

    public function exportKirimBarang()
    {
        return Excel::download(new KirimBarangExport, 'kirim_barang.xlsx');
    }

    public function getDetails($id)
    {
        $barang = BarangMasuk::findOrFail($id);
        return response()->json([
            'kode_barang' => $barang->kode_barang,
            'nama_barang' => $barang->nama_barang,
            'vendor' => $barang->vendor,
            'kuantiti' => $barang->kuantiti,
            'tanggal_masuk' => $barang->tanggal_masuk,
            'deskripsi_barang' => $barang->deskripsi_barang,
            'tipe_barang' => $barang->tipe_barang,
            'serial_number' => $barang->serial_number,
            'tempat_penyimpanan' => $barang->tempat_penyimpanan,
        ]);
    }
}
