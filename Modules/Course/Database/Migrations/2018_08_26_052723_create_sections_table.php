<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('link')->nullable();
            $table->text('description');
            $table->string('file')->nullable();
            $table->string('cover')->nullable();
            $table->integer('time')->default('0');

            $table->unsignedInteger('section_group_id');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('sections', function($table) {
            $table->foreign('section_group_id')->references('id')->on('section_groups')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
