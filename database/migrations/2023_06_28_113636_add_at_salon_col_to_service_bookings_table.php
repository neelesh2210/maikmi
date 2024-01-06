<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAtSalonColToServiceBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->smallInteger('at_salon')->nullable()->after('end_at');
            $table->longText('remark')->nullable()->after('at_salon');
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
            if (Schema::hasColumn('service_bookings', 'at_salon')){
                $table->dropColumn('at_salon');
            }
            if (Schema::hasColumn('service_bookings', 'remark')){
                $table->dropColumn('remark');
            }
        });
    }
}
