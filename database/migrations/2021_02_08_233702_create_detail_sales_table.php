<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idsale');
            $table->integer('idproduct');
            $table->string('nameproduct');
            $table->string('brand');
            $table->double('price');
            $table->bigInteger('stock');

             $table->foreign('idsale')->references('id')->on('sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_sales');
    }
}
