<?php    
    
namespace App\Exports;    
    
use App\Models\KirimBarang;    
use Maatwebsite\Excel\Concerns\FromCollection;    
use Maatwebsite\Excel\Concerns\WithHeadings;    
    
class KirimBarangExport implements FromCollection, WithHeadings    
{    
    public function collection()    
    {    
        $index = 1; // Initialize index    
  
        // Mengambil semua data kirim barang    
        return KirimBarang::all()->map(function($kirim) use (&$index) {    
            return [    
                'ID' => $index++, // Auto-increment index      
                'ID Stock' => $kirim->id_stock,    
                'Jumlah Kirim' => $kirim->jumlah_kirim,    
                'Nama Customer' => $kirim->nama_customer,    
                'Alamat Customer' => $kirim->alamat_customer,    
                'Email Customer' => $kirim->email_customer,    
                'No. Surat Jalan' => $kirim->no_surat_jalan,    
                'No. PO' => $kirim->no_po,    
                'No. Telepon' => $kirim->no_telepon,    
                'PIC' => $kirim->pic,    
                'Shipper' => $kirim->shipper,    
                'Keterangan' => $kirim->keterangan,    
                'Link Resi' => $kirim->link_resi,    
            ];    
        });    
    }    
    
    public function headings(): array    
    {    
        return [    
            'Nomor',    
            'ID Stock',    
            'Jumlah Kirim',    
            'Nama Customer',    
            'Alamat Customer',    
            'Email Customer',    
            'No. Surat Jalan',    
            'No. PO',    
            'No. Telepon',    
            'PIC',    
            'Shipper',    
            'Keterangan',    
            'Link Resi',    
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
        $sheet->getColumnDimension('L')->setWidth(20);    
    }      
  
    public function afterExport(Worksheet $sheet)    
    {    
        // Optional: Handle image export if needed    
    }    
}    
