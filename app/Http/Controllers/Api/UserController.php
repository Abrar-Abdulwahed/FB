<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function latest(){
        $users = User::latest()->get();
        if($users->count() > 0){
             return ApiResponse::sendResponse('200','latest users retrived successfully',UserResource::collection($users));
        }
        return ApiResponse::sendResponse('200','users not found',[]);
    }

    public function search(Request $request){
        $word = $request->input('search') ?? null;
        $ads = User::when($word != null ,function ($q) use ($word){
          $q->where('name','like','%'.$word.'%')
             ->orWhere('email','like','%'.$word.'%')
             ->orWhere('role','like','%'.$word.'%');
        })->latest()->get();

        if($ads->count() > 0){
            return ApiResponse::sendResponse('200','search completed',UserResource::collection($ads));
       }
       return ApiResponse::sendResponse('200','search not found',[]);
    }
}
