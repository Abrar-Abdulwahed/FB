<?php

namespace App\Http\Controllers\Auth;

// use App\Models\User;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function checkProvider($provider){
        $expectedProviders = array_keys(Config::get('services'));
        return in_array($provider, $expectedProviders) ? true : false;
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
                'provider'    => $driver
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
            ]);

            //TODO: Get use logged in
            // Auth::login($user);

            //TODO: Change redirect to the homepage/control panel/whatever
            return redirect('/'); 
        }catch(\Throwable $e){
            return redirect()->back()->withError('something went wrong');
        }
    }
}
