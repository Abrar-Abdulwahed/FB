<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleComment as ModelsArticleComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleComment extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comments = ModelsArticleComment::query()->paginate(5);

        return view('article_comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $comment = $request->input('comment');
        $article_id = $request->input('article_id');

        ModelsArticleComment::create([
            'user_id'=>Auth::id(),
            'article_id'=>$article_id,
            'comment'=>$comment
        ]);
        return redirect()->back()->with('success','تم اضافة التعليق بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        //
        $article = Article::query()->with('comments')->where('slug', '=', $slug)->first();

        $comments = ArticleComment::where('article_id',$article->id)->get();

        return view('article_comments.show', compact('article','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id,$action)
    {
        //
        $comment = ModelsArticleComment::query()->find($id);

        switch($action){
            case('block'):
                $user = $comment::user()->update(['is_banned'],true);
            break;
            case('delete_all'):
                ModelsArticleComment::where('user_id',$comment->user_id)->delete();
            break;
            default:
            $comment->delete();        
        }
        

        return redirect()->route('admin.comments.index')
            ->with('success', 'تم حذف التعليق بنجاح');
    }
}
