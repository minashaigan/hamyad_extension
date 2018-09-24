<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_teacher', function (Blueprint $table) {
            $table->increments('id');

            $table->string('subject');
            $table->text('body');
            $table->boolean('is_reminder')->default(1);

            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('parent_message_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('user_teacher', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parent_message_id')->references('id')->on('user_teacher')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_teacher');
    }
}
