<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
        public function register(Request $request)
        {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $token = $user->createToken('key')->accessToken;
            
        return response()->json([
            'success' => true,
            'data' => $user->toArray(),
            'token' => $token
        ]);

        }
    
        public function login(Request $request)
        {
    
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password ]))
            {
              $user = Auth::user();
              $token = $user->createToken('key')->accessToken;

              return response()->json([
                'success' => true,
                'data' => $user->toArray(),
                'token' => $token
              ],200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Non authorisé'
                ],401);
            }
        }    
    
}