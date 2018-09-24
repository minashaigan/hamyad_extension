<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Course')) {
            Schema::create('course_skill', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('course_id');
                $table->unsignedInteger('skill_id');

                $table->unique(array('course_id', 'skill_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('course_skill', function ($table) {
                $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('skill_id')->references('id')->on('skills')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('course_skill');
    }
}
