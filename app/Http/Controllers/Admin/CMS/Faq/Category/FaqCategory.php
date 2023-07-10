<?php

namespace App\Http\Controllers\Admin\CMS\Faq\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Faq\Category\FaqCategoryRequest;
use App\Models\FaqCategory as ModelsFaqCategory;
use Illuminate\Http\Request;

class FaqCategory extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = ModelsFaqCategory::paginate(5);
        return view('admin.cms.faqs.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.cms.faqs.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqCategoryRequest $request)
    {
        //
        ModelsFaqCategory::query()->create($request->validated());

        return redirect()
            ->route('admin.faqs-categories.index')
            ->with('success', 'تم اضافة القسم بنجاح');
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
        $category = ModelsFaqCategory::query()->findOrFail($id);
        return view('admin.cms.faqs.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqCategoryRequest $request,$id)
    {
        //
        ModelsFaqCategory::query()
            ->findOrFail($id)
            ->update($request->validated());

        return redirect()
            ->route('admin.faqs-categories.index')
            ->with('success', 'تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        ModelsFaqCategory::query()->findOrFail($id)->delete();

        return redirect()->back()->with(['success' => 'تم حذف القسم بنجاح']);
    }
}
