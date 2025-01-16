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
      
class StockExport implements FromCollection, WithHeadings, WithStyles      
{      
    public function collection()      
    {      
        $index = 1; // Initialize index    
  
        return Stock::with('barangMasuk')      
            ->get()      
            ->map(function ($stock) use (&$index) { // Use reference to modify the index    
                return [      
                    'ID' => $index++, // Auto-increment index      
                    'Nama Barang' => $stock->barangMasuk->nama_barang,      
                    'Kategori' => $stock->barangMasuk->kategori,      
                    // 'Harga Beli' => $stock->barangMasuk->harga_beli,      
                    'Deskripsi' => $stock->barangMasuk->deskripsi_barang,      
                    'Vendor' => $stock->barangMasuk->vendor ?? 'N/A',  // Add vendor    
                    'Serial Number' => $stock->barangMasuk->serial_number,  // Add serial number    
                    'Tempat Penyimpanan' => $stock->barangMasuk->tempat_penyimpanan,  // Add storage location    
                    'Tanggal Masuk' => $stock->tanggal_masuk,      
                    'Jumlah' => $stock->jumlah,      
                    'Status' => $stock->status,      
                    // 'Gambar' => $stock->barangMasuk->attachment_gambar,  // Add image path    
                ];      
            });      
    }      
      
    public function headings(): array      
    {      
        return [      
            'ID',  // New heading for ID    
            'Nama Barang',      
            'Kategori',      
            // 'Harga Beli',      
            'Deskripsi',      
            'Vendor',  // New heading for vendor    
            'Serial Number',  // New heading for serial number    
            'Tempat Penyimpanan',  // New heading for storage location    
            'Tanggal Masuk',      
            'Jumlah',      
            'Status',      
            // 'Gambar',  // New heading for image    
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
        $sheet->getColumnDimension('D')->setWidth(15);      
        $sheet->getColumnDimension('E')->setWidth(30);      
        $sheet->getColumnDimension('F')->setWidth(15);      
        $sheet->getColumnDimension('G')->setWidth(20);      
        $sheet->getColumnDimension('H')->setWidth(20);      
        $sheet->getColumnDimension('I')->setWidth(20);      
        $sheet->getColumnDimension('J')->setWidth(15);      
        $sheet->getColumnDimension('K')->setWidth(15);      
        $sheet->getColumnDimension('L')->setWidth(20);  // Adjust width for image column    
    }      
    
    public function afterExport(Worksheet $sheet)    
    {    
        $rowCount = $sheet->getHighestRow();    
        for ($row = 2; $row <= $rowCount; $row++) {    
            $imagePath = public_path('images/' . $sheet->getCell('L' . $row)->getValue());    
            if (file_exists($imagePath)) {    
                $drawing = new Drawing();    
                $drawing->setName('Image');    
                $drawing->setDescription('Image');    
                $drawing->setPath($imagePath);    
                $drawing->setHeight(50); // Set height of the image    
                $drawing->setCoordinates('L' . $row);    
                $drawing->setWorksheet($sheet);    
            }    
        }    
    }    
}    
