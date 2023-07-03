<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{

    public function index()
    {
        $pages = Tag::all();

        return TagResource::collection($pages);
    }
}
