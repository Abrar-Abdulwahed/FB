<?php

namespace App\Http\Controllers\Admin\Setting;

use Exception;
use App\Models\User;
use App\Models\Setting;
use App\Mail\TestMailable;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use App\Services\AppSettingService;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\SettingRequest;


class SettingController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = $this->cacheOrGet();
        return view('admin.settings.index', compact('settings'));
    }

    public function cacheOrGet(){
        $cachedSettings = Cache::rememberForever("settings", function () {
            return Setting::pluck('value', 'name')->toArray();
        });
        foreach ($cachedSettings as $key=>$value) {
            $settings[$key] = $value;
        }
        return $settings;
    }

    /**
     * Store the specified resource in storage.
     */
    public function store(SettingRequest $request)
    {
        $pathInDB = $this->settingService->get('site_logo');
        if ($request->hasFile('site_logo')) {
            if ($pathInDB !== null) {
                //Remove old image
                Storage::disk('public')->delete($pathInDB);
            }
            $path = $this->uploadImage($request->file('site_logo'), 'public');
        } else {
            $path = $pathInDB ?? '';
        }
        $settings = [
            'app.name' => $request?->app_name,
            'site_description' => $request?->site_description,
            'site_logo' => $path,
            'site_status' => $request?->site_status ?? false,
            'reason_locked' => $request?->site_status === 'active' ? null : $request?->reason_locked,
            'google_enable' => $request?->google_enable ?? false,
            'services.google.client_id' => $request?->google_client_id,
            'services.google.client_secret' => $request?->google_client_secret,
            'facebook_enable' => $request?->facebook_enable ?? false,
            'services.facebook.client_id' => $request?->facebook_client_id,
            'services.facebook.client_secret' => $request?->facebook_client_secret,
            'captcha_enable' => $request?->captcha_enable,
            'recaptcha.api_site_key' => $request?->recaptcha_site_key,
            'recaptcha.api_secret_key' => $request?->recaptcha_secret_key,
            'mail.default' => $request?->mail_mailer, //mail_mailer
            'mail.mailers.smtp.host' => $request?->mail_host,
            'mail.mailers.smtp.port' => $request?->mail_port,
            'mail.mailers.smtp.username' => $request?->mail_username,
            'mail.mailers.smtp.password' => $request?->mail_password === "****"? $this->settingService->get('mail.mailers.smtp.password'):$request?->mail_password,
            'mail.from.address' => $request?->mail_from_address,
            'mail.from.name' => $request?->mail_from_name,
            'header_script' => $request->header_script ,
            'footer_script' => $request->footer_script,
            'faq_enable' => $request->faq_enable ? "on" : "off",
            'article_enable' => $request->article_enable ? "on" : "off",
            'page_enable' => $request->page_enable ? "on" : "off",
            'register_enable' => $request->register_enable ? "on" : "off",
            'email_confirm_enable' => $request?->email_confirm_enable,
            'comment_enable' => $request->comment_enable ?? "off",
            'short_link_enable' => $request?->short_link_enable,
            'telegram_report_enable' => $request?->telegram_report_enable,
            'logging.channels.telegram.chat_id' => $request?->telegram_chat_id,
            'logging.channels.telegram.token' => $request?->telegram_token,
            'slack_report_enable' => $request?->slack_report_enable,
            'logging.channels.slack.url' => $request?->slack_url,
        ];
        foreach ($settings as $name => $value) {
            Setting::updateOrCreate(['name' => $name], ['value' => $value]);
        }
        Cache::forever("settings", $settings);
        return redirect()->back()->with('success', 'تم تعديل الإعدادات بنجاح');
    }

    public function cleanup(Request $request)
    {
        $request->validate([
            'resetdb_password' => 'sometimes|current_password',
            'load_password' => 'sometimes|current_password'
        ]);
        $action = $request->query('action');
        switch ($action) {
            case 'reset-db':
                $this->resetDatabase();
                $msg = 'تم تهيئة البيانات بنجاح';
                break;
            case 'load-settings':
                $this->loadSettings();
                $msg = 'تم تحميل الإعدادات بنجاح';
                break;
            case 'clear-session-cookie':
                $this->clearSessionCookie();
                $msg = 'تم حذف الجلسات وبيانات تعريف الارتباط';
                break;
            case 'clear-cache':
                $this->clearCache();
                $msg = 'تم حذف الملفات المؤقتة بنجاح';
                break;
            default:
                abort(404);
        }
        return redirect()->route('admin.settings.index')->with('success', $msg);
    }

    protected function resetDatabase()
    {
        Cache::forget("settings");
        Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
        $this->loadSettings();
    }

    protected function loadSettings(){
        if(File::exists(base_path('config.php'))){
            $settings = include(base_path('config.php'));
            $this->clearCache();
            foreach($settings as $key => $value){
                if($value !== null){
                    if(($key == 'admin_email')){
                        User::findOrFail(1)->update([
                            'email' => $value,
                        ]);
                    }
                    elseif($key == 'admin_password'){
                        User::findOrFail(1)->update([
                            'password' => Hash::make($value),
                        ]);
                    }
                    else
                        Setting::updateOrCreate(['name' => $key], ['value' => $value]);
                }
            }
            Cache::forever("settings", Setting::pluck('value', 'name')->toArray());
        }else{
            return redirect()->route('admin.settings.index')->withError('error', 'ملف الإعدادات غير موجود');
        }
    }

    protected function clearSessionCookie(){
        Session::flush();
        // remove all session files manually
        $directory = storage_path('framework/sessions');

        foreach(array_diff(scandir($directory), array('..', '.')) as $file) {
            if($file !== ".gitignore") {
                File::delete($directory . '/' . $file);
            }
        }
        foreach ($_COOKIE as $key => $value) {
            Cookie::forget($key);
        }
    }

    protected function clearCache(){
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('event:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Cache::flush();
        // remove all cache files manually
        $directory = storage_path('framework/cache/data');
        foreach(array_diff(scandir($directory), array('..', '.')) as $file) {
            if($file !== ".gitignore" && File::isDirectory($directory)) {
                File::deleteDirectory($directory . '/' . $file);
            }
        }
    }

    public function test(Request $request){
        $action = $request->query('action');
        switch ($action) {
            case 'email':
                Mail::to($request->test_email)->send(new TestMailable(auth()->user(), 'Test Mail'));
                break;
            case 'report':
                $request->session()->flash('success', $request->input('message'));
                 throw new Exception('This is a custom exception message');
                 break;
            default:
                abort(404);
        }
        return redirect()->back()->with('success', 'تم الاختبار بنجاح');
    }

    public function prepare_production(){
        $this->clearCache();
        Artisan::call('config:cache');
        Artisan::call('event:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');
        return redirect()->route('admin.settings.index')->with('success', 'تم تجهيز الموقع للإطلاق بنجاح');
    }
}
