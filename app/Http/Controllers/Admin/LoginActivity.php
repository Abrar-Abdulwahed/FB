<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginActivity as ModelsLoginActivity;
use Illuminate\Http\Request;

class LoginActivity extends Controller
{
    //
    public function index(){
        
    $login_activities = ModelsLoginActivity::where('user_id',auth()->user()->id)->latest()->paginate(10);
    return view('admin.login_activities.index', compact('login_activities'));
    }
}
