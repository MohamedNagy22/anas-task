<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $rules = [
            'email'=>'required|email',
            'password'=>'required'
        ];
        $validate = Validator::make($request->all() , $rules);
        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors(), 'message'=>'Invalid data'],404);
        }
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password , $user->password)){
            return response()->json(['message'=>'The provided data incorrect'],404);
        }
        $success['token'] = $user->createToken($user->name.'Auth-Token')->plainTextToken;
        $success['name']= $user->name;
        return response()->json(['data'=>$success, 'message'=>'Login successfully'],200);
    }
    public function logout(Request $request): JsonResponse
    {
        $user = User::where('id' , $request->user()->id)->first();
        if($user){
            $user->tokens()->delete();
            return response()->json(['message'=>'Logged out successfully'],200);
        }else{
            return response()->json(['message'=>'Not Found'],404);
        }

    }
}
