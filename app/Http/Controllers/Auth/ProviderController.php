<?php

namespace App\Http\Controllers\Auth;

// use App\Models\User;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($driver){
        return Socialite::driver($driver)->redirect();
    }

    public function callback($driver){
        try{
            $socialUser = Socialite::driver($driver)->user();
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
