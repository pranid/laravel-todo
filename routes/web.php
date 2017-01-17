<?php

/**
 * Display All Tasks
 */


Auth::routes();

Route::get('/', 'HomeController@index');
Route::resource('project','ProjectController');
Route::resource('task','TaskController');



