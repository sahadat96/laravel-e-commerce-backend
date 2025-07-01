<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $token = auth('api')->attempt([
             'email' => $request->email,
             'password' => $request->password
        ]);

        if (!$token) { 
           $user = User::where('email', $request->email)->first();
            if(!$user){
                 return response()->json([
                    'status' => false, 
                     'errors' => [
                         'email' => ['Email is in correct']
                     ]
                 ], 401);
            }

            return response()->json([
                  'status' => false,
                   'errors' => [
                    'password' => ['Password is incorrect']
                   ]
            ], 401);

        } else {
          $user = auth('api')->user();
          $data = [
             'user' =>  $user->name,
             'status' => true,
             'message' => "User logged in",
             'token' => $token,
             'expires_in' => auth('api')->factory()->getTTL() * 60
          ];
         return response()->json(['info' => $data]);
        }

    }
     public function registration(Request $request){

        // Validation
        $request->validate([
            "name" => "required|string",
            "email" => "required|string|email|unique:users",
            "password" => "required|confirmed" // password_confirmation
        ]);

        // User model to save user in database
             $registration = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "address" => $request->address,
                "phone" => $request->phone,
                "password" => Hash::make($request->password)
            ]);
          
           if($registration){
               return response()->json([
                "status" => true,
                "message" => "User registration successfully ",
              ]);
            } else {
                return response()->json([
                    "status" => false,
                    "errors" => "User registration not successfully",
                ]);
            }
    }

    public function logout(){

        auth('api')->logout();
    
        return response()->json([
            "status" => true,
            "message" => "User logged out",
        ]);
                                                            
    }

    // Get authenticate user

    public function getAuthUser(){
        $user = auth('api')->user();
    
        $get_user = User::select(['name', 'phone', 'email', 'address'])
            ->where('id', $user->id)
            ->first();

            return response()->json([
                "status" => true,
                'get_user' => $get_user
            ]);
    }

    
    
}
