<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    //
    public function error(){
        return view('errors.banned')->with('errors','الحساب محظور لفترة محددة');
    }
}
