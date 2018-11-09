<?php

Route::group([
    'prefix' => LaravelLocalization::setLocale()
], function()
{
    Route::get('/apartment/{slug}', 'ApartmentsController@index')->name('apartment')->middleware('auth');
});

