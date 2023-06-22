<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ErrorController extends Controller
{
    //
    public function error(){
        if(Auth::user()->is_banned == 0){
            abort(404);
        }
        return view('errors.banned')->with('errors','الحساب محظور لفترة محددة');
    }
}
