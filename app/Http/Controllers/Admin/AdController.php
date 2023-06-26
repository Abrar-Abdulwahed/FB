<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::latest()->paginate(10);
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'message' => 'required',
            'type' => 'required|in:email,sms,notification,all',
            'start_date' => 'nullable|date_format:Y-m-d',
            'end_date' => 'required_with:start_date|date_format:Y-m-d|after_or_equal:start_date',
            'country' => 'nullable',
            'gender' => 'nullable|in:male,female',
            'min_age' => 'nullable',
            'max_age' => 'nullable',
        ]);
        Ad::create($data);
        return redirect()->route('admin.ads.index')->with('success', 'تم اصافة الاعلان بنجاح');
    }
    public function edit(Ad $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }
    public function update(Request $request, Ad $ad)
    {
        $data = $request->validate([
            'name' => 'required',
            'message' => 'required',
            'type' => 'required|in:email,sms,notification,all',
            'start_date' => 'nullable|date_format:Y-m-d',
            'end_date' => 'required_with:start_date|date_format:Y-m-d|after_or_equal:start_date',
            'country' => 'nullable',
            'gender' => 'nullable|in:male,female',
            'min_age' => 'nullable',
            'max_age' => 'nullable',
        ]);
        $ad->update($data);
        return redirect()->route('admin.ads.index')->with(['success' => 'تم تحديث بيانات الاعلان بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->back()->with(['success' => 'تم حذف الاعلان بنجاح']);
    }
}
