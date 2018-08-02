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

Route::group(['prefix' => 'blog'], function () {
    Route::get('/', function () {
        dd('This is the Blog module index page. Build something great!');
    });
});

if (\Administration::routeInAdministration()) {
    //administration menu code


    if (\Administration::isDashboard()) {

        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-md-3'); //set boostrap column class
        $box->setTitle(trans('blog::admin.dash_blog_linkbox_title'));
        $box->setValue(App\Modules\Blog\Models\Blog::count());
        $box->setBoxBackgroundClass('bg-yellow');
        $box->setIconClass('fa-newspaper-o');
        $box->setLink(trans('blog::admin.dash_blog_linkbox'), Administration::route('blog.index'));
        \Dashboard::add($box);
    }
}