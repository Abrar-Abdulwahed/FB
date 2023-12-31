<?php

namespace App\Http\Controllers\Admin\Setting\CustomMessage;

use DataTables;
use App\Services\CustomMessageService;
use App\Models\CustomMessage;
use App\Http\Controllers\Controller;
use App\DataTables\CustomMessageDataTable;
use App\Http\Requests\Admin\CustomMessage\StoreCustomMessageRequest;
use App\Http\Requests\Admin\CustomMessage\UpdateCustomMessageRequest;
use App\Http\Requests\Admin\CustomMessage\ChangeActiveCustomMessageRequest;

class CustomMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private CustomMessageService $customMessageService){}

    public function index(CustomMessageDataTable $dataTable)
    {
        return $dataTable->render('admin.settings.custom_message.index');
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
        $this->customMessageService->store($request->validated());
        return redirect()->route('admin.custom-message.index')->with('success', 'تم إضافة الرسالة بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $message = CustomMessage::findOrFail($id);
        return view('admin.settings.custom_message.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomMessageRequest $request, int $id)
    {
        $this->customMessageService->update($request->validated(), $id);
        return redirect()->route('admin.custom-message.index')->with('success', 'تم تعديل الرسالة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->customMessageService->destroy($id);
        return redirect()->back()->with('success', 'تم حذف الرسالة بنجاح');
    }

    public function changeActive(ChangeActiveCustomMessageRequest $request, CustomMessage $msg)
    {
        $request->session()->flash('success', $request->input('message'));
        $msg->update([
            'is_active' => $msg->is_active == 1? "off": "on",
        ]);
        return redirect()->back()
            ->with('success', 'تم تعديل حالة الرسالة المخصصة بنجاح');
    }
}
