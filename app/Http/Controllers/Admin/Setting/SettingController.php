<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $settings = $this->cache();
        return view('admin.settings.index', compact('settings'));
    }

    public function cache()
    {
        $keys = Setting::pluck('name')->all();
        foreach ($keys as $key) {
            $value = Cache::rememberForever("settings.{$key}", function () use ($key) {
                return Setting::where('name', $key)->value('value');
            });
            $settings[$key] = $value;
        }
        return $settings;
    }

    /**
     * Store the specified resource in storage.
     */
    public function store(SettingRequest $request)
    {
        DB::beginTransaction();
        try {
            $pathInDB = Setting::where('name', 'site_logo')->first()->value;
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
                'mail.mailers.smtp.password' => $request?->mail_password,
                'mail.from.address' => $request?->mail_from_address,
                'mail.from.name' => $request?->mail_from_name,
                'header_script' => $request->header_script,
                'footer_script' => $request->footer_script,
                'faq_enable' => $request->faq_enable ? "on" : "off",
                'article_enable' => $request->article_enable ? "on" : "off",
                'page_enable' => $request->page_enable ? "on" : "off",
                'register_enable' => $request->register_enable ? "on" : "off",
                'email_confirm_enable' => $request?->email_confirm_enable,
                'comment_enable' => $request->comment_enable,
                'short_link_enable' => $request?->short_link_enable,
                'telegram_report_enable' => $request?->telegram_report_enable,
                'logging.channels.telegram.chat_id' => $request?->telegram_chat_id,
                'logging.channels.telegram.token' => $request?->telegram_token,
                'slack_report_enable' => $request?->slack_report_enable,
                'logging.channels.slack.url' => $request?->slack_url,
            ];
            foreach ($settings as $name => $value) {
                Setting::updateOrCreate(['name' => $name], ['value' => $value]);
                Cache::forever("settings.{$name}", $value);
            }
            DB::commit();
            return redirect()->back()->with('success', 'تم تعديل الإعدادات بنجاح');
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withError('error', 'فشل في تعديل الإعدادات');
        }
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
        ]);
        try {
            foreach (Setting::pluck('name')->all() as $name) {
                Cache::forget("settings.{$name}");
            }
            Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
            // $this->cache();
            return redirect()->route('admin.index');
        } catch (\Throwable $e) {
            return redirect()->back()->withError('error', 'فشل في تهيئية قاعدة البيانات');
        }
    }
}