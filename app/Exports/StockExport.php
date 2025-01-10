<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Stock::with('barangMasuk') // Include relasi BarangMasuk
            ->get()
            ->map(function ($stock) {
                return [
                    'Nama Barang' => $stock->barangMasuk->nama_barang,
                    'Tanggal Masuk' => $stock->tanggal_masuk,
                    'Jumlah' => $stock->jumlah,
                    'Status' => $stock->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Barang',
            'Tanggal Masuk',
            'Jumlah',
            'Status',
        ];
    }
}
