<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Course')) {
            Schema::create('category_tag', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('category_id');
                $table->unsignedInteger('tag_id');

                $table->unique(array('category_id', 'tag_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('category_tag', function ($table) {
                $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('category_tag');
    }
}
