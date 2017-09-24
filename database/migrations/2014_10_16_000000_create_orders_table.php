<?php

use App\User;
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
            $table->increments('id');

            $table->integer('user_id');
            $table->enum('status', [
                Order::STATUS_PENDING,
                Order::STATUS_PAYED,
                Order::STATUS_SHIPPED,
                Order::STATUS_COMPLETED,
            ])->default(Order::STATUS_PENDING);

            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('qty');

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('order_products');
    }
}
