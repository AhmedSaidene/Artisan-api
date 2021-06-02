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
            'data' => $user->toArray('nom','prenom', 'role', 'entreprise_id'),
            'token' => $token,
            'logo' => $user->entreprise->logo,
            'entreprise' => $user->entreprise->lib,
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
                'logo' => $user->entreprise->logo,
                'entreprise' => $user->entreprise->lib,
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