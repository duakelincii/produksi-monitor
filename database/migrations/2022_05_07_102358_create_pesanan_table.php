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
            $table->string('id_customer');
            $table->string('id_product');
            $table->string('quantity');
            $table->dateTime('tgl_pesan');
            $table->dateTime('tgl_selesai');
            $table->dateTime('tgl_tempo');
            $table->string('barang_ready')->nullable();
            $table->string('harga_total')->nullable();
            $table->enum('status', ['order baru', 'proses', 'cuting', 'jahit', 'finishing', 'siap kirim', 'terkirim','selesai']);
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
