<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->bigInteger('user_id');
            $table->bigInteger('salon_id');
            $table->bigInteger('booked_id');
            $table->longText('salon');
            $table->longText('products');
            $table->bigInteger('total_amount');
            $table->longText('address');
            $table->enum('payment_type', ['cod', 'online']);
            $table->longText('payment_detail')->nullable();
            $table->longText('product_order_status')->nullable();
            $table->longText('product_detail_order_status')->nullable();
            $table->longText('remark')->nullable();
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
        Schema::dropIfExists('product_orders');
    }
}
