<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Course')) {
            Schema::create('course_exam', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('course_id');
                $table->unsignedInteger('exam_id');

                $table->unique(array('course_id', 'exam_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('course_exam', function ($table) {
                $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('exam_id')->references('id')->on('exams')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('course_exam');
    }
}
