<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except('index', 'show');
    // }
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
        $slugify = new Slugify();

        $validated['slug'] = $slugify->slugify($validated['title']);

        // store image
        if ($request->hasFile('image')) {
            $request->file('image')->store('public/images');
            $validated['image'] = $request->file('image')->hashName();
        }

        Article::query()->create($validated);

        return redirect()->route('articles.index')
            ->with('success', 'تم اضافة المقال بنجاح');
    }

    public function show($slug)
    {

        $article = Article::query()->where('slug', '=', $slug)->first();

        if (!$article) {
            return redirect()->route('articles.index')
                ->with('error', 'فشل في عرض المقال');
        }

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article = Article::query()->find($id);

        if (!$article) {
            return redirect()->route('articles.index')
                ->with('error', 'فشل في تعديل المقال');
        }

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        $article = Article::query()->find($id);

        if (!$article) {
            return redirect()->route('articles.index')
                ->with('error', 'فشل في تعديل المقال');
        }

        $validated = $request->validated();

        // add slug
        $slugify = new Slugify();

        $validated['slug'] = $slugify->slugify($validated['title']);

        // store image
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('local')->delete('public/images/' . $article->image);
            }
            $request->file('image')->store('public/images');
            $validated['image'] = $request->file('image')->hashName();
        }

        $article->update($validated);

        return redirect()->route('articles.index')
            ->with('success', 'تم تعديل المقال بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::query()->find($id);

        if (!$article) {
            return redirect()->route('articles.index')
                ->with('error', 'فشل في حذف المقال');
        }

        $article->delete();

        if ($article->image != null) {
            Storage::disk('local')->delete('public/images/' . $article->image);
        }

        return redirect()->route('articles.index')
            ->with('success', 'تم حذف المقال بنجاح');
    }
}
