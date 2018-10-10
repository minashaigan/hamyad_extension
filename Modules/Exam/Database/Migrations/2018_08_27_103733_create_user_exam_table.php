<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Auth')) {
            Schema::create('user_exam', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedBigInteger('user_id');
                $table->unsignedInteger('exam_id');

                $table->double('score')->default(0);
                $table->time('time')->nullable();

                $table->unique(array('user_id', 'exam_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('user_exam', function ($table) {
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('user_exam');
    }
}
