<?php

use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// api users endpoint
Route::prefix('users')->controller(UserController::class)->group(function(){
    Route::get('/retrieve', 'retrieve');

});


Route::prefix('pages')->controller(PageController::class)->group(function(){
    Route::get('/index', 'index');

});


