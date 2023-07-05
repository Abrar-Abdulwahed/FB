<?php

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\HomeController;
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

Route::group([], function () {
    Route::get('/error', [ErrorController::class, 'error']);
    Route::get('/locked', [ErrorController::class, 'lock'])->name('locked');
});

Route::group([], __DIR__ . '/auth.php');
Route::group([], __DIR__ . '/admin.php');
Route::group([], __DIR__ . '/guest.php');
