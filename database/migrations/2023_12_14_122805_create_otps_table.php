<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('otp');
            $table->enum('from', ['phone', 'email']);
            $table->enum('user_type', ['user', 'vendor']);
            $table->enum('type', ['register', 'verification', 'login']);
            $table->enum('is_verified', ['1', '0'])->default('0');
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
        Schema::dropIfExists('otps');
    }
}
