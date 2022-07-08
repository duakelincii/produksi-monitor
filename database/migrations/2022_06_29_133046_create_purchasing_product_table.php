<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasingProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasing_product', function (Blueprint $table) {
            $table->unsignedBigInteger('id_purchasing');
            $table->unsignedBigInteger('id_product');
            $table->integer('qty_product');

            $table->foreign('id_purchasing')->references('id')->on('purchasing');
            $table->foreign('id_product')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchasing_product');
    }
}
