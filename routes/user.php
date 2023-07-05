<?php

use App\Http\Controllers\User\Setting\SettingController;
use App\Http\Controllers\User\Support\UserTicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('support')->group(function () {
    Route::resource('ticket', UserTicketController::class);
});

Route::resource('profile', SettingController::class);
