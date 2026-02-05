<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
   public function me(Request $request)
    {
        return new UserResource($request->user());
    }

    public function index()
    {
        return UserResource::collection(User::all());
    }
}
