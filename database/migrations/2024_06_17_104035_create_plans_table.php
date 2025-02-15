<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->double('price',15,2);
            $table->double('discounted_price',15,2);
            $table->integer('duration')->comment('in days');
            $table->longText('description')->nullable();
            $table->longText('term_and_condition')->nullable();
            $table->enum('is_active', ['1', '0'])->default('1')->comment('1=>active,0=>inactive');
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
        Schema::dropIfExists('plans');
    }
}
