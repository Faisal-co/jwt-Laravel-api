<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ApiJwtController extends Controller
{
    // Register Api Needs information(name,email,password,password_confirmation)
    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        User::create($data);
        return response()->json([
            'status' => true,
            'message' => 'User Registered Successfully'
        ]);

    }
    // Login Api Needs information(email,password)
    public function login(Request $request){
        $data = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $token = auth()->attempt($data);
        if($token){
            return response()->json([
                'status' => true,
                'message'=> 'user logged in successfully',
                'token' => $token
            ]);
        }
        else{
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Details'
                ]);
            }
        }


    // Profile Api Needs information(token)
    public function profile(Request $request){
        $userdata = auth()->user(); // user profile Details.
        return response()->json([
            'status' => true,
            'message' => 'User Profile Data',
            'data' => $userdata
        ]);

    }
    // Refresh Api Needs information(token)
    public function refreshToken(){
        $newToken = auth()->refresh();
        return response()->json([
            'status' => true,
            'message' => 'Refresh Token Generated Successfully',
            'new_Token' => $newToken
        ]);

    }
    // Logout Api Needs information(token)
    public function logout(){
        auth()->logout();
        return response()->json([
            'status' => true,
            'message' => 'User Logged Out Successfully'
        ]);


    }
}