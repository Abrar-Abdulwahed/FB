<?php

namespace App\Http\Controllers\Admin\CMS\Faq;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Faq\FaqValidation;
use App\Models\Faq;
use App\Models\FaqCategory;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $faqs = Faq::paginate(5);
        return view('admin.cms.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = FaqCategory::all();
        return view('admin.cms.faqs.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqValidation $request)
    {
        //
        $validated = $request->validated();
        $faq = Faq::query()->create($request->validated());
        $faq->categories()->sync($request->categories);

        return redirect()->route('admin.faqs.index')->with('success', 'تم اضافة السؤال بنجاح');
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
    public function edit($id)
    {
        //
        $faq = Faq::find($id);
        $categories = FaqCategory::all();
        return view('admin.cms.faqs.edit', compact('faq','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqValidation $request, $id)
    {
        //
        $faq = Faq::findOrFail($id);
        $faq->update($request->validated());

        $faq->categories()->sync($request->categories);

        return redirect()->route('admin.faqs.index')->with('success', 'تم تعديل السؤال بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Faq::where('id', $id)->delete();
        return redirect()->back()->with(['success' => 'تم حذف السؤال بنجاح']);
    }
}
