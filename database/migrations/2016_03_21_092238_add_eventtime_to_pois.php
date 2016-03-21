<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventtimeToPois extends Migration
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
            $table->dateTime('from_date')->nullable();
            $table->dateTime('to_date')->nullable();
            
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
            $table->dropColumn(['from_date', 'to_date']);
        });
    }
}
