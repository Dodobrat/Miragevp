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
        $box = new \ProVision\Administration\Dashboard\HtmlBox();
        $box->setBoxClass('col-md-12'); //set boostrap column class
        $box->setHtml('<div class="bg-info"><br>
                                <h1 class="display-1 text-center">Welcome to MVP Dashboard</h1>
                                <p class="lead text-center">Here you can manage your website with a click of a button!</p><br>
                            </div><br>');
        \Dashboard::add($box);


        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setTitle('Users');
        $box->setValue(\App\User::whereDoesntHave('roles')->count());
        $box->setBoxBackgroundClass('bg-aqua');
        $box->setIconClass('fa-users');
        $box->setLink('View Users', Administration::route('users.index'));
        \Dashboard::add($box);

    }
}


