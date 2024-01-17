<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class APIRegisterContoller extends Controller
{
    public function register(Request$request)
    {
        $validator = Validator::make($request->all(), [
            'email'       => 'required|string|unique:users|email|max:255',
            'name'        => 'required',
            'password'    =>'required'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors());
        }
        
        User::create([
            'name'    =>$request->name,
            'email'    =>$request->email,
            'password'    =>bcrypt($request->password),
            
        ]);
        $user=User::first();
        $token=JWTAuth::fromUser($user);
        return response()->json(compact('token'));

    }
}
