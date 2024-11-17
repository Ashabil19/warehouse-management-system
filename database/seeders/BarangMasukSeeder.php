<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang_masuk')->insert([
            [
                'kode_barang' => 'BRG001',
                'nama_barang' => 'Laptop ASUS',
                'kategori' => 'Elektronik',
                'harga_beli' => 8000000,
                'kuantiti' => 10,
                'deskripsi_barang' => 'Laptop ASUS ROG dengan prosesor Intel i7.',
                'vendor' => 'ASUS',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG002',
                'nama_barang' => 'Smartphone Xiaomi',
                'kategori' => 'Elektronik',
                'harga_beli' => 3000000,
                'kuantiti' => 50,
                'deskripsi_barang' => 'Smartphone Xiaomi Redmi Note 11',
                'vendor' => 'Xiaomi',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG003',
                'nama_barang' => 'Kabel HDMI',
                'kategori' => 'Aksesoris',
                'harga_beli' => 150000,
                'kuantiti' => 200,
                'deskripsi_barang' => 'Kabel HDMI 3 meter, cocok untuk TV dan perangkat elektronik lainnya.',
                'vendor' => 'Anker',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG004',
                'nama_barang' => 'Printer Canon',
                'kategori' => 'Peralatan Kantor',
                'harga_beli' => 1200000,
                'kuantiti' => 5,
                'deskripsi_barang' => 'Printer Canon PIXMA untuk cetak dokumen berkualitas.',
                'vendor' => 'Canon',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG005',
                'nama_barang' => 'Mouse Logitech',
                'kategori' => 'Perangkat Komputer',
                'harga_beli' => 250000,
                'kuantiti' => 100,
                'deskripsi_barang' => 'Mouse Logitech wireless dengan desain ergonomis.',
                'vendor' => 'Logitech',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
