<?php 

namespace App\Exports;

use App\Models\KirimBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KirimBarangExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengambil semua data kirim barang beserta relasi dengan stock dan barangMasuk
        return KirimBarang::with('stock', 'stock.barangMasuk')->get()->map(function($kirim) {
            return [
                'Nomor' => $kirim->id,
                'Nama Customer' => $kirim->nama_customer,
                'Alamat Customer' => $kirim->alamat_customer,
                'Nama Barang' => $kirim->stock ? $kirim->stock->barangMasuk->nama_barang : 'Tidak Tersedia',
                'Email Customer' => $kirim->email_customer,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nomor',
            'Nama Customer',
            'Alamat Customer',
            'Nama Barang',
            'Email Customer',
        ];
    }
}
