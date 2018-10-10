<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Exam\Http\Controllers'], function()
{
    Route::get('exams/{id}', 'ExamController@show');
    Route::get('exams/{id}/questions', 'QuestionController@show');
});