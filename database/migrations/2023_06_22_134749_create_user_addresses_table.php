<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->text('first_address');
            $table->text('second_address')->nullable();
            $table->string('name');
            $table->bigInteger('phone');
            $table->enum('type', ['home', 'workplace', 'other']);
            $table->enum('is_default', ['0', '1']);
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
        Schema::dropIfExists('user_addresses');
    }
}
