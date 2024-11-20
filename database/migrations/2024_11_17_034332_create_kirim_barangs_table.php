<?
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKirimbarangTable extends Migration
{
    public function up()
    {
        Schema::create('kirimbarang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_stock')->constrained('stocks')->onDelete('cascade'); // Menghubungkan dengan tabel stocks
            $table->string('nama_customer');
            $table->text('alamat_customer');
            $table->string('email_customer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kirimbarang');
    }
}

