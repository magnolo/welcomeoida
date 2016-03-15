<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_of_interests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->index();

            $table->string('slug');
            $table->string('title');
            $table->double('lat');
            $table->double('lng');
            $table->string('street_name')->nullable();
            $table->string('address')->nullable();
            $table->string('building_number')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            // $table->foreign('type_id')
            //   ->references('id')
            //   ->on('point_of_interests_types')
            //   ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('point_of_interests');
    }
}
