<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $validator = validator([
            'name' => 'required',
            'email' =>'required|email',
            'password' => 'required|confirmed',
        ]);

        if($validator->failed()){

            return response()->json([
                'status' => 0,
                'massage' => $validator->errors(),
            ]);
        }else{

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make( $request->password);
            $user->save();

            $token = $user->createToken($request->name)->plainTextToken;

            return response([
                'user' =>$user,
                'token' => $token

            ], 200);
        }
    }

    public function logout(Request $request)
    {
        // auth()->user()->tokens()->delete();
        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'user logged out',
            'status' => 200,
        ];

    }

    public function login(Request $request){

        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $data['email'])->first();

        if(!$user || !Hash::check($data['password'], $user->password)){
            return response([
                'message' => 'You are not Register User.',
            ],0);
        }

        $token = $user->createToken('loginToken')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ],200);
    }

}
