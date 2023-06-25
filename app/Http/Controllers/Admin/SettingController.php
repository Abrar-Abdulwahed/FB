<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use ImageTrait;
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        foreach (Setting::all() as $setting) {
            $settings[$setting->name] = $setting->value;
        }
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Store the specified resource in storage.
     */
    public function store(SettingRequest $request)
    {
        DB::beginTransaction();
        try{
            $pathInDB = Setting::where('name', 'site_logo')->first()->value;
            if($request->hasFile('site_logo')){
                if($pathInDB !== null){
                    //Remove old image
                    Storage::disk('public')->delete($pathInDB);
                }
                $path = $this->uploadImage($request->file('site_logo'), 'public');
            }else{
                $path = $pathInDB ?? '';
            }
            $settings = [
                'app.name'                          => $request?->app_name,
                'site_description'                  => $request?->site_description,
                'site_logo'                         => $path,
                'site_status'                       => $request?->site_status ?? false,
                'reason_locked'                     => $request?->site_status === 'active' ? '' : $request?->reason_locked,
                'services.google.client_id'         => $request?->google_client_id,
                'services.google.client_secret'     => $request?->google_client_secret,
                'services.google.client_redirect'   => $request?->google_client_redirect,
                'services.facebook.client_id'       => $request?->facebook_client_id,
                'services.facebook.client_secret'   => $request?->facebook_client_secret,
                'services.facebook.client_redirect' => $request?->facebook_client_redirect,
                'recaptcha.api_site_key'            => $request?->recaptcha_site_key,
                'recaptcha.api_secret_key'          => $request?->recaptcha_secret_key,
                'mail.default'                      => $request?->mail_mailer, //mail_mailer
                'mail.mailers.smtp.host'            => $request?->mail_host,
                'mail.mailers.smtp.port'            => $request?->mail_port,
                'mail.mailers.smtp.username'        => $request?->mail_username,
                'mail.mailers.smtp.password'        => $request?->mail_password,
                'mail.from.address'                 => $request?->mail_from_address,
                'mail.from.name'                    => $request?->mail_from_name,
                'faq_status'                        => $request->faq_status ? "on" : "off",
                'article_status'                    => $request->article_status ? "on" : "off",
                'blog_status'                       => $request->blog_status ? "on" : "off",
            ];
            foreach ($settings as $name => $value) {
                Setting::updateOrCreate(['name' => $name], ['value' => $value]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'تم تعديل الإعدادات بنجاح');
        }catch(\Throwable $e){
            DB::rollback();
            dd($e);
            return redirect()->back()->withError('error', 'فشل في تعديل الإعدادات');
        }
    }
}
