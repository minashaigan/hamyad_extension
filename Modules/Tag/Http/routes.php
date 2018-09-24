<?php

Route::group(['middleware' => 'web', 'prefix' => 'tag', 'namespace' => 'Modules\Tag\Http\Controllers'], function()
{
    Route::get('/', 'TagController@index');
});
