<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('logo');
            $table->text('description')->nullable();
            $table->string('subdomain');
            $table->string('email');
            $table->string('IBAN');
            $table->string('join_date');
            $table->string('username');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('manager_number');
            $table->string('manager_name');

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
        Schema::dropIfExists('organizations');
    }
}
