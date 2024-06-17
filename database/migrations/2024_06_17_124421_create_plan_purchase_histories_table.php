<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanPurchaseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_purchase_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('plan_id');
            $table->string('order_id');
            $table->string('payment_id')->nullable();
            $table->string('payment_signature')->nullable();
            $table->text('plan_detail');
            $table->integer('duration')->comment('in days');
            $table->double('amount',15,2);
            $table->enum('payment_status', ['created', 'authorized', 'captured', 'refunded', 'failed'])->default('created');
            $table->enum('plan_status', ['active', 'expired', 'hold', 'cancelled'])->nullable();
            $table->string('plan_expired_time')->nullable();
            $table->string('plan_activated_time')->nullable();
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
        Schema::dropIfExists('plan_purchase_histories');
    }
}
