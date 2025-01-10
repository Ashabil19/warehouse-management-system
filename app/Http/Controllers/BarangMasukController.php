<?php  
  
namespace App\Http\Controllers;  
  
use Maatwebsite\Excel\Facades\Excel;  
use App\Exports\BarangMasukExport;  
use Illuminate\Http\Request;  
use App\Models\BarangMasuk;  
use App\Exports\StockExport;   
use App\Models\Vendor;  
use App\Models\Stock;  
  
class BarangMasukController extends Controller  
{  
    public function indexBarangMasuk()  
    {  
        $barangMasuk = BarangMasuk::orderBy('created_at', 'desc')->get(); // Mengambil data dan mengurutkannya dari terbaru ke terlama  
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
        $validatedData = $request->validate([      
            'harga_beli' => 'required|string',      
            'nama_barang' => 'required|string|max:255',      
            'kategori' => 'required|string|max:255',      
            'kuantiti' => 'required|string',      
            'deskripsi_barang' => 'nullable|string',      
            'vendor' => 'required|exists:vendors,id',      
            'tipe_barang' => 'nullable|string|max:255',      
            'serial_number' => 'nullable|string|max:255',      
            'tempat_penyimpanan' => 'nullable|string|max:255',      
            'attachment_gambar' => 'nullable|image|max:2048',      
        ]);      
        
        $hargaBeli = (float) str_replace('.', '', $validatedData['harga_beli']);      
        $kuantiti = (int) str_replace('.', '', $validatedData['kuantiti']);      
        
        try {      
            // Log data yang akan disimpan    
            \Log::info('Data yang akan disimpan:', $validatedData);    
                
            // Simpan gambar ke public/images      
            $gambarPath = null;      
            if ($request->hasFile('attachment_gambar')) {      
                $originalName = $request->file('attachment_gambar')->getClientOriginalName();      
                $gambarPath = $request->file('attachment_gambar')->move(public_path('images'), $originalName);      
                $gambarPath = 'images/' . $originalName;      
            }      
        
            BarangMasuk::create([      
                'harga_beli' => $hargaBeli,      
                'nama_barang' => $validatedData['nama_barang'],      
                'kategori' => $validatedData['kategori'],      
                'kuantiti' => $kuantiti,      
                'deskripsi_barang' => $validatedData['deskripsi_barang'],      
                'vendor' => $validatedData['vendor'],      
                'tipe_barang' => $validatedData['tipe_barang'],      
                'serial_number' => $validatedData['serial_number'],      
                'tempat_penyimpanan' => $validatedData['tempat_penyimpanan'],      
                'attachment_gambar' => $gambarPath,      
            ]);      
        
            return redirect()->route('barangmasuk.index')->with('success', 'Barang berhasil ditambahkan!');      
        } catch (\Exception $e) {      
            // Log kesalahan    
            \Log::error('Terjadi kesalahan saat menyimpan barang: ' . $e->getMessage());    
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());      
        }      
    }    
  
    public function edit($id)  
    {  
        $barang = BarangMasuk::findOrFail($id);  
        $vendors = Vendor::all();  
        return view('barangmasuk.edit', compact('barang', 'vendors'));  
    }  
  
    public function update(Request $request, $id)  
    {  
        $validatedData = $request->validate([  
            'nama_barang' => 'required|string|max:255',  
            'kategori' => 'required|string|max:255',  
            'harga_beli' => 'required|integer',  
            'kuantiti' => 'required|integer',  
            'deskripsi_barang' => 'nullable|string',  
            'vendor' => 'required|exists:vendors,id',  
            'tipe_barang' => 'nullable|string|max:255',  
            'serial_number' => 'nullable|string|max:255',  
            'tempat_penyimpanan' => 'nullable|string|max:255',  
        ]);  
        $barang = BarangMasuk::findOrFail($id);  
        $barang->update($validatedData);  
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
    
    
  

    public function exportStock()    
    {    
        return Excel::download(new StockExport, 'stock.xlsx');    
    } 


    public function getDetails($id)  
    {  
        $barang = BarangMasuk::findOrFail($id);  
        return response()->json([  
            'nama_barang' => $barang->nama_barang,  
            'vendor' => $barang->vendor->name ?? '-',  
            'kuantiti' => $barang->kuantiti,  
            'tanggal_masuk' => $barang->created_at->format('Y-m-d'),  
            'deskripsi_barang' => $barang->deskripsi_barang,  
            'tipe_barang' => $barang->tipe_barang,  
            'serial_number' => $barang->serial_number,  
            'tempat_penyimpanan' => $barang->tempat_penyimpanan,  
            'gambar' => $barang->attachment_gambar ? asset('storage/' . $barang->attachment_gambar) : null,  
        ]);  
    }  
  
    public function show($id)  
    {  
        $barang = BarangMasuk::findOrFail($id);  
        // Menggunakan asset() untuk mendapatkan URL yang benar  
        $barang->attachment_gambar = asset('storage/' . $barang->attachment_gambar);  
        return response()->json($barang);  
    }  
}  
