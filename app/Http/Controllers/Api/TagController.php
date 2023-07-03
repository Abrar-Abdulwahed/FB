<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::paginate(15);

        return TagResource::collection($tags->items());
    }
}
