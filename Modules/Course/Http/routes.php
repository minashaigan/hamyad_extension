<?php

// web

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Course\Http\Controllers'], function()
{
    Route::get('course/all', 'CourseController@index');
    Route::get('course/{id}', 'CourseController@show');
    Route::get('teacher/all', 'TeacherController@index');
    Route::get('teacher/{id}', 'TeacherController@show');
});

// api

//$api = app('Dingo\Api\Routing\Router');

//$api->version('v1', ['middleware' => 'profile_json_response', 'namespace' => 'Modules\Course\Http\Controllers\Api\V1'], function ($api)
//{
//    $api->get('course/all', ['as' => 'courses.index', 'uses' => 'ApiCourseController@index']);
//    $api->get('course/{id}', ['as' => 'courses.show', 'uses' => 'ApiCourseController@show']);
//});


