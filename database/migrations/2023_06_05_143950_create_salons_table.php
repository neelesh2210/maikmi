<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('user_id')->unsigned()->comment('users id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('availability_range')->nullable();
            $table->longText('description')->nullable();
            $table->longText('gallery')->nullable();
            $table->tinyInteger('available')->default(1);
            $table->tinyInteger('featured')->default(0);
            $table->longText('services')->nullable();
            $table->bigInteger('added_by')->nullable()->unsigned()->comment('admins id');
            $table->foreign('added_by')->references('id')->on('admins')->onDelete('cascade');
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
        Schema::dropIfExists('salons');
    }
}
