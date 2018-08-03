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


if (\Administration::routeInAdministration()) {
    //administration menu code


    if (\Administration::isDashboard()) {

        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-lg-3 col-md-4 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setTitle(trans('contacts::contacts.dash_contacts_linkbox_title'));
        $box->setValue(App\Modules\Contacts\Models\Contacts::count());
        $box->setBoxBackgroundClass('bg-purple');
        $box->setIconClass('fa-envelope');
        $box->setLink(trans('contacts::contacts.dash_contacts_linkbox'), Administration::route('contacts.index'));
        \Dashboard::add($box);
    }
}
