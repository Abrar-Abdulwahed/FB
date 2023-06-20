<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CustomMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCustomMessageRequest;

class CustomMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages =  CustomMessage::paginate(5);
        return view('admin.custom_message.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.custom_message.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCustomMessageRequest $request)
    {
        try{
            $message = CustomMessage::create($request->validated());
            return redirect()->back()->with('success', 'تم إضافة الرسالة بنجاح');
        }catch(\Throwable $e){
            return redirect()->back()->with('error', 'فشل في إضافة الرسالة');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $message = CustomMessage::find($id);
            return view('admin.custom_message.edit', compact('message'));
        }catch(\Throwable $e){
            return redirect()->back()->with('error', 'فشل في تحرير الرسالة');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCustomMessageRequest $request, int $id)
    {
        try{
            CustomMessage::find($id)->update($request->validated());
            return redirect()->back()->with('success', 'تم تعديل الرسالة بنجاح');
        }catch(\Throwable $e){
            return redirect()->back()->with('error', 'فشل في تعديل الرسالة');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try{
            CustomMessage::find($id)->delete();
            return redirect()->back()->with('success', 'تم حذف الرسالة بنجاح');
        }catch(\Throwable $e){
            return redirect()->back()->with('error', 'فشل في حذف الرسالة');
        }
    }
}
