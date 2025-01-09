<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock; 
use App\Models\KirimBarang;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KirimBarangExport;

class KirimBarangController extends Controller
{
    // Halaman Create (Form Kirim Barang)
    public function create()
    {
        // Ambil hanya stock dengan status selain 'dikirim'
        $barangList = Stock::with('barangMasuk')->where('status', '!=', 'dikirim')->get();

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
            ],
            'jumlah_kirim' => 'required|integer|min:1', // Validasi untuk jumlah kirim
            'nama_customer' => 'required|string|max:255',
            'alamat_customer' => 'required|string|max:500',
            'email_customer' => 'required|email|max:255',
            'no_surat_jalan' => 'required|string|max:255', // Validasi untuk No Surat Jalan
            'no_po' => 'required|string|max:255',          // Validasi untuk No PO
            'no_telepon' => 'required|string|max:15',      // Validasi untuk No Telepon
            'pic' => 'required|string|max:255',             // Validasi untuk PIC
            'shipper' => 'required|string|max:255',         // Validasi untuk Shipper
            'keterangan' => 'nullable|string|max:500',      // Validasi untuk Keterangan
        ]);
        // Ambil stok berdasarkan barang_id
        $stock = Stock::find($validatedData['barang_id']);
        // Cek apakah jumlah yang ingin dikirim tidak melebihi stok
        if ((int)$validatedData['jumlah_kirim'] > (int)$stock->jumlah) {
            return redirect()->back()->withErrors(['jumlah_kirim' => 'Jumlah kirim melebihi stok yang tersedia.']);
        } 
        // Simpan data ke tabel KirimBarang
        try {
            $kirimBarang = KirimBarang::create([
                'id_stock' => $validatedData['barang_id'],
                'nama_customer' => $validatedData['nama_customer'],
                'alamat_customer' => $validatedData['alamat_customer'],
                'email_customer' => $validatedData['email_customer'],
                'no_surat_jalan' => $validatedData['no_surat_jalan'], // Simpan No Surat Jalan
                'no_po' => $validatedData['no_po'],                   // Simpan No PO
                'no_telepon' => $validatedData['no_telepon'],         // Simpan No Telepon
                'pic' => $validatedData['pic'],                         // Simpan PIC
                'shipper' => $validatedData['shipper'],                 // Simpan Shipper
                'keterangan' => $validatedData['keterangan'],           // Simpan Keterangan
                'jumlah_kirim' => $validatedData['jumlah_kirim'],       // Simpan jumlah kirim
            ]);
            // Update jumlah barang di stok
            if ($stock) {
                // Kurangi jumlah barang di stok
                $stock->jumlah -= $validatedData['jumlah_kirim'];
                // Jika jumlah menjadi 0, ubah status menjadi 'kosong'
                if ($stock->jumlah <= 0) {
                    $stock->status = 'kosong'; // Ubah status menjadi 'kosong'
                }
                $stock->save();
            }
            // Redirect dengan pesan sukses
            return redirect('/barangkeluar')->with('success', 'Barang berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Coba lagi.');
        }
    }
    public function updateLinkResi(Request $request, $id)  
    {  
        $validatedData = $request->validate([  
            'link_resi' => 'nullable|string|max:255',  
        ]);  
      
        $kirimBarang = KirimBarang::findOrFail($id);  
        $kirimBarang->link_resi = $validatedData['link_resi'];  
        $kirimBarang->save();  
      
        return response()->json(['success' => true]);  
    }  
    

    // Menampilkan semua data kirimbarang
    public function index()
    {
        // Ambil semua data kirimbarang dengan relasi stock dan barangMasuk
        $kirimBarang = KirimBarang::with(['stock.barangMasuk'])->get();

        // Kirim data ke view
        return view('barangkeluar.index', compact('kirimBarang'));
    }

    public function export()
    {
        return Excel::download(new KirimBarangExport, 'kirim_barang.xlsx');
    }
}
