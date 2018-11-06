<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale()
], function()
{
    Route::get('/floors', 'FloorsController@index')->name('floors')->middleware('auth');
    Route::get('/floor/{slug}', 'FloorsController@show')->name('floor')->middleware('auth');
});


