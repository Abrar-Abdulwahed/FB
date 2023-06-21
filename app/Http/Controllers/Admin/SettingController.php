<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;

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
            $filename = $request->file('site_logo')->getClientOriginalName();
            $path = $request->file('site_logo')->storeAs('public', $filename);
            $settings = [
                'site_name'        => $request->site_name,
                'site_description' => $request->site_description,
                'site_logo'        => $path
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
