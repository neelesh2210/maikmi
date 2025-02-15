<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPartialPaymentColumnToSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salons', function (Blueprint $table) {
            $table->enum('is_partial_payment', ['1', '0'])->default('0')->after('kyc_status');
            $table->string('total_wallet_balance')->default('0')->after('kyc_document');
            $table->string('partial_payment_percent')->default('0')->after('total_wallet_balance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salons', function (Blueprint $table) {
            $table->dropColumn('is_partial_payment');
            $table->dropColumn('partial_payment_percent');
            // $table->dropColumn('total_wallet_balance');
        });
    }
}
