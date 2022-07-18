<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');    
            $table->integer('quantity');
            $table->integer('c_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('c_id')->references('id')->on('customers');
            $table->integer('p_id')->unsigned();//->nullable(); //For Nullable Value -MR
            $table->foreign('p_id')->references('id')->on('products');
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
        Schema::dropIfExists('carts');
    }
}
