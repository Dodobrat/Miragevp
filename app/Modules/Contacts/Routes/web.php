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


Route::group(['prefix' => 'contacts'], function () {
    Route::get('/', function () {
        dd('This is the Contacts module index page. Build something great!');
    });
});
//ei sa idvam

//em shoto ddz mislq che sam si gi pochnesh se taq ostavqm go
