<?php

use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\User\UserTicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->group(function () {
    Route::resource('ticket', UserTicketController::class);
});

Route::resource('profile', SettingController::class);
