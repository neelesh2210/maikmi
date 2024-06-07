<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->nullable();
            $table->bigInteger('user_id')->unsigned()->comment('salon users id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('salon_id')->unsigned();
            $table->foreign('salon_id')->references('id')->on('salons')->onDelete('cascade');
            $table->bigInteger('booked_by')->unsigned()->comment('users id');
            $table->foreign('booked_by')->references('id')->on('users')->onDelete('cascade');
            $table->longText('salon')->nullable();
            $table->longText('service')->nullable();
            $table->longText('coupon')->nullable();
            $table->smallInteger('quantity')->nullable();
            $table->bigInteger('total_amount')->nullable();
            $table->longText('address')->nullable();
            $table->enum('payment_type', ['cod', 'online'])->nullable()->default('cod');
            $table->string('booking_date')->nullable();
            $table->string('booking_time')->nullable();
            $table->string('booking_at')->nullable();
            $table->string('start_at')->nullable();
            $table->string('end_at')->nullable();
            $table->enum('status', ['waiting','pending', 'booked', 'time_update', 'confirmed', 'completed', 'cancelled'])->nullable()->default('pending');
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
        Schema::dropIfExists('service_bookings');
    }
}
