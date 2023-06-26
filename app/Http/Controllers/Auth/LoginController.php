<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoginActivity;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Jenssegers\Agent\Facades\Agent;

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
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request)
    {
        //echo $request; die;
        $credentials = $request->only('email', 'password');
        $logged = Auth::attempt($credentials);
        if ($logged) {
            LoginActivity::create([
                'user_id' => auth()->user()->id,
                'user_agent' => $request->header('user-agent'),
                'browser' => Agent::browser(),
                'ip' => FacadesRequest::ip(),
            ]);
            return redirect()->route('admin.index');
        }
        return redirect()->back()->withError('error', __('failed'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
