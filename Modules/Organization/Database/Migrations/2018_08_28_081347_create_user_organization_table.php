<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Auth')) {
            Schema::create('user_organization', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedBigInteger('user_id');
                $table->unsignedInteger('organization_id');

                $table->unique(array('user_id', 'organization_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('user_organization', function ($table) {
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('user_organization');
    }
}
