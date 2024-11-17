<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barangmasuk');
            $table->date('tanggal_masuk');
            $table->integer('jumlah');
            $table->timestamps();

            // Pastikan foreign key mengacu ke 'barang_masuk'
            $table->foreign('id_barangmasuk')->references('id')->on('barang_masuk')->onDelete('cascade');
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->string('status')->default('Stock'); // Kolom status dengan default 'pending'
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
