<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditProblemClassForRandom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('problems', function (Blueprint $table) {
            $table->enum('is_random', [0, 1])->default(0);
            $table->enum('is_generated', [0, 1])->default(0);
            $table->enum('problem_class', ['small', 'medium', 'large'])->default('small')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('problems', function (Blueprint $table) {
            $table->dropColumn('is_random', 'is_generated', 'problem_class');
        });
    }
}
