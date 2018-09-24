<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherProficiencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Course')) {
            Schema::create('teacher_proficiency', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('teacher_id');
                $table->unsignedInteger('proficiency_id');

                $table->unique(array('teacher_id', 'proficiency_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('teacher_proficiency', function ($table) {
                $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('teacher_proficiency');
    }
}
