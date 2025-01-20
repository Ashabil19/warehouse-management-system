<?php  
  
namespace App\Exports;  
  
use App\Models\BarangMasuk; // Pastikan ini adalah model yang benar  
use Maatwebsite\Excel\Concerns\FromCollection;  
use Maatwebsite\Excel\Concerns\WithHeadings;  
use Maatwebsite\Excel\Concerns\WithStyles;  
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;  
use PhpOffice\PhpSpreadsheet\Style\Border;  
use PhpOffice\PhpSpreadsheet\Style\Alignment;  
  
class StockExports implements FromCollection, WithHeadings, WithStyles  
{  
    public function collection()  
    {  
        $index = 1; // Initialize index      
        $user = auth()->user(); // Ambil user yang sedang login  
  
        return BarangMasuk::with('vendor') // Pastikan relasi vendor ada  
            ->get()  
            ->map(function ($barangMasuk) use (&$index, $user) {  
                $data = [  
                    'ID' => $index++, // Auto-increment index  
                    'Nama Barang' => $barangMasuk->nama_barang,  
                    'Kategori' => $barangMasuk->kategori,  
                    // Cek apakah user adalah bagian purchasing  
                    'Harga Beli' => $user->role !== 'purchasing' ? $barangMasuk->harga_beli : null,  
                    'Deskripsi' => $barangMasuk->deskripsi_barang,  
                    'Vendor' => $barangMasuk->vendor->name ?? 'N/A', // Pastikan untuk mengakses nama vendor  
                    'Serial Number' => $barangMasuk->serial_number,  
                    'Tempat Penyimpanan' => $barangMasuk->tempat_penyimpanan,  
                    'Tanggal Masuk' => $barangMasuk->tanggal_masuk,  
                    'Jumlah' => $barangMasuk->kuantiti,  
                    'Status' => $barangMasuk->status,  
                ];  
  
                return $data;  
            });  
    }  
  
    public function headings(): array  
    {  
        $user = auth()->user(); // Ambil user yang sedang login  
        $headings = [  
            'ID',  
            'Nama Barang',  
            'Kategori',  
            // Cek apakah user adalah bagian purchasing  
            'Harga Beli' => $user->role !== 'purchasing' ? 'Harga Beli' : null,  
            'Deskripsi',  
            'Vendor',  
            'Serial Number',  
            'Tempat Penyimpanan',  
            'Tanggal Masuk',  
            'Jumlah',  
            'Status',  
        ];  
  
        // Filter null values  
        return array_filter($headings);  
    }  
  
    public function styles(Worksheet $sheet)  
    {  
        // Set header style  
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);  
        $sheet->getStyle('A1:K1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);  
  
        // Set border for the entire table  
        $sheet->getStyle('A1:K' . ($sheet->getHighestRow()))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);  
  
        // Set column width  
        $sheet->getColumnDimension('A')->setWidth(10);  
        $sheet->getColumnDimension('B')->setWidth(20);  
        $sheet->getColumnDimension('C')->setWidth(20);  
        $sheet->getColumnDimension('D')->setWidth(15);  
        $sheet->getColumnDimension('E')->setWidth(30);  
        $sheet->getColumnDimension('F')->setWidth(15);  
        $sheet->getColumnDimension('G')->setWidth(20);  
        $sheet->getColumnDimension('H')->setWidth(20);  
        $sheet->getColumnDimension('I')->setWidth(20);  
        $sheet->getColumnDimension('J')->setWidth(15);  
        $sheet->getColumnDimension('K')->setWidth(15);  
    }  
}  
