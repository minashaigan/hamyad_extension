<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use MongoDB\Client as Mongo;
Route::get('mongo', function(\Illuminate\Http\Request $request) {
    $sections = new \Modules\Course\Entities\UserSection();
    $sections->user_id = 1;
    $sections->section_id = 1;
    $sections->save();
    return $sections;
});

Route::get('/', function () {
    return view('welcome');
});
