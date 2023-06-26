<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProviderController;
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

Route::prefix('auth')->middleware('appLogin:facebook,google')->group(function () {
    Route::get('/{provider}/redirect', [ProviderController::class, 'redirect'])->name('app.login');
    Route::get('/{provider}/callback', [ProviderController::class, 'callback']);
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
