<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock; 
use App\Models\KirimBarang;
use Maatwebsite\Excel\Facades\Excel; // Pastikan ini diimpor
use App\Exports\KirimBarangExport; // Pastikan ini diimpor


class KirimBarangController extends Controller
{
    // Halaman Create (Form Kirim Barang)
    public function create()
    {
        // Ambil hanya stock dengan status selain 'dikirim'
        $barangList = Stock::with('barangmasuk')->where('status', '!=', 'dikirim')->get();

        // Kirim data barangList ke view
        return view('barangkeluar.create', compact('barangList'));
    }

    // Menyimpan data barang keluar ke database
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
        ]);

        // Simpan data ke tabel KirimBarang
        try {
            $kirimBarang = KirimBarang::create([
                'id_stock' => $validatedData['barang_id'],
                'nama_customer' => $validatedData['nama_customer'],
                'alamat_customer' => $validatedData['alamat_customer'],
                'email_customer' => $validatedData['email_customer'],
            ]);

            // Update status barang menjadi 'dikirim'
            $stock = Stock::find($validatedData['barang_id']);
            if ($stock) {
                $stock->status = 'dikirim';
                $stock->save();
            }

            // Redirect dengan pesan sukses
            return redirect('/barangkeluar')->with('success', 'Barang berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Coba lagi.');
        }
    }

   // Menampilkan semua data kirimbarang
   public function index()
   {
       // Ambil semua data kirimbarang dengan relasi stock dan barangMasuk
       $kirimBarang = KirimBarang::with(['stock.barangMasuk'])->get();

       // Kirim data ke view
       return view('barangkeluar.index', compact('kirimBarang'));
   }

public function showAll()
{
    // Ambil semua data kirim_barang beserta relasi yang diperlukan
    $kirimBarang = KirimBarang::with(['stock.barangMasuk.barang'])->get();

    // Kirim data ke view
    return view('barangkeluar.showAll', compact('kirimBarang'));
}



public function export()
{
    return Excel::download(new KirimBarangExport, 'kirim_barang.xlsx');
}
}
