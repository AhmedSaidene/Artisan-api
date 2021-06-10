<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return response()->json([
            'success' => true,
            'data' => $clients
        ]);
    }

    public function showByEntrepriseId($id)
    {
        $clients = Client::where('entreprise_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $clients
        ]);
    }
 
    public function show($id)
    {
       $client = Client::find($id);
 
        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Client not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $client->toArray()
        ], 200);
    }
    public function showForDocument($id)
    {
       $client = Client::find($id);
 
        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Client not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' =>  [
                'nom' => $client->nom,
                'adresse' => $client->adresse,
                'cp' => $client->cp,
                'tel' => $client->tel,
            ]
        ], 200);
    }

    public function showByName($nom, $id)
    {
        $clients = Client::where('nom', $nom)
                              ->where('entreprise_id', $id)
                              ->get();
        if (!$clients) {
            return response()->json([
                'success' => false
            ]);
        } else {
            $documents = $clients->map(function ($client) {
               return $client->documents;
            });
         return response()->json([
             'success' => true,
            // 'documents' => $documents,//->collapse(),
             'clients' => $clients
         ]);
        }
    }

    public function checkClientByEmail($email)
    {
        $client = Client::where('email', $email)->get();

        if (count($client) == 0) {
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
 
    public function store(Request $request)
    {
        $client = new Client();

        $client->nom = $request->nom;
        $client->email = $request->email;
        $client->adresse = $request->adr;
        $client->cp = $request->cp;
        $client->ville = $request->ville;
        $client->tel = $request->tel;
        $client->type = $request->type;
        $client->entreprise_id = $request->entrepriseId;
 
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
        $client = Client::find($id);
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
        $client = Client::find($id);
 
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
