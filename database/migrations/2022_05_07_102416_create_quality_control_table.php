<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_control', function (Blueprint $table) {
            $table->id();
            $table->string('id_pesanan');
            $table->string('id_product');
            $table->string('barang_rusak')->nullable();
            $table->string('barang_ready')->nullable();
            $table->text('ket')->nullable();
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
        Schema::dropIfExists('quality_control');
    }
}
