<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\Article\ArticleStoreRequest;
use App\Http\Requests\Admin\Blog\Article\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Tag;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    use ImageTrait;
    public function index()
    {
        $articles = Article::with('tags')->paginate(5);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();

        $categories = ArticleCategory::all();

        return view('articles.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {

        $validated = $request->safe();

        // add slug
        $validated = $validated->merge([
            'slug' => Article::generateSlug($validated['title']),
        ]);

        // store image
        if ($request->hasFile('image')) {
            $validated = $validated->merge([
                'image' => $this->uploadImage($request->file('image'), 'public/articles'),
            ]);
        }

        $article = Article::query()
            ->create($validated->except('tags'));

        if (!empty($validated['tags'])) {
            $article->tags()->sync($validated['tags']);
        }

        if (!empty($validated['categories'])) {
            $article->categories()->sync($validated['categories']);
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'تم اضافة المقال بنجاح');
    }

    public function show($slug)
    {

        $article = Article::query()
            ->where('slug', '=', $slug)
            ->firstOrFail();

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article = Article::query()->findOrFail($id);
        $tags = Tag::all();
        $categories = ArticleCategory::all();

        return view('articles.edit', compact('article', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        $article = Article::query()->findOrFail($id);

        $validated = $request->safe();
        // dd($validated);

        // add slug
        $validated = $validated->merge([
            'slug' => Article::generateSlug($validated['title']),
        ]);

        // store image
        if ($request->hasFile('image')) {
            if ($article->image) {
                //Remove old image
                Storage::disk('local')->delete('public/articles/' . $article->image);
            }

            $validated = $validated->merge([
                'image' => $this->uploadImage($request->file('image'), 'public/articles'),
            ]);
        }

        $article->update($validated->except('tags'));

        if (!empty($validated['tags'])) {
            $article->tags()->sync($validated['tags']);
        }

        if (!empty($validated['categories'])) {
            $article->categories()->sync($validated['categories']);
        }

        return redirect()->route('articles.index')
            ->with('success', 'تم تعديل الدور بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::query()->findOrFail($id);

        $article->delete();

        if ($article->image != null) {
            Storage::disk('local')->delete('public/articles/' . $article->image);
        }

        return redirect()->route('articles.index')
            ->with('success', 'تم حذف المقال بنجاح');
    }

    public function category($slug)
    {
        $category = ArticleCategory::query()->where('slug', $slug)->firstOrFail();

        $articles = $category->articles;

        return view('articles.categories.show', compact('articles'));
    }
}
