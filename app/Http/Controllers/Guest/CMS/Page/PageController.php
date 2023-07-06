<?php

namespace App\Http\Controllers\Guest\CMS\Page;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::query()->where('slug', '=', $slug)->firstOrFail();

        $articles = Article::query()
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('guest.cms.pages.show', compact('page', 'articles'));
    }
}
