<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Course')) {
            Schema::create('teacher_discount', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('teacher_id');
                $table->unsignedInteger('discount_id');

                $table->unique(array('teacher_id', 'discount_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('teacher_discount', function ($table) {
                $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('discount_id')->references('id')->on('discounts')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('teacher_discount');
    }
}
