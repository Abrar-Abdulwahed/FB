<?php
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\User\UserArticleController;
use App\Http\Controllers\User\UserTicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->group(function () {
    Route::resource('ticket', UserTicketController::class);
});
Route::resource('profile', SettingController::class);

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
