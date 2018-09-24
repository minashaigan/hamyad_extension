<?php

Route::group(['middleware' => 'web', 'prefix' => 'organization', 'namespace' => 'Modules\Organization\Http\Controllers'], function()
{
    Route::get('/', 'OrganizationController@index');
});
