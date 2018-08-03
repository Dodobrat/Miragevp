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

Route::group(['prefix' => 'projects'], function () {
    Route::get('/', function () {
        dd('This is the Projects module index page. Build something great!');
    });
});

if (\Administration::routeInAdministration()) {
    //administration menu code


    if (\Administration::isDashboard()) {

        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-lg-3 col-md-4 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setTitle(trans('projects::admin.dash_projects_linkbox_title'));
        $box->setValue(App\Modules\Projects\Models\Projects::count());
        $box->setBoxBackgroundClass('bg-blue');
        $box->setIconClass('fa-file-o');
        $box->setLink(trans('projects::admin.dash_projects_linkbox'), Administration::route('projects.index'));
        \Dashboard::add($box);
    }
}
