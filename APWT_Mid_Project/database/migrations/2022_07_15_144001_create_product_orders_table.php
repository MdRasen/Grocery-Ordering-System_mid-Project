<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('p_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('p_id')->references('id')->on('products');
            $table->integer('o_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('o_id')->references('id')->on('orders');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_orders');
    }
}
