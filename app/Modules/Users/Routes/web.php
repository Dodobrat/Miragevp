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

Route::group(['prefix' => 'users'], function () {
    Route::get('/', function () {
        dd('This is the Users module index page. Build something great!');
    });
});

if (\Administration::routeInAdministration()) {
    //administration menu code


    if (\Administration::isDashboard()) {
        //insert box code here
//        $box = new \ProVision\Administration\Dashboard\HtmlBox();
//        $box->setBoxClass('col-md-12'); //set boostrap column class
//        $box->setHtml('<div class="bg-info">
//                                <br>
//                                <h1 class="display-1 text-center">'.trans('users::admin.dash_title').'</h1>
//                                <p class="lead text-center">'.trans('users::admin.dash_desc').'</p>
//                                <br>
//                            </div>
//                            <br>');
//        \Dashboard::add($box);


        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-lg-3 col-md-4 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setTitle(trans('users::admin.dash_users_linkbox_title'));
        $box->setValue(\App\User::whereDoesntHave('roles')->count());
        $box->setBoxBackgroundClass('bg-aqua');
        $box->setIconClass('fa-users');
        $box->setLink(trans('users::admin.dash_users_linkbox'), Administration::route('users.index'));
        \Dashboard::add($box);
    }
}


