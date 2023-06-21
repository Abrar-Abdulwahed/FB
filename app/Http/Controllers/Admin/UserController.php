<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidation;
use App\Models\User;
use App\Traits\AvatarTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AvatarTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserValidation $request)
    {
        //
        $path= $this->uploadAvatar($request,'avatars');
        $user['avatar'] = $path;
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar'=>$path
        ]);
        return redirect()->route('users.index')->with('success','تم اضافة عضو جديد بنجاح');
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
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $user = User::findOrFail($id);
        $user->is_banned = $request->input('is_banned');
        $user->datetime = $request->input('datetime');
        if($user->is_banned == 'false'){
            $user->datetime = Null;
        }
        $user->update($request->all());
        
        return redirect()->route('users.index')->with(['success' => 'تم تحديث بيانات العضو بنجاح']);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        User::where('id',$id)->delete();
        return redirect()->back()->with(['success' => 'تم حذف العضو بنجاح']);
    }
}
