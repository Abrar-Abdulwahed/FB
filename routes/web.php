<?php

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

/* $middlewares = [];
if($emailVerificationRequired){
   $middlewares[] = 'verified';
} */

Route::group([], __DIR__ . '/guest.php');
Route::group([], __DIR__ . '/user.php');
Route::group([], __DIR__ . '/auth.php');
Route::group([], __DIR__ . '/admin.php');

Route::get('/exception', function () {
    throw new Exception('Test Exception');
});
