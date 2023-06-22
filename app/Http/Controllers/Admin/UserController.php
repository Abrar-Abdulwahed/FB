<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_banned' => $request->is_banned,
            'banned_until' => $request->banned_until,
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')->with('success', 'تم اصافة اليوزر بنجاح');
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

        // dd($validated);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }
        $user->is_banned = $validated['is_banned'];
        $user->banned_until = $validated['is_banned'] == 0 ? null : $validated['banned_until'];

        $user->save();

        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')->with(['success' => 'تم تحديث بيانات العضو بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        User::where('id', $id)->delete();
        return redirect()->back()->with(['success' => 'User is deleted successfully']);
    }
}
