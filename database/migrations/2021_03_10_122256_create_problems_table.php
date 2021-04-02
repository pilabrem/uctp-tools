<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name', 255);
            $table->integer('nr_days');
            $table->integer('nr_weeks');
            $table->integer('slots_per_day');
            $table->integer('begin_hour');
            $table->string('week_days');
            $table->integer('minutes_per_slot');
            $table->integer('time_optimization');
            $table->integer('room_optimization');
            $table->integer('distribution_optimization');
            $table->integer('student_optimisation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('problems');
    }
}
