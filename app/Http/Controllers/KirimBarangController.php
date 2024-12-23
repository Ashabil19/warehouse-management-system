<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock; 
use App\Models\KirimBarang;
use Maatwebsite\Excel\Facades\Excel; 
use App\Exports\KirimBarangExport; 

class KirimBarangController extends Controller
{
    public function create()
    {
        // Ambil hanya stock dengan status selain 'dikirim'
        $barangList = Stock::with('barangmasuk')->where('status', '!=', 'dikirim')->get();
        return view('barangkeluar.create', compact('barangList'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'barang_id' => [
                'required',
                'exists:stocks,id',
                function ($attribute, $value, $fail) {
                    $stock = Stock::find($value);
                    if ($stock && $stock->status === 'dikirim') {
                        $fail('Barang ini sudah dikirim dan tidak dapat dipilih lagi.');
                    }
                },
            ],
            'nama_customer' => 'required|string|max:255',
            'alamat_customer' => 'required|string|max:500',
            'email_customer' => 'required|email|max:255',
            'jumlah' => 'required|integer|min:1', // Validasi jumlah
        ]);

        // Simpan data ke tabel KirimBarang
        try {
            $kirimBarang = KirimBarang::create([
                'id_stock' => $validatedData['barang_id'],
                'nama_customer' => $validatedData['nama_customer'],
                'alamat_customer' => $validatedData['alamat_customer'],
                'email_customer' => $validatedData['email_customer'],
            ]);

            // Update status barang menjadi 'dikirim' dan kurangi jumlah stok
            $stock = Stock::find($validatedData['barang_id']);
            if ($stock) {
                // Pastikan jumlah yang diminta tidak melebihi stok yang ada
                if ($validatedData['jumlah'] > $stock->jumlah) {
                    return redirect()->back()->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
                }

                $stock->jumlah -= $validatedData['jumlah']; // Kurangi jumlah stok
                $stock->status = 'dikirim'; // Update status
                $stock->save(); // Simpan perubahan
            }

            // Redirect dengan pesan sukses
            return redirect('/barangkeluar')->with('success', 'Barang berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Coba lagi.');
        }
    }

    public function index()
    {
        $kirimBarang = KirimBarang::with(['stock.barangMasuk'])->get();
        return view('barangkeluar.index', compact('kirimBarang'));
    }

    public function showAll()
    {
        $kirimBarang = KirimBarang::with(['stock.barangMasuk.barang'])->get();
        return view('barangkeluar.showAll', compact('kirimBarang'));
    }

    public function export()
    {
        return Excel::download(new KirimBarangExport, 'kirim_barang.xlsx');
    }
}
