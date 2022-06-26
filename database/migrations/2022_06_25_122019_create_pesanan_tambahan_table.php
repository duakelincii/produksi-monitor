<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTambahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_tambahan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pesanan');
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_aksesoris');
            $table->integer('qty_aksesoris');

            $table->foreign('id_pesanan')->references('id')->on('pesanan');
            $table->foreign('id_product')->references('id')->on('product');
            $table->foreign('id_aksesoris')->references('id')->on('aksesoris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_tambahan');
    }
}
