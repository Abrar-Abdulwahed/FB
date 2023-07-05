<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ShortLinkController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\SettingController as UserSettingController;
use App\Http\Controllers\User\UserArticleController;
use App\Http\Controllers\User\UserTicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('profile')->group(function () {
    
    Route::resource('ticket', UserTicketController::class);
});
Route::resource('profile', UserSettingController::class);

Route::group([], function () {
    Route::get('articles', [UserArticleController::class, 'index'])->name('articles.index');
    Route::get('articles/{slug}', [UserArticleController::class, 'show'])
        ->name('articles.show');
    Route::post('articles/comments', [UserArticleController::class, 'store'])
    ->name('articles.comments')->middleware('auth');

    Route::get('pages/{slug}', [PageController::class, 'show'])
        ->name('pages.show');

    Route::get('/s/{param}',[ShortLinkController::class,'show']) ->name('short_link.show');   

   /*  Route::get('admin/pages/{slug}', [PageController::class, 'show'])
        ->name('pages.show')->middleware('auth'); */
});

Route::group([], function () {
    Route::get('/error', [ErrorController::class, 'error']);
    Route::get('/locked', [ErrorController::class, 'lock'])->name('locked');
});

Route::group([], __DIR__ . '/auth.php');
Route::group([], __DIR__ . '/admin.php');
