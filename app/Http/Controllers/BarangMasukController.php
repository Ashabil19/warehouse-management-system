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
        $barangMasuk = BarangMasuk::all();
        return view('barangmasuk.index', compact('barangMasuk'));
    }

    public function indexStock()
    {
        $stocks = Stock::all();
        return view('stock.index', compact('stocks'));
    }

    public function create()
    {
        $vendors = Vendor::all();
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
            'vendor' => 'required|exists:vendors,id',
            'tipe_barang' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'tempat_penyimpanan' => 'nullable|string',
            'attachment_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan data ke database
        $data = $request->all();
        $data['tanggal_masuk'] = now();

        // Proses upload gambar
        if ($request->hasFile('attachment_gambar')) {
            $file = $request->file('attachment_gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['attachment_gambar'] = $filename;
        }

        BarangMasuk::create($data);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = BarangMasuk::findOrFail($id);
        $vendors = Vendor::all();
        return view('barangmasuk.edit', compact('barang', 'vendors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang_masuk,kode_barang,' . $id,
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga_beli' => 'required|integer',
            'kuantiti' => 'required|integer',
            'deskripsi_barang' => 'nullable',
            'vendor' => 'required|exists:vendors,id',
            'tipe_barang' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'tempat_penyimpanan' => 'nullable|string',
        ]);

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
        $barangMasuk->status = 'accepted';
        $barangMasuk->save();
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
        'vendor' => $barang->vendor->name,
        'kuantiti' => $barang->kuantiti,
        'tanggal_masuk' => $barang->created_at->format('Y-m-d'),
        'deskripsi_barang' => $barang->deskripsi_barang,
        'tipe_barang' => $barang->tipe_barang,
        'serial_number' => $barang->serial_number,
        'tempat_penyimpanan' => $barang->tempat_penyimpanan,
        'gambar' => asset('images/' . $barang->attachment_gambar), // Pastikan ini sesuai dengan path gambar
    ]);
}


    
}
