<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\UserProfileValidation;
use App\Models\User;
use App\Traits\AvatarTrait;
use DragonCode\Support\Filesystem\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        return view('users.settings.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserProfileValidation $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $data = $request->validated();
        /* if (!empty($request->avatar)) {
           
            if (!empty($user->avatar)) {
                Storage::disk('avatars')->delete($user->avatar);
            }
            $path = $this->uploadAvatar($request, 'avatars');
            $data['avatar'] = $path;
            
        }
        $user->update(['avatar' => $path]); */

        
        // }

        if ($request->hasFile('avatar')) {
            if ($user->avatar != null) {
                Storage::disk('avatars')->delete($user->avatar);
            }

            $data['avatar'] = $this->uploadAvatar($request->avatar);
            $user->update(['avatar' => $data['avatar']]);
        }

        if (!empty($request->email)) {
            $user->update(['email' => $request->email]);
        }
        if (!empty($data['current_password'])) {
            if (Hash::check($data['current_password'], Auth::user()->password)) {
                User::where('id', Auth::user()->id)->update(['password' => bcrypt($data['new_password'])]);
            } else {
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
