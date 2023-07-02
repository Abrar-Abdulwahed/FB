<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait AvatarTrait
{

    public function uploadAvatar($file)
    {
        // if($request->avatar){
        //     $avatar = $request->file('avatar')->getClientOriginalName();
        //     $path = $request->file('avatar')->storeAs($folderName,$avatar,'avatars');
        //     return $path;
        // }

        $file->store('/', 'avatars');
        return $file->hashName();
    }
    
    public function uploadAvatarFromURL($url){
        $avatar = file_get_contents($url);
        $hashName = hash('sha256', $avatar).'.png';
        Storage::disk('avatars')->put($hashName, $avatar);
        return $hashName;
    }
}
