<?php

namespace App\Http\Controllers\Admin\CMS\Blog\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\Tag\TagValidation;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tags = Tag::paginate(5);
        return view('admin.cms.blog.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.cms.blog.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagValidation $request)
    {
        //
        $tag = Tag::create($request->validated());
        return redirect()->route('admin.tags.index')->with('success', __('admin/CMS/Blog/Tag/tag.messages.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $tag = Tag::query()->where('slug', '=', $slug)->firstOrFail();

        return view('admin.cms.blog.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $tag = Tag::find($id);
        return view('admin.cms.blog.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagValidation $request, $id)
    {
        //
        Tag::find($id)->update($request->validated());
        return redirect()->route('admin.tags.index')->with('success',  __('admin/CMS/Blog/Tag/tag.messages.edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Tag::where('id', $id)->delete();
        return redirect()->back()->with(['success' =>  __('admin/CMS/Blog/Tag/tag.messages.delete')]);
    }
}
