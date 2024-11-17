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
        'status', // Tambahkan kolom status ke fillable
    ];

    public function barangmasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'id_barangmasuk');
    }

    public function kirimBarang()
    {
        return $this->hasMany(KirimBarang::class, 'id_stock', 'id_stock');
    }
}
