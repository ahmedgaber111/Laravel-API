<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class APILoginContoller extends Controller
{
    public function login(Request$request)
    {
        $validator = Validator::make($request->all(), [
            'email'       => 'required|string|email',
            'password'    =>'required'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors());
        }
      $credentials=$request->only('email','password');
      try{
        if (!$token =JWTAuth::attempt($credentials)) {
            return response()->json(['errors'=>'invalid username and password'],401);
        }
      }catch(JWTException $e)
      {
        return response()->json(['errors'=>'couldnt create token'],500);
      }
      return response()->json(compact('token'));
    }
}
