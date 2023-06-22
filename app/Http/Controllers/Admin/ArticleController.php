<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::query()->paginate(5);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {

        $validated = $request->validated();

        // add slug
        $validated['slug'] = Str::slug($validated['title']);

        // store image
        if ($request->hasFile('image')) {
            $request->file('image')->store('public/images');
            $validated['image'] = $request->file('image')->hashName();
        }

        Article::query()->create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'تم اضافة المقال بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article = Article::query()->find($id);

        if (!$article) {
            return redirect()->route('admin.articles.index')
                ->with('error', 'فشل في تعديل المقال');
        }

        return view('articles.edit', compact('Article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        $article = Article::query()->find($id, 'id');

        if (!$article) {
            return redirect()->route('admin.articles.index')
                ->with('error', 'فشل في تعديل المقال');
        }

        $validated = $request->validated();

        // add slug
        $validated['slug'] = Str::slug($validated['title']);

        // store image
        if ($request->hasFile('image')) {
            if ($article->image != null) {
                Storage::disk('local')->delete('public/images/' . $article->image);
            }
            $request->file('image')->store('public/images');
            $validated['image'] = $request->file('image')->hashName();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'تم تعديل الدور بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::query()->find($id);

        if (!$article) {
            return redirect()->route('admin.articles.index')
                ->with('error', 'فشل في حذف الدور');
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'تم حذف المقال بنجاح');
    }
}
