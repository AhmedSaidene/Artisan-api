<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function checkUserByEmail($email)
    {
        $user = User::where('email', $email)->get();
        if (count($user) == 0) {
            return response()->json([
                'exist' => false
            ]);
        }
        else {
            return response()->json([
                'exist' => true
            ]);
        }
    }
    public function showByEntrepriseId($id)
    {
        $users = User::where('entreprise_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }
    
    public function show($id)
    {
       $user = User::find($id);
 
        return response()->json([
            'success' => true,
            'user' => $user
        ], 200);
    }
        
    public function store(Request $request)
    {
        $existe = User::where('email', $request->email)->get();

        if (count($existe) == 0) {
            $user = new User();

            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->password = $request->password;
            $user['password'] = Hash::make($user['password']);
            $user->tel = $request->tel;
            $user->role = $request->role;
            $user->entreprise_id = $request->entrepriseId;
    
                    if ($user->save())
                        return response()->json([
                            'success' => true
                        ]);
                    else
                        return response()->json([
                            'success' => false,
                            'message' => "Utilisateur n'est pas ajouté"
                        ], 500);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Un utilisateur avec cet emil existe déja'
            ]);
        }
    }
 
    public function update(Request $request, $id)
    {
        $existe = User::where('email', $request->email)->get();

        if (count($existe) == 0 || $existe->first()->id == $id) {

        $client = User::find($id);
        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé',
               
            ], 400);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $updated = $client->fill($input)->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur ne peut pas etre modifié',
                'dd' => $existe->first()->id
            ], 500);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Un utilisateur avec cet emil existe déja'
            ]);
        }
    }
 
    public function destroy($id)
    {
        $client = User::find($id);
 
        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé'
            ], 400);
        }
 
        if ($client->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur ne peut pas etre supprimé'
            ], 500);
        }
    }
}

