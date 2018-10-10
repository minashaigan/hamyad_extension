<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');

            $table->text('description');
            $table->integer('type');
            $table->integer('score');
            $table->string('link')->nullable();
            $table->string('file')->nullable();
            $table->string('image')->nullable();

            $table->unsignedInteger('exam_id');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('questions', function($table) {
            $table->foreign('exam_id')->references('id')->on('exams')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
