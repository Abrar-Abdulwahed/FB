<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Traits\AvatarTrait;
use Illuminate\Http\Request;
use App\Models\LoginActivity;
use Jenssegers\Agent\Facades\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ProviderController extends Controller
{
    use AvatarTrait;
    public function checkProvider($provider){
        return in_array($provider, ['facebook', 'google']) ? true : false;
    }
    public function redirect($provider){
        if(!$this->checkProvider($provider))
            return abort(404);
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        if(!$this->checkProvider($provider))
            return abort(404);
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'provider_id' => $socialUser->id,
            'provider'    => $provider
        ], [
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'avatar'=> $this->uploadAvatarFromURL($socialUser->avatar),
        ]);

        Auth::login($user);
        LoginActivity::create([
            'user_id'       => auth()->user()->id,
            'user_agent'    => request()->header('user-agent'),
            'browser'    => Agent::browser(),
            'ip'    =>  FacadesRequest::ip(),
        ]);

        // to append new role, NO repeat role, NO detach
        $user->roles()->SyncWithoutDetaching([2]);

        //TODO: Change redirect to the homepage/control panel/whatever according to role
        return redirect()->route('admin.index'); 
    }
}
