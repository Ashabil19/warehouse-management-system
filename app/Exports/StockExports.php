<?php    
    
namespace App\Exports;    
    
use App\Models\BarangMasuk; // Ensure this is the correct model    
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
    
        return BarangMasuk::with('vendor') // Ensure you have the correct relationship    
            ->get()    
            ->map(function ($barangMasuk) use (&$index) { // Use reference to modify the index    
                return [    
                    'ID' => $index++, // Auto-increment index    
                    'Nama Barang' => $barangMasuk->nama_barang,    
                    'Kategori' => $barangMasuk->kategori,    
                    'Harga Beli' => $barangMasuk->harga_beli,    
                    'Deskripsi' => $barangMasuk->deskripsi_barang,    
                    'Vendor' => $barangMasuk->vendor->name ?? 'N/A', // Adjust as necessary    
                    'Serial Number' => $barangMasuk->serial_number,    
                    'Tempat Penyimpanan' => $barangMasuk->tempat_penyimpanan,    
                    'Tanggal Masuk' => $barangMasuk->tanggal_masuk,    
                    'Jumlah' => $barangMasuk->kuantiti,    
                    'Status' => $barangMasuk->status,    
                ];    
            });    
    }    
    
    public function headings(): array    
    {    
        return [    
            'ID',    
            'Nama Barang',    
            'Kategori',    
            'Harga Beli',    
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
    
    public function afterExport(Worksheet $sheet)    
    {    
        // Optional: Handle image export if needed    
    }    
}    
