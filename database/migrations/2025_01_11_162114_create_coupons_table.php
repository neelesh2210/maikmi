<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('salon_id')->index();
            $table->string('slug')->unique()->index();
            $table->string('code')->unique()->index();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->enum('amount_type', ['amount', 'percent']);
            $table->double('amount', 15, 2);
            $table->text('description')->nullable();
            $table->enum('coupon_type', ['service', 'total_order_value']);
            $table->longText('service_ids')->nullable();
            $table->double('total_order_amount',15,2)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('number_of_usages');
            $table->integer('total_used')->default(0);
            $table->enum('is_active', ['1', '0']);
            $table->softDeletes();
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
        Schema::dropIfExists('coupons');
    }
}
