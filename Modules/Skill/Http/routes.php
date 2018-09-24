<?php

Route::group(['middleware' => 'web', 'prefix' => 'skill', 'namespace' => 'Modules\Skill\Http\Controllers'], function()
{
    Route::get('/', 'SkillController@index');
});
