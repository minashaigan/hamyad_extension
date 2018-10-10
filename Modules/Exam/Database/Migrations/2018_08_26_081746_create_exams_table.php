<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('type');
            $table->boolean('time_limitation')->default(1);
            $table->time('time')->nullable();
            $table->integer('question_number');

            $table->unsignedInteger('category_id');
            
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('exams', function ($table) {
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
