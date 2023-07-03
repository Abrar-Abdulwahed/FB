<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleComment;
use Illuminate\Http\Request;

class DeletedArticleCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comments = ArticleComment::onlyTrashed()->paginate(5);;
        return view('article_comments.deleted_comments',compact('comments'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $comment = ArticleComment::withTrashed()->where('id',$id)->restore();
        return redirect()->route('admin.comments.index')
            ->with('success', 'تم استعادة التعليق بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        /* $comment = ArticleComment::withTrashed()->where('id',$id)->first();
        $comment->forceDelete();
        return redirect()->route('admin.deleted_comments.index')
            ->with('success', 'تم حذف التعليق نهائيا'); */

    }
}
