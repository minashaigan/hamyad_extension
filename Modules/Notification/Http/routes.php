<?php

Route::group(['middleware' => 'web', 'prefix' => 'notification', 'namespace' => 'Modules\Notification\Http\Controllers'], function()
{
    Route::get('/', 'NotificationController@index');
});
