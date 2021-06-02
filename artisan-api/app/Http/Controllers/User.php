<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class User extends Controller
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
        $user = new User();
/*   $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        
    return response()->json([
        'success' => true
    ]);
 */
$input = $request->all();
$input['password'] = Hash::make($input['password']);
$user = User::create($input);

return response()->json([
'success' => true
]);
 
        if ($client->save())
            return response()->json([
                'success' => true,
                'data' => $client->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Client not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $client = User::find($id);
        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Client not found'
            ], 400);
        }
 
        $updated = $client->fill($request->all())->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Client can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $client = User::find($id);
 
        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Client not found'
            ], 400);
        }
 
        if ($client->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Client can not be deleted'
            ], 500);
        }
    }
}

