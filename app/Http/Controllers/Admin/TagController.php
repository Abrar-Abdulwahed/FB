<?php

namespace App\Http\Controllers\Admin;

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
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagValidation $request)
    {
        //
        $tag = Tag::create($request->validated());
        return redirect()->route('admin.tags.index')->with('success', 'تم اضافة التاج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $tag = Tag::query()->where('slug', '=', $slug)->first();

        if (!$tag) {
            return redirect()->route('tags.index')
                ->with('error', 'فشل في عرض العلامة');
        }

        return view('tags.show', compact('tag'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $tag = Tag::find($id);
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagValidation $request, $id)
    {
        //
        Tag::find($id)->update($request->validated());
        return redirect()->route('admin.tags.index')->with('success', 'تم تعديل التاج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Tag::where('id', $id)->delete();
        return redirect()->back()->with(['success' => 'تم حذف التاج بنجاح']);
    }
}
