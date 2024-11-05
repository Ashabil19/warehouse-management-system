<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->decimal('harga_beli', 10, 2);
            $table->string('kategori');
            $table->integer('kuantiti');
            $table->string('vendor');
            $table->text('deskripsi')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menyimpan ID user yang mengupload
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
