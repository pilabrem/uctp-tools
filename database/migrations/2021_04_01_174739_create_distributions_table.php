<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->enum('type', ['SameStart','SameTime','SameDays','SameWeeks','SameRoom','Overlap','SameAttendees','Precedence','WorkDay','MinGap','MaxDays','MaxDayLoad','MaxBreaks','MaxBlock']);
            $table->boolean('is_required');
            $table->integer('penalty')->nullable();
            $table->integer('param1')->nullable();
            $table->integer('param2')->nullable();
            $table->integer('problem_id')->unsigned()->nullable()->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('distributions');
    }
}
