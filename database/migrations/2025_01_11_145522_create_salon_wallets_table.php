<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salon_wallets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('salon_id');
            $table->double('amount',15,2);
            $table->bigInteger('source_id');
            $table->string('source');
            $table->enum('type', ['credit', 'debit']);
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
        Schema::dropIfExists('salon_wallets');
    }
}
