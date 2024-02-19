<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserUniqueIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_unique_id')->nullable()->unique()->after('id');
            $table->string('referrer_code')->nullable()->after('password');
            $table->enum('referrer_code_type', ['user', 'vendor'])->nullable()->after('referrer_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_unique_id');
            $table->dropColumn('referrer_code');
            $table->dropColumn('referrer_code_type');
        });
    }
}
