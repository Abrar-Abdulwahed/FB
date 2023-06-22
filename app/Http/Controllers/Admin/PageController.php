<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;
use App\Models\Page;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::query()->paginate(5);

        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageStoreRequest $request)
    {

        $validated = $request->validated();

        // add slug
        $slugify = new Slugify();

        $validated['slug'] = $slugify->slugify($validated['title']);

        // store image
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('', $filename, 'public');
            $validated['image'] = $path;
        }

        Page::query()->create($validated);

        return redirect()->route('pages.index')
            ->with('success', 'تم اضافة الصفحة بنجاح');
    }

    public function show($slug)
    {

        $page = Page::query()->where('slug', '=', $slug)->first();

        if (!$page) {
            return redirect()->route('pages.index')
                ->with('error', 'فشل في عرض الصفحة');
        }

        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page = Page::query()->find($id);

        if (!$page) {
            return redirect()->route('pages.index')
                ->with('error', 'فشل في تعديل الصفحة');
        }

        return view('pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateRequest $request, $id)
    {
        $page = Page::query()->find($id);

        if (!$page) {
            return redirect()->route('pages.index')
                ->with('error', 'فشل في تعديل الصفحة');
        }

        $validated = $request->validated();

        // add slug
        $slugify = new Slugify();

        $validated['slug'] = $slugify->slugify($validated['title']);

        // store image
        if ($request->hasFile('image')) {
            if ($page->image) {
                //Remove old image
                Storage::disk('public')->delete($page->image);
            }
            $filename = $request->file('image')->getClientOriginalName();
            $validated['image'] = $request->file('image')->storeAs('', $filename, 'public');
        }


        $page->update($validated);

        return redirect()->route('pages.index')
            ->with('success', 'تم تعديل الصفحة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $page = Page::query()->find($id);

        if (!$page) {
            return redirect()->route('pages.index')
                ->with('error', 'فشل في حذف الصفحة');
        }

        $page->delete();

        if ($page->image != null) {
            Storage::disk('local')->delete('public/images/' . $page->image);
        }

        return redirect()->route('pages.index')
            ->with('success', 'تم حذف الصفحة بنجاح');
    }
}
