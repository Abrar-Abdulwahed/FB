<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;

class PageController extends Controller
{

    public function index()
{
    $pages = Page::paginate(15);

    return PageResource::collection($pages->items());
}


}
