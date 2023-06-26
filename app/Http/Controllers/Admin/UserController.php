<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\AvatarTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use AvatarTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {

        $validated = $request->validated();

        // store image
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $this->uploadAvatar($request->file('avatar'));
        }
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'avatar' => $validated['avatar'] ?? null,
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'تم اصافة اليوزر بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = Role::all();

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        // store image
        if ($request->hasFile('avatar')) {
            if ($user->avatar != null) {
                Storage::disk('avatars')->delete($user->avatar);
            }
            $validated['avatar'] = $this->uploadAvatar($request->file('avatar'));
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ?? $user->password,
            'is_banned' => $validated['is_banned'],
            'banned_until' => $validated['is_banned'] == 0 ? null : $validated['banned_until'],
            'avatar' => $validated['avatar'] ?? $user->avatar,
        ]);

        // $user->name = $validated['name'];
        // $user->email = $validated['email'];
        // if ($validated['password']) {
        //     $user->password = Hash::make($validated['password']);
        // }
        // $user->is_banned = $validated['is_banned'];
        // $user->banned_until = $validated['is_banned'] == 0 ? null : $validated['banned_until'];

        // $user->save();

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with(['success' => 'تم تحديث بيانات العضو بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $user = User::query()->findOrFail($id);

        $user->delete();

        if ($user->avatar) {
            Storage::disk('avatars')->delete($user->avatar);
        }
        return redirect()->back()->with(['success' => 'تم حذف العضو بنجاح']);
    }

    public function verifyEmail($id)
    {
        $user = User::findOrFail($id);

        event(new Registered($user));

        return redirect()->route('admin.users.index');
    }
}
