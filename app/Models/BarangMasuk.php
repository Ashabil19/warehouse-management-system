<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'barang_masuk';

    
    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_barang',
        'harga_beli',
        'nama_barang',
        'kategori',
        'kuantiti',
        'deskripsi_barang',
        'vendor', // Pastikan ini sesuai dengan kolom di tabel
    ];

    // Relasi dengan Stock
    public function stock()
    {
        return $this->hasMany(Stock::class, 'id_barangmasuk'); // Pastikan 'id_barangmasuk' sesuai dengan kolom di tabel stock
    }

    // Relasi dengan Vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor'); // Pastikan 'vendor' sesuai dengan kolom di tabel barang_masuk
    }
}
