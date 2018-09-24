<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTemporaryCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_temporary_codes', function (Blueprint $table) {
            $table->increments('id');

            $table->text('code');

            $table->unsignedBigInteger('user_id');

            $table->unique('user_id');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('user_temporary_codes', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_temporary_codes');
    }
}
