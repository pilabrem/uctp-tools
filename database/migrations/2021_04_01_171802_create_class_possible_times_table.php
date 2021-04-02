<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassPossibleTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_possible_times', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('classe_id')->unsigned()->nullable()->index();
            $table->string('days');
            $table->integer('start');
            $table->integer('length');
            $table->string('weeks');
            $table->integer('penalty');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('class_possible_times');
    }
}
