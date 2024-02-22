<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ApiUserController extends Controller
{
    public function register (Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);

        User::create($data);

        return response()->json([
            'status' => true,
            'message' => "User created successfully"
        ]);
    }

    public function login (Request $request)
    {
       $user = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
       ]);

       if(Auth::attempt(['email' => $user['email'], 'password' => $user['password']])){
            $user = auth()->user();
            $token = $user->createToken('loginToken')->accessToken;

            return response()->json([
                "status" => true,
                "message" => "User logged in",
                "token" => $token
            ], 200);
       } 
       
        return response()->json([
            'status' => false,
            "message" => "Invalid Credentials"
        ]);
    } 

    public function profile ()
    {
        $user = AUth::user();

        return response()->json([
            "status" => true,
            "message" => "Profile Information",
            "data" => $user,
        ], 200);
    }

    public function logout()
    {
       auth()->user()->token()->revoke();

       return response()->json([
            'status' => true,
            "message" => "User logged out"
        ]);

    }
}
