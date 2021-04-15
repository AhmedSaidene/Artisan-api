<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Entreprise;

class EntrepriseController extends Controller
{
    public function index()
    {
        /* $produits = auth()->user()->produis; */
        $entreprises = Entreprise::all();

        return response()->json([
            'success' => true,
            'data' => $entreprises
        ]);
    }
 
    public function show($id)
    {
       /* $produit = auth()->user()->produits()->find($id); */
       $entreprise = Entreprise::find($id);
 
        if (!$entreprise) {
            return response()->json([
                'success' => false,
                'message' => 'Entreprise not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $entreprise->toArray()
        ], 400);
    }

    public function store(Request $request)
    {/*
        $this->validate($request->all(), [
           
        ]);*/
 
        $entreprise = new Entreprise();

        $entreprise->lib = $request->lib;
        $entreprise->email = $request->email;
        $entreprise->adresse = $request->adresse;
        $entreprise->tel = $request->tel;
        $entreprise->logo = $request->logo;
        $entreprise->entreprise_id = $request->entreprise_id;
 
        /*if (auth()->user()->produits()->save($produit)) */
        if ($entreprise->save())
            return response()->json([
                'success' => true,
                'data' => $entreprise->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'entreprise not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        /*$produit = auth()->user()->produits()->find($id); */
        $entreprise = entreprise::find($id);
        if (!$entreprise) {
            return response()->json([
                'success' => false,
                'message' => 'entreprise not found'
            ], 400);
        }
 
        $updated = $entreprise->fill($request->all())->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Entreprise can not be updated'
            ], 500);
    }
    
    public function destroy($id)
    {
        /*$produit = auth()->user()->produits()->find($id); */
        $entreprise = Entreprise::find($id);
 
        if (!$entreprise) {
            return response()->json([
                'success' => false,
                'message' => 'Entreprise not found'
            ], 400);
        }
 
        if ($entreprise->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Entreprise can not be deleted'
            ], 500);
        }
    }
}
