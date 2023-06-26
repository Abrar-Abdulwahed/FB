<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\Article;
use Illuminate\Http\Request;

class UserArticleController extends Controller
{
    public function index(){
        $articles=Article::get();
        return view('user.articles.index',compact($articles));
    }

}