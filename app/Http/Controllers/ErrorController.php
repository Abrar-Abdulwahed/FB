<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    //
    public function error(){
        return view('errors.banned')->with('errors','الحساب محظور لفترة محددة');
    }

    public function lock(){
        return view('errors.locked')->withError('errors', Setting::where('name', 'reason_locked')->first()?->value);
    }
}
