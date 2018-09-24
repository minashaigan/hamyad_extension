<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Auth')) {
            Schema::create('user_course', function (Blueprint $table) {
                $table->increments('id');

                $table->double('rate', 3, 2)->nullable();

                $table->unsignedBigInteger('user_id');
                $table->unsignedInteger('course_id');

                $table->unique(array('user_id', 'course_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('user_course', function ($table) {
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('user_course');
    }
}
