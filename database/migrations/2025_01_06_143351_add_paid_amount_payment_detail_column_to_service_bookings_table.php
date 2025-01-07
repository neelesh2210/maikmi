<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidAmountPaymentDetailColumnToServiceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->string('paid_amount')->default(0)->after('total_amount');
            $table->longText('payment_detail')->nullable()->after('home_service_charge');
            $table->string('payment_status')->default('paid')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->dropColumn('paid_amount');
            $table->dropColumn('payment_detail');
            $table->dropColumn('payment_status');
        });
    }
}
