<?php

use App\Http\Controllers\CP\CategoryController;
use App\Http\Controllers\CP\GameCategoryController;
use App\Http\Controllers\CP\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/translations', function () {
    abort_if(!\auth()->id() || !\auth()->user()->isAdmin(), 404);
    return redirect(config('translation-manager.route.prefix'));
})->name('translations');

Route::group(['prefix' => 'cp', 'as' => 'cp.'], function () {
    Route::get('/', [\App\Http\Controllers\CP\HomeController::class, 'index'])->name('home');

    Route::controller(CategoryController::class)->prefix('categories')->as('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{parent?}/{child?}', 'form')->name('form');
        Route::post('/save/{category?}', 'save')->name('save');
        Route::post('/delete/{category}', 'delete')->name('delete');
    });

    Route::controller(GameController::class)->prefix('games')->as('games.')->group(function () {
       Route::get('/', 'index')->name('index');
       Route::get('/form/{game?}', 'form')->name('form');
       Route::post('/save', 'save')->name('save');
       Route::delete('/delete/{game}', 'delete')->name('delete');
       Route::post('/fetch-steam', 'fetchSteam')->name('fetch-steam');
    });

    Route::controller(GameCategoryController::class)->prefix('tree')->as('tree.')->group(function () {
        Route::get('/add/{game:slug}', 'add')->name('add');
        Route::get('/remove/{game:slug}', 'remove')->name('remove');
       Route::get('/{game:slug}', 'index')->name('index');
    });
});

