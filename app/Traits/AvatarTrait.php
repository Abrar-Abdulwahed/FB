<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait AvatarTrait
{

    public function uploadAvatar(Request $request ,$folderName){
        if($request->avatar){
            $avatar = $request->file('avatar')->getClientOriginalName();
            $path = $request->file('avatar')->storeAs($folderName,$avatar,'fatma');
            return $path;
        }
    }

}
