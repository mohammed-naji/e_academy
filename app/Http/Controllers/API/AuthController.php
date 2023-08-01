<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if($user) {

            //check password
            if (Hash::check($request->password, $user->password)) {

                $token = $user->createToken('login');

                return ['token' => $token->plainTextToken];

            }else {
                return response(['message' => "Invalid credentials"], 401);
            }

        }else {
            return response(['message' => "Invalid credentials"], 401);
        }


    }
}
