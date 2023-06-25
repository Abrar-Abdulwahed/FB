<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileValidation;
use App\Models\User;
use App\Traits\AvatarTrait;
use DragonCode\Support\Filesystem\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AvatarTrait;
    public function index()
    {
        //
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        
        return view('users.settings.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserProfileValidation $request,$id)
    {
        //
        $user = User::findOrFail($id);
        $data = $request->validated();
        if(!empty($request->avatar)){
            $path= $this->uploadAvatar($request,'avatars');
            $data['avatar'] = $path;
            if(!empty($user->avatar)){
                Storage::disk('avatars')->delete($user->avatar); 
            }

            $user->update([ 'avatar' => $path]);
        }
        if(!empty($user->current_password)){
            if(Hash::check($data['current_password'],Auth::user()->password)){
                User::where('id',Auth::user()->id)->update(['password'
                =>bcrypt($data['new_password'])]);
            } else{
                return redirect()->back()->with(['error' => 'كلمة المرور الحالية خاطئة']);
            }  
        }
        
        return redirect()->back()->with(['success' => 'تم تحديث بيانات المستخدم بنجاح']);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
