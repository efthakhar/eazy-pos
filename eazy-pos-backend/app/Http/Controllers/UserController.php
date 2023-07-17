<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserRegistration(Request $request)
    {

        try {

            User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'user_name' => $request->input('user_name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => Hash::make( $request->input('password') ),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User Registration Successfully',
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'status' => 'failed',
                'message' => 'User Registration Failed ! From Back-End',
            ], 400);
        }
    }

    public function UserLogin(Request $request)
    {
        
        if (User::where('email', '=', $request->email)->exists()) {

            $user = User::where('email', '=', $request->email)->first();
    
            if (Hash::check($request->password, $user->password)) {

                $token = JWTToken::CreateToken($request->input('email'));

                return response()->json([
                    'status' => 'success',
                    'message' => 'User Login Successful',
                    'token' => $token,
                ], 200)->cookie('token', $token, 60 * 60 * 24);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Wrong User Credential!',
                'data' => null,
            ], 400);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'No User With That Email Address!',
            'data' => null,
        ], 404);

    }
}
