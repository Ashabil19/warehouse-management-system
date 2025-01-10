<?php  
  
namespace App\Exports;  
  
use App\Models\BarangMasuk;  
use Maatwebsite\Excel\Concerns\FromCollection;  
use Maatwebsite\Excel\Concerns\WithHeadings;  
  
class BarangMasukExport implements FromCollection, WithHeadings  
{  
    public function collection()  
    {  
        return BarangMasuk::select('nama_barang', 'vendor', 'kuantiti', 'created_at')  
            ->get()  
            ->map(function ($barang) {  
                return [  
                    'Nama Barang' => $barang->nama_barang,  
                    'Vendor' => $barang->vendor,  
                    'Kuantiti' => $barang->kuantiti,  
                    'Tanggal Masuk' => $barang->created_at,  
                ];  
            });  
    }  
  
    public function headings(): array  
    {  
        return [  
            'Nama Barang',  
            'Vendor',  
            'Kuantiti',  
            'Tanggal Masuk',  
        ];  
    }  
}  
