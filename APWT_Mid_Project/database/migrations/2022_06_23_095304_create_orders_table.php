<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('p_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('p_id')->references('id')->on('products');
            $table->integer('quantity');
            $table->integer('c_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('c_id')->references('id')->on('customers');
            $table->string('status');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('delivery_address');
            $table->integer('co_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('co_id')->references('id')->on('coupons');
            // $table->integer('v_id')->unsigned()->nullable(); //For Nullable Value -MR
            // $table->foreign('v_id')->references('id')->on('vendors');
            $table->integer('d_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('d_id')->references('id')->on('deliverymen');
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
        Schema::dropIfExists('orders');
    }
}
