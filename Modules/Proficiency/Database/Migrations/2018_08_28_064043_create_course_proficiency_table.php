<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseProficiencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Course')) {
            Schema::create('course_proficiency', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('course_id');
                $table->unsignedInteger('proficiency_id');

                $table->unique(array('course_id', 'proficiency_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('course_proficiency', function ($table) {
                $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('proficiency_id')->references('id')->on('proficiencies')->onUpdate('cascade')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_proficiency');
    }
}
