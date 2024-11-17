<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock; // Pastikan kamu import model Stock

class KirimBarangController extends Controller
{
    public function create()
    {
        // Ambil data stock yang dihubungkan dengan barangmasuk
        $barangList = Stock::with('barangmasuk')->get();

        // Kirimkan data barangList ke view
        return view('barangkeluar.create', compact('barangList'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'barang' => 'required|string|max:255',
            'nama_customer' => 'required|string|max:255',
            'alamat_customer' => 'required|string',
            'email_customer' => 'required|email|max:255',
        ]);

        // Simpan ke database KirimBarang (simpan logika pengiriman barang sesuai kebutuhan)
        // Misalnya:
        // KirimBarang::create([...]);

        // Redirect dengan pesan sukses
        return redirect('/kirim-barang')->with('success', 'Barang berhasil dikirim!');
    }
}
