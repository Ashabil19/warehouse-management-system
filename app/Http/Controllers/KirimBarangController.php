<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KirimBarang;

class KirimBarangController extends Controller
{

    public function create()
{
    return view('barangkeluar.create'); // Ganti dengan nama view form Anda
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

        // Simpan ke database
        KirimBarang::create([
            'barang' => $validatedData['barang'],
            'nama_customer' => $validatedData['nama_customer'],
            'alamat_customer' => $validatedData['alamat_customer'],
            'email_customer' => $validatedData['email_customer'],
        ]);

        // Redirect dengan pesan sukses
        return redirect('/kirim-barang')->with('success', 'Barang berhasil dikirim!');
    }
}
