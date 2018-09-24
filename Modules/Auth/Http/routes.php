<?php

Route::group(['middleware' => 'web', 'prefix' => 'auth', 'namespace' => 'Modules\Auth\Http\Controllers'], function()
{
    Route::get('/index', 'AuthController@index');
    
    // Auth
    Route::get('/register', function (){
        return view('auth::register');
    });
    Route::post('/register/submit', ['as' => 'register', 'uses' => 'AuthController@register']);
    Route::get('/login', function (){
        return view('auth::login');
    });
    Route::post('/login/submit', ['as' => 'login', 'uses' => 'AuthController@login']);
});
