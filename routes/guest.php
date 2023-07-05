<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\User\UserTicketController;
use App\Http\Controllers\User\UserArticleController;

Route::prefix('profile')->group(function () {
    Route::resource('ticket', UserTicketController::class);
});
Route::resource('profile', SettingController::class);

Route::group([], function () {
    Route::get('articles', [UserArticleController::class, 'index'])->name('articles.index');
    Route::get('articles/{slug}', [UserArticleController::class, 'show'])
        ->name('articles.show');

    Route::get('pages/{slug}', [PageController::class, 'show'])
        ->name('pages.show');

    Route::get('/s/{param}',[ShortLinkController::class,'show']) ->name('short_link.show');   

   /*  Route::get('admin/pages/{slug}', [PageController::class, 'show'])
        ->name('pages.show')->middleware('auth'); */
});