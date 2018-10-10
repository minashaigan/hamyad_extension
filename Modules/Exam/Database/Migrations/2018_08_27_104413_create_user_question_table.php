<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Auth')) {
            Schema::create('user_question', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedBigInteger('user_id');
                $table->unsignedInteger('question_id');

                $table->double('score')->default(0);

                $table->unique(array('user_id', 'question_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('user_question', function ($table) {
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('question_id')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('user_question');
    }
}
