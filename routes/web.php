<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CustomMessageController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\HomeController;
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

// Route::middleware([LockSite::class])->group(function () {
Route::get('/', function () {
    return view('welcome');
})->name('home');
// });
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Signup/Login using providers
Route::prefix('auth')->group(function () {
    Route::get('/{provider}/redirect', [ProviderController::class, 'redirect']);
    Route::get('/{provider}/callback', [ProviderController::class, 'callback']);
});
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::prefix('admin')->middleware(['auth', 'check_user'])->as('admin.')->group(function () {
    Route::resource('settings', SettingController::class)->only('index', 'store');
    Route::get('/', [AdminHomeController::class, 'index'])->name('index')->middleware('check_user');
    Route::resource('custom-message', CustomMessageController::class)->except('show');
    Route::resource('users', UserController::class);

    // articles routes
    Route::resource('articles', ArticleController::class)->except(['show']);

    Route::resource('tags', TagController::class);
    // pages routes
    Route::resource('pages', PageController::class)->except(['show']);
    // roles routes
    Route::resource('roles', RoleController::class)->except('show');
});

Route::get('testmail', function () {
    // $name = "Khorasani Abrar";
    // Mail::to('mailtrap.club@gmail.com')->send(new CustomMessageMail($name));
});

// articles routes for visitors
// Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');

Route::get('admin/articles/{slug}', [ArticleController::class, 'show'])
    ->name('articles.show')->middleware('auth');

Route::get('admin/pages/{slug}', [PageController::class, 'show'])
    ->name('pages.show')->middleware('auth');

Route::get('/error', [ErrorController::class, 'error']);
Route::get('/locked', [ErrorController::class, 'lock'])->name('locked');
