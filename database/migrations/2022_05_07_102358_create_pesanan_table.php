<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('id_product');
            $table->string('id_customer');
            $table->dateTime('tgl_pesan');
            $table->dateTime('tgl_selesai');
            $table->dateTime('tgl_tempo');
            $table->string('quantity');
            $table->string('harga_total');
            $table->enum('status', ['order baru', 'proses', 'cuting', 'jahit', 'finishing', 'siap kirim', 'terkirim']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
