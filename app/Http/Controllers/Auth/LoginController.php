<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function index(){
    //     dd('hihihiddddd');
    //     if(!Auth::guard()->check())
    //         return view('auth.login');
    //     return redirect()->back(); // redirect if authenticated
    // }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');

        if(!Auth::validate($credentials))
            return redirect()->to('login')->withErrors('فشل تسجيل الدخول');
        $logged = Auth::attempt($credentials);
        if ($logged) {
            return redirect()->to('/');
        }
        return redirect()->back();
    }
}
