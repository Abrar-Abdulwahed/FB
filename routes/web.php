<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\Admin\CustomMessageController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;

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

Auth::routes();

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

Route::get('/logout', [LoginController::class, 'logout']);
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.index');
    Route::resource('custom-message', CustomMessageController::class)->except('show');
});

Route::resource('users',UserController::class);
