<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        $name = $request->query('name');
        $email = $request->query('email');

        $query = User::query();

        if ($name)
        {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }

        if ($email)
        {
            $query->where('email', 'LIKE', '%' . $email . '%');
        }

        $users = $query->get();

        if ($users->isEmpty())
        {
            return response()->json(['message' => 'searchnotfound'], 404);
        }

        return UserResource::collection($users);
    }
}
