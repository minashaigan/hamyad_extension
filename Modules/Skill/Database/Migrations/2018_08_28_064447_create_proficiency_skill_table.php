<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProficiencySkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Proficiency')) {
            Schema::create('proficiency_skill', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('proficiency_id');
                $table->unsignedInteger('skill_id');

                $table->unique(array('proficiency_id', 'skill_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('proficiency_skill', function ($table) {
                $table->foreign('proficiency_id')->references('id')->on('proficiencies')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('proficiency_skill');
    }
}
