<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()->paginate(5);
        return view('admin.users.articles.index', compact('articles'));
    }

    public function show($slug)
    {

        $article = Article::query()->where('slug', '=', $slug)->firstOrFail();

        return view('users.articles.show', compact('article'));
    }

    public function store(Request $request)
    {
        //
        $comment = $request->input('comment');
        $article_id = $request->input('article_id');

        ArticleComment::create([
            'user_id'=>Auth::id(),
            'article_id'=>$article_id,
            'comment'=>$comment
        ]);
        return redirect()->back()->with('success','تم اضافة التعليق بنجاح');
    }
}
