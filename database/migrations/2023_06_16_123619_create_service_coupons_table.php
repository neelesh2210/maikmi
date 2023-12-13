<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('discount')->nullable();
            $table->longText('description')->nullable();
            $table->longText('services_ids')->nullable();
            $table->longText('salons_ids')->nullable();
            $table->longText('categories_ids')->nullable();
            $table->string('start_at')->nullable();
            $table->string('end_at')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('service_coupons');
    }
}
