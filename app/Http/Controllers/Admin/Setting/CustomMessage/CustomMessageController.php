<?php

namespace App\Http\Controllers\Admin\Setting\CustomMessage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomMessage\StoreCustomMessageRequest;
use App\Http\Requests\Admin\CustomMessage\UpdateCustomMessageRequest;
use App\Models\CustomMessage;

class CustomMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = CustomMessage::paginate(5);
        return view('admin.settings.custom_message.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.custom_message.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomMessageRequest $request)
    {
        try {
            $message = CustomMessage::create($request->validated());
            return redirect()->route('admin.custom-message.index')->with('success', 'تم إضافة الرسالة بنجاح');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'فشل في إضافة الرسالة');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        try {
            $message = CustomMessage::find($id);
            return view('admin.settings.custom_message.edit', compact('message'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'فشل في تحرير الرسالة');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomMessageRequest $request, int $id)
    {
        try {
            CustomMessage::find($id)->update($request->validated());
            return redirect()->route('admin.custom-message.index')->with('success', 'تم تعديل الرسالة بنجاح');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'فشل في تعديل الرسالة');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            CustomMessage::find($id)->delete();
            return redirect()->back()->with('success', 'تم حذف الرسالة بنجاح');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'فشل في حذف الرسالة');
        }
    }

    public function changeActive(CustomMessage $msg)
    {
        if($msg->disactivable()){
            $isUpdated = $msg->update([
                'is_active' => $msg->is_active == 1? "off": "on",
            ]);
            return redirect()->back()
                ->with('success', 'تم تعديل حالة الرسالة المخصصة بنجاح');
        }else{
            return redirect()->back()
                ->with('error', 'لا يمكنك تغيير حالة هذه الرسالة');
        }
    }
}
