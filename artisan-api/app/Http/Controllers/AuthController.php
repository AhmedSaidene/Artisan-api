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
         $user = User::where('email', $request->email)->get();
          if (count($user) !== 0) {
        return response()->json([
            'success' => false,
            'message' => 'Email donné déja existe'
        ]);
        }
         
          $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $token = $user->createToken('key')->accessToken;
            
    return response()->json([
           'success' => true,
           'token' => $token,
           'id' => $user->id,
           'entreprise_id' => $user->entreprise->id,
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
                'id' => $user->id,
                'entreprise_id' => $user->entreprise->id,
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