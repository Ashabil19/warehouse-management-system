<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KirimBarang extends Model
{
    use HasFactory;

    protected $table = 'kirimbarang';

    protected $fillable = [
        'barang',
        'nama_customer',
        'alamat_customer',
        'email_customer',
    ];
}
