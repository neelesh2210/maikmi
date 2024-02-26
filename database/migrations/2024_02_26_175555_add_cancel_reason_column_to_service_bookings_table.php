<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCancelReasonColumnToServiceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->longText('cancel_reason')->nullable()->after('remark');
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
            $table->dropColumn('cancel_reason');
        });
    }
}
