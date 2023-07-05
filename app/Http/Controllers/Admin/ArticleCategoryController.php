<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\Article\Category\ArticleCategoryRequest;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $categories = ArticleCategory::paginate(5);
        return view('articles.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleCategoryRequest $request)
    {
        ArticleCategory::query()->create($request->validated());

        return redirect()
            ->route('admin.articles-categories.index')
            ->with('success', 'تم اضافة القسم بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = ArticleCategory::query()->findOrFail($id);
        return view('articles.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleCategoryRequest $request, $id)
    {
        ArticleCategory::query()
            ->findOrFail($id)
            ->update($request->validated());

        return redirect()
            ->route('admin.articles-categories.index')
            ->with('success', 'تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ArticleCategory::query()->findOrFail($id)->delete();

        return redirect()->back()->with(['success' => 'تم حذف القسم بنجاح']);
    }
}
