<?php

use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CustomMessageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\LoginActivity;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShortLinkController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TicketCategoryController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'check_user'])->as('admin.')->group(function () {
    Route::resource('settings', SettingController::class)->only('index', 'store');
    Route::get('/', [AdminHomeController::class, 'index'])->name('index')->middleware('check_user');
    Route::resource('custom-message', CustomMessageController::class)->except('show');

    Route::get('users/verify/{id}', [UserController::class, 'verifyEmail'])->name('users.verifyEmail');
    Route::resource('users', UserController::class);

    Route::get('/login-activity', [LoginActivity::class, 'index'])->name('login.activity')->middleware('auth');
    Route::post('settings/resetdb', [App\Http\Controllers\Admin\SettingController::class, 'reset'])->name('settings.reset');

    Route::resource('articles', ArticleController::class)->middleware('feature:article');
    Route::resource('articles-categories', ArticleCategoryController::class);
    Route::resource('TicketsCategory', TicketCategoryController::class)->except(['show']);
    Route::resource('tickets', TicketsController::class);

    Route::resource('tags', TagController::class);

    Route::resource('pages', PageController::class)->except(['show'])->middleware('feature:page');

    Route::resource('roles', RoleController::class)->except('show');

    Route::resource('faqs', FaqController::class)->middleware('feature:faq');

    Route::resource('short_links', ShortLinkController::class);

    Route::patch('payments/{payment}/active', [PaymentController::class, 'changeActive'])
        ->name('payments.changeActive');

    Route::resource('payments', PaymentController::class);
    Route::resource('ads', AdController::class)->except('show');
});
