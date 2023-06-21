<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = [];
        foreach (Setting::all() as $setting) {
            $settings[$setting->name] = $setting->value;
        }
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(SettingRequest $request)
    {
        DB::beginTransaction();
        try{
            $pathInDB = Setting::where('name', 'site_logo')->first()->value;
            if($request->hasFile('site_logo')){
                if($pathInDB !== ''){
                    //Remove old image
                    Storage::disk('public')->delete($pathInDB);
                }
                $filename = $request->file('site_logo')->getClientOriginalName();
                $path = $request->file('site_logo')->storeAs('', $filename, 'public');
            }else{
                $path = $pathInDB ?? '';
            }
            $settings = [
                'site_name'        => $request?->site_name,
                'site_description' => $request?->site_description,
                'site_logo'        => $path,
                'google_client_id'     => $request?->google_client_id,
                'google_client_secret' => $request?->google_client_secret,
                'fb_client_id'     => $request?->fb_client_id,
                'fb_client_secret' => $request?->fb_client_secret,
            ];
            foreach ($settings as $name => $value) {
                Setting::updateOrCreate(['name' => $name], ['value' => $value]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'تم تعديل الإعدادات بنجاح');
        }catch(\Throwable $e){
            DB::rollback();
            dd($e);
            return redirect()->back()->withError('error', 'فشل في تعديل الرسالة');
        }
    }
}
