<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('admins', function (Blueprint $table) {
        //     $table->increments('id');            
        //     $table->string('username', 100)->unique();
        //     $table->string('name', 100);
        //     $table->string('email', 100)->unique();
        //     $table->integer('phone');
        //     $table->string('password', 100);
        //     $table->string('gender');
        //     $table->string('dob');
        //     $table->string('address', 300);
        //     $table->string('propic')->nullable(); //For Nullable Value -MR
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('vendors', function (Blueprint $table) {
        //     $table->increments('id');            
        //     $table->string('username', 100)->unique();
        //     $table->string('name', 100);
        //     $table->string('email', 100)->unique();
        //     $table->integer('phone');
        //     $table->string('password', 100);
        //     $table->string('gender');
        //     $table->string('dob');
        //     $table->string('address', 300);
        //     $table->string('propic')->nullable(); //For Nullable Value -MR
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('customers', function (Blueprint $table) {

        //     $table->increments('id');            
        //     $table->string('username', 100)->unique();
        //     $table->string('name', 100);
        //     $table->string('email', 100)->unique();
        //     $table->integer('phone');
        //     $table->string('password', 100);
        //     $table->string('gender');
        //     $table->string('dob');
        //     $table->string('address', 300);
        //     // $table->integer('cart_id')->nullable();
        //     $table->string('propic')->nullable(); //For Nullable Value -MR
        //     // $table->integer('cco_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     // $table->foreign('cco_id')->references('id')->on('customer_coupons');
        //     // $table->integer('cp_id')->unsigned()->nullable();; //For Nullable Value -MR
        //     // $table->foreign('cp_id')->references('id')->on('customer_products');
        //     $table->integer('cd_id')->unsigned()->nullable();; //For Nullable Value -MR
        //     // $table->foreign('cd_id')->references('id')->on('customer_deliverymans');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('deliverymen', function (Blueprint $table) {
        //     $table->increments('id');            
        //     $table->string('username', 100)->unique();
        //     $table->string('name', 100);
        //     $table->string('email', 100)->unique();
        //     $table->integer('phone');
        //     $table->string('password', 100);
        //     $table->string('gender');
        //     $table->string('dob');
        //     $table->string('address', 300);
        //     $table->string('valid')->nullable();
        //     $table->integer('nid')->unique()->nullable(); //For Nullable Value -MR            
        //     $table->string('propic')->nullable(); //For Nullable Value -MR
        //     $table->integer('cd_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     //$table->foreign('cd_id')->references('id')->on('customer_deliverymans');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('products', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name', 100);
        //     $table->string('category');
        //     $table->string('thumbnail')->nullable();
        //     // $table->string('gallery')->nullable();
        //     $table->integer('price');            
        //     $table->integer('stock');          
        //     $table->integer('size')->nullable();
        //     $table->string('description', 300)->nullable();
        //     $table->integer('v_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('v_id')->references('id')->on('vendors');
        //     // $table->integer('cp_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     //$table->foreign('cp_id')->references('id')->on('customer_products');
        //     // $table->integer('cartp_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     //$table->foreign('cartp_id')->references('id')->on('cart_products');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('carts', function (Blueprint $table) {
        //     $table->increments('id');    
        //     $table->integer('quantity');
        //     $table->integer('c_id')->unsigned();//->nullable(); //For Nullable Value -MR
        //     $table->foreign('c_id')->references('id')->on('customers');
        //     $table->integer('p_id')->unsigned();//->nullable(); //For Nullable Value -MR
        //     $table->foreign('p_id')->references('id')->on('products');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('orders', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('p_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('p_id')->references('id')->on('products');
        //     $table->integer('quantity');
        //     $table->integer('c_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('c_id')->references('id')->on('customers');
        //     $table->string('status');
        //     $table->string('payment_method');
        //     $table->string('payment_status');
        //     $table->string('delivery_address');
        //     $table->integer('co_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     //$table->foreign('co_id')->references('id')->on('coupons');
        //     // $table->integer('v_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     // $table->foreign('v_id')->references('id')->on('vendors');
        //     $table->integer('d_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('d_id')->references('id')->on('deliverymen');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('coupons', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('code')->unique(); //integer to string -MR
        //     $table->integer('amount');
        //     $table->integer('v_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('v_id')->references('id')->on('vendors');
        //     // $table->integer('cco_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     // $table->foreign('cco_id')->references('id')->on('customer_coupons');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('reviews', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('message', 300)->nullable();
        //     $table->integer('c_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('c_id')->references('id')->on('customers');
        //     $table->integer('p_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('p_id')->references('id')->on('products');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('customer_coupons', function (Blueprint $table) {
        //     $table->increments('id');            
        //     $table->integer('c_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('c_id')->references('id')->on('customers');
        //     $table->integer('co_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('co_id')->references('id')->on('coupons');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('customer_products', function (Blueprint $table) {
        //     $table->increments('id');    
        //     $table->integer('c_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('c_id')->references('id')->on('customers');
        //     $table->integer('p_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('p_id')->references('id')->on('products');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('customer_deliverymen', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('c_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('c_id')->references('id')->on('customers');
        //     $table->integer('d_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('d_id')->references('id')->on('deliverymen');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('req_deliverymen', function (Blueprint $table) {
        //     $table->increments('id');            
        //     $table->string('username', 100)->unique();
        //     $table->string('name', 100);
        //     $table->string('email', 100)->unique();
        //     $table->integer('phone');
        //     $table->string('password', 100);
        //     $table->string('gender');
        //     $table->string('dob');
        //     $table->string('address', 300);
        //     $table->string('valid')->nullable();
        //     $table->integer('nid')->unique()->nullable(); //For Nullable Value -MR            
        //     $table->string('propic')->nullable(); //For Nullable Value -MR
        //     $table->integer('cd_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('cd_id')->references('id')->on('customer_deliverymen');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('notices', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('a_id')->unsigned()->nullable();
        //     $table->foreign('a_id')->references('id')->on('admins');
        //     $table->integer('c_id')->unsigned()->nullable();
        //     $table->foreign('c_id')->references('id')->on('customers');
        //     $table->integer('v_id')->unsigned()->nullable();
        //     $table->foreign('v_id')->references('id')->on('vendors');
        //     $table->string('email', 100);
        //     $table->string('user_type', 20)->nullable();
        //     $table->string('subject', 200)->nullable();
        //     $table->string('message', 300)->nullable();
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('product_orders', function (Blueprint $table) {
        //     $table->increments('id');            
        //     $table->integer('p_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('p_id')->references('id')->on('products');
        //     $table->integer('o_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('o_id')->references('id')->on('orders');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });
        // Schema::create('req_coupons', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('code')->unique(); //integer to string -MR
        //     $table->integer('amount');
        //     $table->integer('v_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     $table->foreign('v_id')->references('id')->on('vendors');
        //     $table->timestamp('created_at')->nullable();
        //     $table->timestamp('updated_at')->nullable();
        // });

        Schema::table('customers', function (Blueprint $table) {
            // $table->foreign('cco_id')->references('id')->on('customer_coupons');
            // $table->foreign('cp_id')->references('id')->on('customer_products');
            $table->foreign('cd_id')->references('id')->on('customer_deliverymen');
        });
        Schema::table('deliverymen', function (Blueprint $table) {
            $table->foreign('cd_id')->references('id')->on('customer_deliverymen');
        });
        // Schema::table('products', function (Blueprint $table) {
        //     $table->foreign('cp_id')->references('id')->on('customer_products');
        //     //$table->integer('cartp_id')->unsigned()->nullable(); //For Nullable Value -MR
        //     //$table->foreign('cartp_id')->references('cartp_id')->on('cart_products');
        // });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('co_id')->references('id')->on('coupons');
        });
        // Schema::table('coupons', function (Blueprint $table) {
        //     $table->foreign('cco_id')->references('id')->on('customer_coupons');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table');
    }
}
