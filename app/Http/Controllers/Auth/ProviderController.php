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
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Request as FacadesRequest;

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

            // To save image in db and storage with hashname
            $avatar = file_get_contents($socialUser->avatar);
            $hashName = hash('sha256', $avatar).'.png';
            Storage::disk('avatars')->put($hashName, $avatar);

            $user = User::updateOrCreate([
                'provider_id' => $socialUser->id,
                'provider'    => $provider
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'avatar'=> $hashName,
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
        }catch(\Throwable $e){
            return redirect()->back()->withError('something went wrong');
        }
    }
}
