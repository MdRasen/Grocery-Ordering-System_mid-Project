<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqDeliverymenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_deliverymen', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('username', 100)->unique();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->integer('phone');
            $table->string('password', 100);
            $table->string('gender');
            $table->string('dob');
            $table->string('address', 300);
            $table->string('valid')->nullable();
            $table->integer('nid')->unique()->nullable(); //For Nullable Value -MR            
            $table->string('propic')->nullable(); //For Nullable Value -MR
            $table->integer('cd_id')->unsigned()->nullable(); //For Nullable Value -MR
            //$table->foreign('cd_id')->references('id')->on('customer_deliverymen');
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
        Schema::dropIfExists('req_deliverymen');
    }
}
