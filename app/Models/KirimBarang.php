<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KirimBarang extends Model
{
    use HasFactory;

    protected $table = 'kirimbarang';

    protected $fillable = [
        'id_stock',
        'nama_customer',
        'alamat_customer',
        'email_customer',
    ];

    // Relasi dengan Stock
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }

    // Relasi dengan BarangMasuk
    public function barangMasuk()
    {
        return $this->hasOneThrough(BarangMasuk::class, Stock::class, 'id', 'id_barangmasuk', 'id_stock', 'id');
    }
}
