<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\LoginActivity as ModelsLoginActivity;

class LoginActivityController extends Controller
{
    //
    public function index()
    {

        $login_activities = ModelsLoginActivity::where('user_id', auth()->user()->id)->latest()->paginate(10);
        return view('admin.users.login_activities.index', compact('login_activities'));
    }
}
