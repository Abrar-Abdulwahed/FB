<?php

use App\Http\Controllers\Admin\User\FaqController;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\User\UserTicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('support')->group(function () {
    Route::resource('ticket', UserTicketController::class);
    Route::get('faq', [FaqController::class, 'index'])
        ->name('support.faq.index');
});

Route::resource('profile', SettingController::class);
