<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Course')) {
            Schema::create('teacher_skill', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('teacher_id');
                $table->unsignedInteger('skill_id');

                $table->unique(array('teacher_id', 'skill_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('teacher_skill', function ($table) {
                $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('teacher_skill');
    }
}
