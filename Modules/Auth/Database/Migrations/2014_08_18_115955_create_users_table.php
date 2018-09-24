<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('first_name')->default('نام');
            $table->string('last_name')->default('نام خانوادگی');
            $table->string('email', 250)->unique();
            $table->text('about')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('username', 20)->unique()->nullable();
            $table->string('password');
            $table->string('telephone', 10)->nullable();
            $table->string('phone', 12)->unique();
            $table->string('join_date');
            $table->text('address')->nullable();
            $table->string('image')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('melli_code')->nullable();
            
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
        Schema::dropIfExists('users');
    }
}
