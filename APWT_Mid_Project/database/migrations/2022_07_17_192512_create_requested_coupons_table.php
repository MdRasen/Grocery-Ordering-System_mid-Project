<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestedCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique(); //integer to string -MR
            $table->integer('amount');
            $table->integer('v_id')->unsigned()->nullable(); //For Nullable Value -MR
            $table->foreign('v_id')->references('id')->on('vendors');
            // $table->integer('cco_id')->unsigned()->nullable(); //For Nullable Value -MR
            // $table->foreign('cco_id')->references('id')->on('customer_coupons');
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
        Schema::dropIfExists('requested_coupons');
    }
}
