<?php
namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all(); // Ambil semua data vendor
        return view('vendor.index', compact('vendors')); // Pastikan ini mengarah ke view yang benar
    }

    public function create()
    {
        return view('vendor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact_info' => 'nullable',
            'address' => 'nullable',
        ]);

        Vendor::create($request->all());
        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('vendor.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'contact_info' => 'nullable',
            'address' => 'nullable',
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->all());
        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();
        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil dihapus.');
    }
}
