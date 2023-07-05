<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ShortLinkController;
use App\Http\Controllers\User\UserArticleController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('articles', [UserArticleController::class, 'index'])->name('articles.index');
    Route::get('articles/{slug}', [UserArticleController::class, 'show'])
        ->name('articles.show');

    Route::post('articles/comments', [UserArticleController::class, 'store'])->name('articles.comments')->middleware('auth');

    Route::get('pages/{slug}', [PageController::class, 'show'])
        ->name('pages.show');

    Route::get('/s/{param}', [ShortLinkController::class, 'show'])->name('short_link.show');

    /*  Route::get('admin/pages/{slug}', [PageController::class, 'show'])
->name('pages.show')->middleware('auth'); */
});
