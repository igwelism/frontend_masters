<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('order_no');
            $table->string('payment_status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('customer_fullname')->nullable();
            $table->unsignedBigInteger('item_count')->nullable();
            $table->unsignedBigInteger('subTotal')->nullable();
            $table->unsignedBigInteger('total')->nullable();
            $table->string('service_status')->nullable();
            $table->time('start_date')->nullable();
            $table->time('end_date')->nullable();
            $table->timestamps();
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
