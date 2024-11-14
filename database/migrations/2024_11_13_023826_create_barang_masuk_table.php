<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('kategori');
            $table->integer('harga_beli');
            $table->integer('kuantiti');
            $table->text('deskripsi_barang')->nullable();
            $table->string('vendor');
            
            $table->timestamps();
        });

        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->string('status')->default('pending'); // Kolom status dengan default 'pending'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_masuk');
    }
};
