<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function() {

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes(['register' => false, 'verify' => false, 'reset' => false]);
});
