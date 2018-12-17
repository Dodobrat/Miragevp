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

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Auth::routes();
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('auth/{service}', 'Auth\LoginController@redirectToProvider');
    Route::get('auth/{service}/callback', 'Auth\LoginController@handleProviderCallback');
    Route::view('/help', 'help');
});