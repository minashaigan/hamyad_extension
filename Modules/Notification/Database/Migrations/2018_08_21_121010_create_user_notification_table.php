<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( \Module::collections()->has('Auth')) {
            Schema::create('user_notification', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedBigInteger('user_id');
                $table->unsignedInteger('notification_id');

                $table->unique(array('user_id', 'notification_id'));

                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('user_notification', function ($table) {
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('notification_id')->references('id')->on('notifications')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('user_notification');
    }
}
