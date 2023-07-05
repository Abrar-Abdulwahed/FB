<?php


use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LoginActivity;
use App\Http\Controllers\Admin\Blog\TagController;
use App\Http\Controllers\Admin\Blog\ArticleComment;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Blog\ArticleController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\ShortLinkController;
use App\Http\Controllers\Admin\EmailHistoryController;
use App\Http\Controllers\Admin\CustomMessageController;
use App\Http\Controllers\Admin\TicketCategoryController;
use App\Http\Controllers\Admin\Blog\ArticleCategoryController;
use App\Http\Controllers\Admin\DeletedArticleCommentController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;

Route::prefix('admin')->middleware(['auth', 'check_user'])->as('admin.')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('index')->middleware('check_user');

    //Settings routes
	Route::prefix('settings')->name('settings.')->group(function () {
        Route::resource('/', SettingController::class)->only('index', 'store');
        Route::delete('cleanup', [SettingController::class, 'cleanup'])->name('cleanup');
    });

    Route::resource('custom-message', CustomMessageController::class)->except('show');
    Route::patch('custom-message/{msg}/active', [CustomMessageController::class, 'changeActive'])
        ->name('custom-message.changeActive');

    Route::get('users/verify/{id}', [UserController::class, 'verifyEmail'])->name('users.verifyEmail');
    Route::get('users/{user}/activities', [UserController::class, 'activities'])->name('users.activities');
    Route::resource('users', UserController::class);
    Route::get('users/{user_id}/email-history', [UserController::class, 'email_history'])->name('user.email_history');
    Route::get('users/{user_id}/email-history/{email_id}', [UserController::class, 'email_show'])->name('user.email_show');


    Route::get('/login-activity', [LoginActivity::class, 'index'])->name('login.activity')->middleware('auth');

    Route::resource('blogs', ArticleController::class)->middleware('feature:article');
    Route::resource('comments', ArticleComment::class);
    Route::get('/deleted_comments', [ArticleComment::class, 'deletedComments'])->name('deletedComments');
    Route::post('/restore_comments/{id}', [ArticleComment::class, 'restoreComments'])->name('restoreComments');

    Route::resource('blogs-categories', ArticleCategoryController::class);
    Route::get('blogs/categories/{slug}', [ArticleController::class, 'category'])->name('blogs.category');
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
