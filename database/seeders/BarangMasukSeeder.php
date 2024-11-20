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
            [
                'kode_barang' => 'BRG006',
                'nama_barang' => 'Speaker JBL',
                'kategori' => 'Audio',
                'harga_beli' => 600000,
                'kuantiti' => 30,
                'deskripsi_barang' => 'Speaker JBL portable dengan kualitas suara terbaik.',
                'vendor' => 'JBL',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG007',
                'nama_barang' => 'Keyboard Mechanical',
                'kategori' => 'Perangkat Komputer',
                'harga_beli' => 750000,
                'kuantiti' => 20,
                'deskripsi_barang' => 'Keyboard mechanical RGB untuk pengalaman mengetik yang nyaman.',
                'vendor' => 'Keychron',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG008',
                'nama_barang' => 'Harddisk Eksternal',
                'kategori' => 'Penyimpanan',
                'harga_beli' => 1000000,
                'kuantiti' => 15,
                'deskripsi_barang' => 'Harddisk eksternal 1TB untuk penyimpanan data.',
                'vendor' => 'Seagate',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG009',
                'nama_barang' => 'Power Bank',
                'kategori' => 'Aksesoris',
                'harga_beli' => 300000,
                'kuantiti' => 100,
                'deskripsi_barang' => 'Power bank 20,000 mAh untuk mengisi daya saat bepergian.',
                'vendor' => 'Anker',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG010',
                'nama_barang' => 'Monitor Dell',
                'kategori' => 'Elektronik',
                'harga_beli' => 2000000,
                'kuantiti' => 7,
                'deskripsi_barang' => 'Monitor Dell 24 inch dengan resolusi Full HD.',
                'vendor' => 'Dell',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG011',
                'nama_barang' => 'Webcam Logitech',
                'kategori' => 'Perangkat Komputer',
                'harga_beli' => 500000,
                'kuantiti' => 40,
                'deskripsi_barang' => 'Webcam Logitech untuk meeting online.',
                'vendor' => 'Logitech',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG012',
                'nama_barang' => 'Proyektor Epson',
                'kategori' => 'Elektronik',
                'harga_beli' => 4000000,
                'kuantiti' => 3,
                'deskripsi_barang' => 'Proyektor Epson untuk presentasi profesional.',
                'vendor' => 'Epson',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
