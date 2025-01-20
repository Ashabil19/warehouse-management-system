<?php  
  
namespace App\Exports;  
  
use App\Models\Stock;  
use Maatwebsite\Excel\Concerns\FromCollection;  
use Maatwebsite\Excel\Concerns\WithHeadings;  
use Maatwebsite\Excel\Concerns\WithStyles;  
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;  
use PhpOffice\PhpSpreadsheet\Style\Border;  
use PhpOffice\PhpSpreadsheet\Style\Alignment;  
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;  
  
class PurchasingStockExport implements FromCollection, WithHeadings, WithStyles  
{  
    public function collection()  
    {  
        $index = 1; // Initialize index  
  
        return Stock::with('barangMasuk')  
            ->get()  
            ->map(function ($stock) use (&$index) {  
                return [  
                    'ID' => $index++, // Auto-increment index  
                    'Nama Barang' => $stock->barangMasuk->nama_barang,  
                    'Kategori' => $stock->barangMasuk->kategori,  
                    'Harga Beli' => $stock->barangMasuk->harga_beli, // Include Harga Beli  
                    'Deskripsi' => $stock->barangMasuk->deskripsi_barang,  
                    'Vendor' => $stock->barangMasuk->vendor,  
                    'Serial Number' => $stock->barangMasuk->serial_number,  
                    'Tempat Penyimpanan' => $stock->barangMasuk->tempat_penyimpanan,  
                    'Tanggal Masuk' => $stock->tanggal_masuk,  
                    'Jumlah' => $stock->jumlah,  
                    'Status' => $stock->status,  
                ];  
            });  
    }  
  
    public function headings(): array  
    {  
        return [  
            'ID',  
            'Nama Barang',  
            'Kategori',  
            'Harga Beli', // Include heading for Harga Beli  
            'Deskripsi',  
            'Vendor',  
            'Serial Number',  
            'Tempat Penyimpanan',  
            'Tanggal Masuk',  
            'Jumlah',  
            'Status',  
        ];  
    }  
  
    public function styles(Worksheet $sheet)  
    {  
        // Set header style  
        $sheet->getStyle('A1:L1')->getFont()->setBold(true);  
        $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);  
  
        // Set border for the entire table  
        $sheet->getStyle('A1:L' . ($sheet->getHighestRow()))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);  
  
        // Set column width  
        $sheet->getColumnDimension('A')->setWidth(10);  
        $sheet->getColumnDimension('B')->setWidth(20);  
        $sheet->getColumnDimension('C')->setWidth(20);  
        $sheet->getColumnDimension('D')->setWidth(15); // Width for Harga Beli  
        $sheet->getColumnDimension('E')->setWidth(30);  
        $sheet->getColumnDimension('F')->setWidth(15);  
        $sheet->getColumnDimension('G')->setWidth(20);  
        $sheet->getColumnDimension('H')->setWidth(20);  
        $sheet->getColumnDimension('I')->setWidth(20);  
        $sheet->getColumnDimension('J')->setWidth(15);  
        $sheet->getColumnDimension('K')->setWidth(15);  
    }  
}  
