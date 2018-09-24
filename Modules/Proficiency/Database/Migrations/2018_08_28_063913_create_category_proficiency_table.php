<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProficiencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Course')) {
            Schema::create('category_proficiency', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('category_id');
                $table->unsignedInteger('proficiency_id');

                $table->unique(array('category_id', 'proficiency_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('category_proficiency', function ($table) {
                $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('category_proficiency');
    }
}
