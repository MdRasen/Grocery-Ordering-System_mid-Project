<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_coupons', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('c_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('c_id')->references('id')->on('customers');
            $table->integer('co_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('co_id')->references('id')->on('coupons');
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
        Schema::dropIfExists('customer_coupons');
    }
}
