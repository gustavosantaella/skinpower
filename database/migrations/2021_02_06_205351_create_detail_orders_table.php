<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('idproduct');
            $table->unsignedInteger('idorder');
            $table->double('price');
            $table->bigInteger('stock');
   


            $table->foreign('idproduct')->references('idproduct')->on('products')->onDelete('cascade');
            $table->foreign('idorder')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_orders');
    }
}
