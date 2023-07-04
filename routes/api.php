<?php

use App\Http\Controllers\api\TagController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// api users endpoint

Route::get('/users',[UserController::class ,'index']);

Route::get('/pages',[PageController::class ,'index']);

Route::get('/tags',[TagController::class ,'index']);




