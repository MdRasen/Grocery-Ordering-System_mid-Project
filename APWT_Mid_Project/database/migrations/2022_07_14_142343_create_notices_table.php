<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->integer('a_id')->unsigned()->nullable();
            $table->foreign('a_id')->references('id')->on('admins');
            $table->integer('c_id')->unsigned()->nullable();
            $table->foreign('c_id')->references('id')->on('customers');
            $table->integer('v_id')->unsigned()->nullable();
            $table->foreign('v_id')->references('id')->on('vendors');
            $table->string('email', 100);
            $table->string('user_type', 20)->nullable();
            $table->string('subject', 200)->nullable();
            $table->string('message', 300)->nullable();
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
        Schema::dropIfExists('notices');
    }
}
