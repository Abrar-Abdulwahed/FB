<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function checkProvider($provider){
        return in_array($provider, ['facebook', 'google']) ? true : false;
    }
    public function redirect($provider){
        if(!$this->checkProvider($provider))
            return abort(404);
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        try{
            if(!$this->checkProvider($provider))
                return abort(404);
            $socialUser = Socialite::driver($provider)->user();
            $user = User::updateOrCreate([
                'provider_id' => $socialUser->id,
                'provider'    => $provider
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
            ]);

            Auth::login($user);

            // to append new role, NOT repeat role, NOT detach
            $user->roles()->SyncWithoutDetaching([2]);

            //TODO: Change redirect to the homepage/control panel/whatever according to role
            return redirect()->route('admin.index'); 
        }catch(\Throwable $e){
            return redirect()->back()->withError('something went wrong');
        }
    }
}
