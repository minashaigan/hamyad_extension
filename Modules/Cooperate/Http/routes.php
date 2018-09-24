<?php

Route::group(['middleware' => 'web', 'prefix' => 'cooperate', 'namespace' => 'Modules\Cooperate\Http\Controllers'], function()
{
    Route::get('/', 'CooperateController@index');
});
