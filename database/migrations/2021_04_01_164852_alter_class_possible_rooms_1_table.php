<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterClassPossibleRooms1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_possible_rooms', function(Blueprint $table)
        {
            $table->integer('classe_id')->unsigned()->nullable()->index();
            $table->dropColumn('class_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_possible_rooms', function(Blueprint $table)
        {
            $table->dropColumn('classe_id');
            $table->integer('class_id')->unsigned()->nullable()->index();

        });
    }
}
