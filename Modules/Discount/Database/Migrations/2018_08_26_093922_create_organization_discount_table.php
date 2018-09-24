<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Organization')) {
            Schema::create('organization_discount', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('organization_id');
                $table->unsignedInteger('discount_id');

                $table->unique(array('organization_id', 'discount_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('organization_discount', function ($table) {
                $table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('organization_discount');
    }
}
