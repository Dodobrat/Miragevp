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

Route::group(['prefix' => 'apartments'], function () {
    Route::get('/', function () {
        dd('This is the Apartments module index page. Build something great!');
    });
});

if (\Administration::routeInAdministration()) {
    //administration menu code


    if (\Administration::isDashboard()) {

        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-lg-3 col-md-4 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setTitle(trans('apartments::admin.dash_apartments_linkbox_title'));
        $box->setValue(App\Modules\Apartments\Models\Apartments::count());
        $box->setBoxBackgroundClass('bg-orange');
        $box->setIconClass('fa fa-building-o');
        $box->setLink(trans('apartments::admin.dash_apartments_linkbox'), Administration::route('apartments.index'));
        \Dashboard::add($box);
    }
}