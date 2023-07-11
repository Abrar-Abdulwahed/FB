<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\Role\RoleDestroyRequest;
use App\Http\Requests\Admin\User\Role\RoleStoreRequest;
use App\Http\Requests\Admin\User\Role\RoleUpdateRequest;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::query()->paginate(5);

        return view('admin.users.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request)
    {
        $validated = $request->validated();

        Role::query()->create($validated);

        return redirect()->route('admin.roles.index')
            ->with('success', __('admin/users/role.messages.create'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::query()->find($id);

        if (!$role) {
            return redirect()->route('admin.roles.index')
                ->with('error',  __('admin/users/role.messages.failed edit'));
        }

        return view('admin.users.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $role = Role::query()->find($id, 'id');

        if (!$role) {
            return redirect()->route('admin.roles.index')
                ->with('error',  __('admin/users/role.messages.failed edit'));
        }

        $validated = $request->validated();

        $role->update($validated);

        return redirect()->route('admin.roles.index')
            ->with('success', __('admin/users/role.messages.edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleDestroyRequest $request,$id)
    {
        $role = Role::query()->find($id);

        if (!$role) {
            return redirect()->route('admin.roles.index')
                ->with('error',  __('admin/users/role.messages.failed delete'));
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', __('admin/users/role.messages.delete'));
    }
}
