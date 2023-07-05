<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserDestroyRequest;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserEmailHistory;
use App\Traits\AvatarTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    use AvatarTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        $query = User::query();

        if ($request->has('role') && $request->role !== "all") {
            $query->whereHas('roles', function ($query) use ($request) {
                $query->where('name', $request->role);
            });
        }
        $users = $query->with('roles')->get();
        return view('admin.users.index', compact('users', 'roles'));
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
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.index')->with(['success' => 'تم تحديث بيانات العضو بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDestroyRequest $request, $id)
    {
        try {
            $user = User::query()->findOrFail($id);
            $user->delete();
            if ($user->avatar) {
                Storage::disk('avatars')->delete($user->avatar);
            }
            return redirect()->back()->with(['success' => 'تم حذف العضو بنجاح']);
        } catch (\Throwable $e) {
            return redirect()->back()->with(['error' => $e]);
        }
    }

    public function email_history($user_id)
    {
        $emails = UserEmailHistory::where('user_id', $user_id)->get();
        return view('admin.users.email_history.index', compact('emails', 'user_id'));
    }

    public function email_show($email_id)
    {
        $email = UserEmailHistory::findOrFail($email_id);
        return view('admin.users.email_history.show', compact('email'));
    }

    public function verifyEmail($id)
    {
        $user = User::findOrFail($id);

        event(new Registered($user));

        return redirect()->route('admin.users.index');
    }

    public function activities(User $user)
    {
        $activities = Activity::query()
            ->where('causer_type', '=', User::class)
            ->where('causer_id', '=', $user->id)
            ->get();

        // dd($activities->first());

        return view('admin.users.activities.index', compact('activities'));
    }
}
