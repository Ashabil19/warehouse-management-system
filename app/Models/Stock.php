<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barangmasuk',
        'tanggal_masuk',
        'jumlah',
        'status', // Kolom status untuk update
    ];

    // Relasi dengan model BarangMasuk
    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'id_barangmasuk');
    }

    // Relasi dengan model KirimBarang
    public function kirimBarang()
    {
        return $this->hasMany(KirimBarang::class, 'id_stock');
    }

    // Relasi dengan model Vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id'); // Pastikan 'vendor_id' sesuai dengan kolom di tabel stock
    }
}
