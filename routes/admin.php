<?php


use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LoginActivity;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ArticleComment;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\ShortLinkController;
use App\Http\Controllers\Admin\EmailHistoryController;
use App\Http\Controllers\Admin\CustomMessageController;
use App\Http\Controllers\Admin\TicketCategoryController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\DeletedArticleCommentController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;

Route::prefix('admin')->middleware(['auth', 'check_user'])->as('admin.')->group(function () {
    Route::resource('settings', SettingController::class)->only('index', 'store');
    Route::get('/', [AdminHomeController::class, 'index'])->name('index')->middleware('check_user');
    Route::resource('custom-message', CustomMessageController::class)->except('show');
    Route::patch('custom-message/{msg}/active', [CustomMessageController::class, 'changeActive'])
        ->name('custom-message.changeActive');

    Route::get('users/verify/{id}', [UserController::class, 'verifyEmail'])->name('users.verifyEmail');
    Route::resource('users', UserController::class);
    Route::get('users/{user_id}/email-history', [UserController::class, 'email_history'])->name('user.email_history');
    Route::get('users/{user_id}/email-history/{email_id}', [UserController::class, 'email_show'])->name('user.email_show');


    Route::get('/login-activity', [LoginActivity::class, 'index'])->name('login.activity')->middleware('auth');
    Route::post('settings/resetdb', [App\Http\Controllers\Admin\SettingController::class, 'reset'])->name('settings.reset');

    Route::resource('articles', ArticleController::class)->middleware('feature:article');
    Route::resource('comments', ArticleComment::class);
    Route::get('/deleted_comments', [ArticleComment::class, 'deletedComments'])->name('deletedComments');
    Route::post('/restore_comments/{id}', [ArticleComment::class, 'restoreComments'])->name('restoreComments');

    Route::resource('articles-categories', ArticleCategoryController::class);
    Route::get('articles/categories/{slug}', [ArticleController::class, 'category'])->name('articles.category');
    Route::resource('TicketsCategory', TicketCategoryController::class)->except(['show']);
    Route::resource('tickets', TicketsController::class);

    Route::resource('tags', TagController::class);

    Route::resource('pages', PageController::class)->except(['show'])->middleware('feature:page');

    Route::resource('roles', RoleController::class)->except('show');

    Route::resource('faqs', FaqController::class)->middleware('feature:faq');

    //short links
    Route::middleware('feature:short_link')->group(function () {
        Route::resource('short_links', ShortLinkController::class)->except('show');
        Route::get('short_links/{id}/statistics', [ShortLinkController::class, 'statistics'])->name('short_links.statistics');
    });

    Route::patch('payments/{payment}/active', [PaymentController::class, 'changeActive'])
        ->name('payments.changeActive');

    Route::resource('payments', PaymentController::class);
    Route::resource('ads', AdController::class)->except('show');

    // Route::resource('email/history', EmailHistoryController::class)->only('index', 'show', 'destroy');
    Route::get('uploads/{id}/download', [FileUploadController::class, 'download'])->name('uploads.download');
    Route::resource('uploads', FileUploadController::class)->except('show', 'edit', 'update');
});
