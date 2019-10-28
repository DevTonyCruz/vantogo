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
            $table->integer('travel_id');
            $table->string('name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->double('subtotal')->default(0);
            $table->integer('quantity')->default(0);
            $table->double('total')->default(0);
            $table->integer('status')->default(1);
            $table->string('order_code');
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
