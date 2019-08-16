<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerciseProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_program', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('exercise_id');
            $table->unsignedInteger('program_id');
            $table->integer('time');

            $table->foreign('exercise_id')->references('id')->on('exercises');
            $table->foreign('program_id')->references('id')->on('programs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercice_program');
    }
}
