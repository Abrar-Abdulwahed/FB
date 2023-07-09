<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Guest\CMS\Blog\ArticleController;
use App\Http\Controllers\Guest\CMS\FAQ\FaqController;
use App\Http\Controllers\Guest\CMS\Page\PageController;
use App\Http\Controllers\Guest\ErrorController;
use App\Http\Controllers\Guest\ShortLink\ShortLinkController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['as' => 'guest.'], function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group([], function () {
        Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('articles/{slug}', [ArticleController::class, 'show'])
            ->name('articles.show');
        Route::post('articles/comments', [ArticleController::class, 'store'])
            ->name('articles.comments')->middleware('auth');

        Route::get('support/faq', [FaqController::class, 'index'])
            ->name('support.faq.index');
    });

    Route::group([], function () {
        Route::get('/error', [ErrorController::class, 'error']);
        Route::get('/locked', [ErrorController::class, 'lock'])->name('locked');
    });

    Route::get('pages/{slug}', [PageController::class, 'show'])
        ->name('pages.show');

    Route::get('/s/{param}', [ShortLinkController::class, 'show'])->name('short_link.show');

});
