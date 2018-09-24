<?php

Route::group(['middleware' => 'web', 'prefix' => 'contactus', 'namespace' => 'Modules\ContactUs\Http\Controllers'], function()
{
    Route::get('/', 'ContactUsController@index');
});
