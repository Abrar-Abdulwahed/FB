<?php

use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CustomMessageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShortLinkController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\SettingController as UserSettingController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Signup/Login using providers
Route::prefix('auth')->group(function () {
    Route::get('/{provider}/redirect', [ProviderController::class, 'redirect'])->name('app.login');
    Route::get('/{provider}/callback', [ProviderController::class, 'callback']);
});
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::prefix('admin')->middleware(['auth', 'check_user'])->as('admin.')->group(function () {
    Route::resource('settings', SettingController::class)->only('index', 'store');
    Route::get('/', [AdminHomeController::class, 'index'])->name('index')->middleware('check_user');
    Route::resource('custom-message', CustomMessageController::class)->except('show');

    Route::get('users/verify/{id}', [UserController::class, 'verifyEmail'])->name('users.verifyEmail');
    Route::resource('users', UserController::class);

    //reset db
    Route::post('settings/resetdb', [App\Http\Controllers\Admin\SettingController::class, 'reset'])->name('settings.reset');

    // articles routes
    Route::resource('articles', ArticleController::class)->middleware('feature:article');

    Route::resource('tags', TagController::class);

    // pages routes
    Route::resource('pages', PageController::class)->except(['show'])->middleware('feature:page');

    // roles routes
    Route::resource('roles', RoleController::class)->except('show');

    // Tags
    Route::resource('faqs', FaqController::class)->middleware('feature:faq');

    //short links
    Route::resource('short_links', ShortLinkController::class);

    // payments
    Route::resource('payments', PaymentController::class);
    //ads routes
    Route::resource('ads', AdController::class)->except('show');

});

/* Route::prefix('user')->group(function(){
Route::get('/settings',[UserSettingController::class,'index'])->name('settings.index');
Route::get('/settings',[UserSettingController::class,'index'])->name('settings.index');
}); */

Route::prefix('profile')->group(function () {
    Route::resource('settings', UserSettingController::class);
});

// articles routes for visitors
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

// pages routes for visitors
// Route::get('pages', [PageController::class, 'index'])->name('pages.index');
Route::get('pages/{slug}', [PageController::class, 'show'])
    ->name('pages.show');

Route::get('admin/pages/{slug}', [PageController::class, 'show'])
    ->name('pages.show')->middleware('auth');

Route::get('/error', [ErrorController::class, 'error']);
Route::get('/locked', [ErrorController::class, 'lock'])->name('locked');
