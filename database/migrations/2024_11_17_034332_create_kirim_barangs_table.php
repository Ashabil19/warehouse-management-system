<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKirimBarangsTable extends Migration
{
    public function up()
    {
        Schema::create('kirim_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_stock')->constrained('stocks')->onDelete('cascade'); // References 'stocks' table
            $table->string('nama_customer');
            $table->text('alamat_customer');
            $table->string('email_customer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kirim_barangs');
    }
}
