<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CustomMessageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
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
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Signup/Login using providers
Route::prefix('auth')->group(function () {
    Route::get('/{provider}/redirect', [ProviderController::class, 'redirect']);
    Route::get('/{provider}/callback', [ProviderController::class, 'callback']);
});
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::prefix('admin')->middleware(['auth' , 'check_user'])->group(function () {
    Route::resource('settings', SettingController::class)->only('index', 'store');
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.index')->middleware('check_user');
    Route::resource('custom-message', CustomMessageController::class)->except('show');
    Route::resource('users', UserController::class);

    // roles routes
    Route::resource('roles', RoleController::class)->except('show');

    // articles routes
    Route::resource('articles', ArticleController::class)->except('show');
    
    // Tags
    Route::resource('tags',TagController::class);

     // Tags
     Route::resource('faqs',FaqController::class);

});

/* Route::prefix('user')->group(function(){
    Route::get('/settings',[UserSettingController::class,'index'])->name('settings.index');
    Route::get('/settings',[UserSettingController::class,'index'])->name('settings.index');
}); */

Route::prefix('user')->group(function(){
    Route::resource('settings',UserSettingController::class);
});

Route::get('testmail', function () {
    // $name = "Khorasani Abrar";
    // Mail::to('mailtrap.club@gmail.com')->send(new CustomMessageMail($name));
});
Route::get('/error', [ErrorController::class, 'error']);
