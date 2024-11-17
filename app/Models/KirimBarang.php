<?php

// app/Models/KirimBarang.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KirimBarang extends Model
{
    use HasFactory;

    protected $table = 'kirimbarang';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_customer',
        'alamat_customer',
        'email_customer',
        'id_stock', // Menggunakan foreign key id_stock
    ];

    // Relasi dengan model Stock
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock'); // id_stock sebagai foreign key
    }
}

