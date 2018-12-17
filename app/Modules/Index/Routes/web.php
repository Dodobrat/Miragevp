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
    Route::get('/', 'IndexController@index')->name('welcome');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/markUserNotificationsAsRead/{id}', 'HomeController@markUserNotificationsAsRead')->name('readUser');
    Route::get('/markAllNotificationsAsRead', 'HomeController@markAllNotificationsAsRead')->name('readAll');
    Route::post('update', 'HomeController@updateUser');
});