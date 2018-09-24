<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_groups', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('order');

            $table->unsignedInteger('course_id');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('section_groups', function($table) {
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_groups');
    }
}
