<?php

use App\Models\Setting;
use App\Services\AppSettingService;
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

//  $settings = Setting::settings();
 //dd($settings);
 
$middlewares = [];

if(app(AppSettingService::class)->get('email_confirm_enable') == 'on'){
   $middlewares[] = 'verified';
}



Route::group([], __DIR__ . '/guest.php');
Route::group(['middleware' => $middlewares], __DIR__ . '/user.php');
Route::group([], __DIR__ . '/auth.php');
Route::group([], __DIR__ . '/admin.php');

