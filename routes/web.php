<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function() {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::view('template', 'template');
    Auth::routes(['register' => false, 'verify' => false, 'reset' => false]);
});
