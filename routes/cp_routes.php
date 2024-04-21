<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/translations', function () {
    abort_if(!\auth()->id() || !\auth()->user()->isAdmin(), 404);
    return redirect(config('translation-manager.route.prefix'));
})->name('translations');

$localizationConfig = [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
];

Route::group($localizationConfig, function() {
    Route::group(['prefix' => 'cp', 'as' => 'cp.'], function () {
        Route::get('/', [\App\Http\Controllers\CP\HomeController::class, 'index'])->name('home');
    });
});

