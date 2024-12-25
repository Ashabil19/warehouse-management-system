<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangMasukExport implements FromCollection
{
    public function collection()
    {
        return BarangMasuk::select('kode_barang', 'nama_barang', 'vendor', 'kuantiti', 'created_at')->get();
    }
}
