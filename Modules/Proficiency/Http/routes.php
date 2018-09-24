<?php

Route::group(['middleware' => 'web', 'prefix' => 'proficiency', 'namespace' => 'Modules\Proficiency\Http\Controllers'], function()
{
    Route::get('/', 'ProficiencyController@index');
});
