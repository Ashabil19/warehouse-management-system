<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang|max:255',
            'nama_barang' => 'required|max:255',
            'kategori' => 'required',
            'harga_beli' => 'required|numeric',
            'kuantiti' => 'required|numeric',
            'vendor' => 'required',
            'deskripsi' => 'nullable',
        ]);

        Barang::create($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kode_barang' => 'required|max:255|unique:barang,kode_barang,' . $barang->id,
            'nama_barang' => 'required|max:255',
            'kategori' => 'required',
            'harga_beli' => 'required|numeric',
            'kuantiti' => 'required|numeric',
            'vendor' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $barang->update($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
