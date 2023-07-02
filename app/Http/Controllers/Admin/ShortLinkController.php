<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShortLink\ShortLinkValidation;
use App\Models\ShortLink;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $short_links = ShortLink::paginate(5);
        return view('short_links.index', compact('short_links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('short_links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShortLinkValidation $request)
    {
        //
        $check = ShortLink::query()->where('id',$request->slug)->first();
        if($check){
            return redirect()->back()->with('error', 'يجب الا يكون ال slug  وال id متساويان');
        }
        $short_link = ShortLink::create($request->validated());
        return redirect()->route('admin.short_links.index')->with('success', 'تم اضافة اللينك بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show($param)
    {
        //
        $short_link = ShortLink::query()->where('slug', $param)->orWhere('id', $param)->firstOrFail();

        return redirect()->to($short_link->url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $short_link = ShortLink::find($id);
        return view('short_links.edit', compact('short_link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShortLinkValidation $request, $id)
    {
        //
        $check = ShortLink::query()->where('id',$request->slug)->first();
        if($check){
            return redirect()->back()->with('error', 'يجب الا يكون ال slug  وال id متساويان');
        }
        ShortLink::find($id)->update($request->validated());
        return redirect()->route('admin.short_links.index')->with('success', 'تم تعديل اللينك بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        ShortLink::where('id', $id)->delete();
        return redirect()->back()->with(['success' => 'تم حذف اللينك بنجاح']);
    }
}
