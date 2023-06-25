<?php

namespace App\Traits;

use Illuminate\Http\Request;

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
}
