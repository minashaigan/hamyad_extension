<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Course\Http\Controllers'], function()
{
    // course
    Route::get('course/all', 'CourseController@index');
    Route::get('course/{id}', 'CourseController@show');

    // teacher
    Route::get('teacher/all', 'TeacherController@index');
    Route::get('teacher/{id}', 'TeacherController@show');

    // category
    Route::get('category/all', 'CategoryController@index');
    Route::get('category/{id}', 'CategoryController@show');

    // organization
    Route::get('organization/all', 'OrganizationController@index');

    // main
    Route::get('home', 'MainController@home');
});

// api

//$api = app('Dingo\Api\Routing\Router');

//$api->version('v1', ['middleware' => 'profile_json_response', 'namespace' => 'Modules\Course\Http\Controllers\Api\V1'], function ($api)
//{
//    $api->get('course/all', ['as' => 'courses.index', 'uses' => 'ApiCourseController@index']);
//    $api->get('course/{id}', ['as' => 'courses.show', 'uses' => 'ApiCourseController@show']);
//});


