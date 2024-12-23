<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangMasukExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengambil semua data barang masuk dan memformatnya
        return BarangMasuk::select('kode_barang', 'nama_barang', 'vendor', 'kuantiti', 'created_at')->get()->map(function($barang) {
            return [
                'Kode Barang' => $barang->kode_barang,
                'Nama Barang' => $barang->nama_barang,
                'Vendor' => $barang->vendor, // Pastikan ini sesuai dengan relasi yang ada
                'Kuantiti' => $barang->kuantiti,
                'Tanggal' => $barang->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'Vendor',
            'Kuantiti',
            'Tanggal',
        ];
    }
}
