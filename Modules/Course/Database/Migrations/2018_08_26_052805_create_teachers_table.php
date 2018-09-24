<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('resume');
            $table->string('linkedin')->nullable();
            $table->string('image');
            $table->string('email1');
            $table->string('email2')->nullable();
            $table->text('about')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('username', 20)->unique();
            $table->string('password');
            $table->string('melli_code');
            $table->string('IBAN');
            $table->text('education')->nullable();
            $table->text('work_experience')->nullable();
            $table->string('join_date');
            $table->string('telephone')->nullable();
            $table->string('phone');
            $table->text('address')->nullable();
            $table->integer('purchase_partnership');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
