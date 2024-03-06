<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKycToSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salons', function (Blueprint $table) {
            $table->enum('kyc_document_type', ['aadhar', 'pan'])->nullable()->after('added_by');
            $table->string('kyc_document')->nullable()->after('kyc_document_type');
            $table->enum('kyc_status', ['1', '0'])->default('0')->after('kyc_document');
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
            $table->dropColumn('kyc_document_type');
            $table->dropColumn('kyc_document');
            $table->dropColumn('kyc_status');
        });
    }
}
