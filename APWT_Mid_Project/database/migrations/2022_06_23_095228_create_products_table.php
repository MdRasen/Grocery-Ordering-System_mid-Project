<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('category');
            $table->string('thumbnail')->nullable();
            // $table->string('gallery')->nullable();
            $table->integer('price');            
            $table->integer('stock');          
            $table->integer('size')->nullable();
            $table->string('description', 300)->nullable();
            $table->integer('v_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('v_id')->references('id')->on('vendors');
            // $table->integer('cp_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cp_id')->references('id')->on('customer_products');
            //$table->integer('cartp_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cartp_id')->references('id')->on('cart_products');
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
        Schema::dropIfExists('products');
    }
}
