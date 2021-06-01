<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassPossibleRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_possible_rooms', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('room_id')->unsigned()->nullable()->index();
            $table->integer('penalty');
            $table->integer('classe_id')->unsigned()->nullable()->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('class_possible_rooms');
    }
}
