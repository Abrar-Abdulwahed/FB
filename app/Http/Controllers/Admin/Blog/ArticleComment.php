<?php

namespace App\Http\Controllers\Admin\Blog;

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

        return view('admin.blog.comments.index', compact('comments'));
    }

    public function deletedComments(){
        $comments = ModelsArticleComment::onlyTrashed()->paginate(5);;
        return view('admin.blog.comments.deleted_comments',compact('comments'));
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

    public function restoreComments(Request $request,$id){
        $comment =ModelsArticleComment::withTrashed()->where('id',$id)->restore();
        return redirect()->route('admin.comments.index')
            ->with('success', 'تم استعادة التعليق بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        //
        $article = Article::query()->with('comments')->first();

        $comments = ModelsArticleComment::where('article_id',$article->id)->get();

        return view('admin.blog.comments.show', compact('article','comments'));
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
    public function destroy(Request $request,$id)
    {
        //
        $comment = ModelsArticleComment::query()->find($id);
        $comment_trash = ModelsArticleComment::withTrashed()->where('id',$id)->first();

        //dd($comment);
        switch($request->action){
            case('block'):
                $user = $comment->user->update(['is_banned'=>1]);          
            break;
            case('block_deleted'):
                $user = $comment_trash->user->update(['is_banned'=>1]);          
            break;
            case('delete_all'):
                ModelsArticleComment::where('user_id',$comment->user_id)->delete();
            break;
            case('delete_comment_all'):
                ModelsArticleComment::where('user_id',$comment_trash->user_id)->delete();
                $comment_trash->forceDelete();
            break;
            case('deleted'):
                $comment_trash->forceDelete();
                return redirect()->route('admin.deleted_comments.index')
                    ->with('success', 'تم حذف التعليق نهائيا');
            break;
            default:
            $comment->delete();        
        }
        

        return redirect()->route('admin.comments.index')
            ->with('success', 'تم حذف التعليق بنجاح');
    }
}
