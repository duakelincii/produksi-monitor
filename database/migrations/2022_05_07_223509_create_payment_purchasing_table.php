<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentPurchasingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->string('id_pesanan')->nullable();
            $table->string('id_purchasing')->nullable();
            $table->dateTime('tgl_bayar');
            $table->string('jumlah_bayar');
            $table->string('nama_rekening');
            $table->string('no_rekening');
            $table->string('bukti_bayar');
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
        Schema::dropIfExists('payment_purchasing');
    }
}
