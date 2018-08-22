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

Route::group(['prefix' => 'floors'], function () {
    Route::get('/', function () {
        dd('This is the Floors module index page. Build something great!');
    });
});

if (\Administration::routeInAdministration()) {
    //administration menu code


    if (\Administration::isDashboard()) {

        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-lg-3 col-md-4 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setTitle(trans('floors::admin.dash_floors_linkbox_title'));
        $box->setValue(App\Modules\Floors\Models\Floors::count());
        $box->setBoxBackgroundClass('bg-green');
        $box->setIconClass('fa fa-building');
        $box->setLink(trans('floors::admin.dash_floors_linkbox'), Administration::route('floors.index'));
        \Dashboard::add($box);
    }
}
