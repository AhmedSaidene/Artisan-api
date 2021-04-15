<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        /* $produits = auth()->user()->produis; */
        $clients = Client::all();

        return response()->json([
            'success' => true,
            'data' => $clients
        ]);
    }

    public function getByEntrepriseId($id)
    {
        $clients = Client::where('entrprise_id', $id)->get();
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
        ], 400);
    }
 
    public function store(Request $request)
    {
        $client = new Client();

        $client->nom = $request->nom;
        $client->email = $request->email;
        $client->adresse = $request->adresse;
        $client->cp = $request->cp;
        $client->ville = $request->ville;
        $client->tel = $request->tel;
        $client->typeClient_id = $request->typeClient_id;
        $client->entrprise_id = $request->entrprise_id;
 
        /*if (auth()->user()->produits()->save($produit)) */
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
        /*$produit = auth()->user()->produits()->find($id); */
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
        /*$produit = auth()->user()->produits()->find($id); */
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
