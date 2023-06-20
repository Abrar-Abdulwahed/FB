<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidation;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserValidation $request)
    {
        //
        User::create([
            'name' => $request->name,
            'status' => $request->status,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('user.index')->with('success','تم اصافة اليوزر بنجاح');
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
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserValidation $request,$id)
    {
        //
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('user.index')->with(['success' => 'User is updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        User::where('id',$id)->delete();
        return redirect()->back()->with(['success' => 'User is deleted successfully']);
    }
}
