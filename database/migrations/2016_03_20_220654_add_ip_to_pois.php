<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIpToPois extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('point_of_interests', function (Blueprint $table) {
            //
            $table->string('ip_address')->nullable()->default('0.0.0.0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('point_of_interests', function (Blueprint $table) {
            //
            $table->dropColumn('ip_address');
        });
    }
}
