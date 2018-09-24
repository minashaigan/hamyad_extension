<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseProducerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_producer', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('course_id');
            $table->unsignedInteger('producer_id');

            $table->unique( array('course_id','producer_id') );

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('course_producer', function($table) {
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('producer_id')->references('id')->on('producers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_producer');
    }
}
