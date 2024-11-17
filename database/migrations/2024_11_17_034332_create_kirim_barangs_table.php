<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kirimbarang', function (Blueprint $table) {
            $table->id('id_kirimbarang');
            $table->string('barang');
            $table->string('nama_customer');
            $table->text('alamat_customer');
            $table->string('email_customer');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kirim_barangs');
    }
};
