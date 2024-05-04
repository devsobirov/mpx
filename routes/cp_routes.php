<?php

use App\Http\Controllers\CP\CategoryController;
use App\Http\Controllers\CP\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/translations', function () {
    abort_if(!\auth()->id() || !\auth()->user()->isAdmin(), 404);
    return redirect(config('translation-manager.route.prefix'));
})->name('translations');

Route::group(['prefix' => 'cp', 'as' => 'cp.'], function () {
    Route::get('/', [\App\Http\Controllers\CP\HomeController::class, 'index'])->name('home');

    Route::controller(CategoryController::class)->prefix('categories')->as('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(ProductController::class)->prefix('products')->as('products.')->group(function () {
       Route::get('/', 'index')->name('index');
       Route::get('/create', 'create')->name('create');
       Route::get('/edit/{product}', 'edit')->name('edit');
    });
});

