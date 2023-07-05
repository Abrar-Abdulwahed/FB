<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\PageStoreRequest;
use App\Http\Requests\Admin\Page\PageUpdateRequest;
use App\Models\Page;
use App\Traits\ImageTrait;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    use ImageTrait;
    public function index()
    {
        $pages = Page::query()->paginate(5);

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageStoreRequest $request)
    {

        $validated = $request->validated();

        // add slug
        $validated['slug'] = Page::generateSlug($validated['title']);

        // store image
        // if ($request->hasFile('image')) {
        //     $validated['image'] = $this->uploadImage($request->file('image'), 'public/pages');
        // }

        Page::query()->create([
            'is_in_footer' => array_key_exists('is_in_footer', $validated) && $validated['is_in_footer'] == 'on' ? true : false,
            'is_in_menu' => array_key_exists('is_in_menu', $validated) && $validated['is_in_menu'] == 'on' ? true : false,
            // 'image' => $validated['image'] ?? null,
            'slug' => $validated['slug'],
            'title' => $validated['title'],
            'content' => $validated['content'],
            'description' => $validated['description'],

        ]);

        //Page::query()->create($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'تم اضافة الصفحة بنجاح');
    }

    public function show($slug)
    {

        $page = Page::query()->where('slug', '=', $slug)->firstOrFail();

        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page = Page::query()->find($id);

        if (!$page) {
            return redirect()->route('admin.pages.index')
                ->with('error', 'فشل في تعديل الصفحة');
        }

        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateRequest $request, $id)
    {
        $page = Page::query()->find($id);

        if (!$page) {
            return redirect()->route('admin.pages.index')
                ->with('error', 'فشل في تعديل الصفحة');
        }

        $validated = $request->validated();

        // add slug
        $validated['slug'] = Page::generateSlug($validated['title']);

        // store image
        // if ($request->hasFile('image')) {
        //     if ($page->image) {
        //         //Remove old image
        //         Storage::disk('local')->delete('public/pages/' . $page->image);
        //     }
        //     $validated['image'] = $this->uploadImage($request->file('image'), 'public/pages');
        // }

        $page->update([
            'is_in_footer' => array_key_exists('is_in_footer', $validated) && $validated['is_in_footer'] == 'on' ? true : false,
            'is_in_menu' => array_key_exists('is_in_menu', $validated) && $validated['is_in_menu'] == 'on' ? true : false,
            // 'image' => $validated['image'] ?? null,
            'slug' => $validated['slug'],
            'title' => $validated['title'],
            'content' => $validated['content'],
            'description' => $validated['description'],

        ]);

        //$page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'تم تعديل الصفحة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $page = Page::query()->find($id);

        if (!$page) {
            return redirect()->route('admin.pages.index')
                ->with('error', 'فشل في حذف الصفحة');
        }

        $page->delete();

        if ($page->image != null) {
            Storage::disk('local')->delete('public/pages/' . $page->image);
        }

        return redirect()->route('admin.pages.index')
            ->with('success', 'تم حذف الصفحة بنجاح');
    }
}
