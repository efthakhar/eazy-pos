<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserRegistration(Request $request)
    {

        try {

            User::create([
                'first_name' => $request->input('first_naame'),
                'last_name' => $request->input('last_naame'),
                'user_name' => $request->input('user_naame'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
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
}
