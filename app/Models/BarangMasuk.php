<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    protected $fillable = [
        'kode_barang',
        'harga_beli',
        'nama_barang',
        'kategori',
        'kuantiti',
        'deskripsi_barang',
        'vendor',
    ];

    // Relasi dengan Stock
    public function stock()
    {
        return $this->hasMany(Stock::class, 'id_barangmasuk');
    }
}
