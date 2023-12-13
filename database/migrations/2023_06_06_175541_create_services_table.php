<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('users id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('salon_id')->unsigned();
            $table->foreign('salon_id')->references('id')->on('salons')->onDelete('cascade');
            $table->longText('service_category_ids')->nullable();
            $table->longText('service_subcategory_ids')->nullable();
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('duration')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->longText('addon_services')->nullable();
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('enable_booking')->default(0);
            $table->tinyInteger('enable_at_salon')->default(0);
            $table->tinyInteger('enable_at_customer_address')->default(0);
            $table->tinyInteger('available')->default(0);
            $table->tinyInteger('is_ban')->default(0);
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
        Schema::dropIfExists('services');
    }
}
