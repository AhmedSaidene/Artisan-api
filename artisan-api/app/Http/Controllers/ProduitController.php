<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produit;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();

        return response()->json([
            'success' => true,
            'data' => $produits
        ]);
    }
    public function showByCategorieId($id)
    {
        $produits = Produit::where('categorie_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $produits
        ]); 
     }
 
    public function show($id)
    {
       $produit = Produit::find($id);
 
        if (!$produit) {
            return response()->json([
                'success' => false,
                'message' => 'Produit not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $produit->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $produit = new Produit();

        $produit->lib = $request->lib;
        $produit->img = $request->img;
        $produit->fabricant = $request->fabricant;
        $produit->reference = $request->reference;
        $produit->prix_achat = $request->prix_achat;
        $produit->prix_vente = $request->prix_vente;
        $produit->desc = $request->desc;
        $produit->tva = $request->tva;
        $produit->type_prestation_id = $request->type_prestation_id;
        $produit->type_traveux_id = $request->type_traveux_id;
        $produit->entreprise_id = $request->entreprise_id;
        $produit->categorie_id = $request->categorie_id;

 
        /*if (auth()->user()->produits()->save($produit)) */
        if ($produit->save())
            return response()->json([
                'success' => true,
                'data' => $produit->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Produit not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        /*$produit = auth()->user()->produits()->find($id); */
        $produit = Produit::find($id);
        if (!$produit) {
            return response()->json([
                'success' => false,
                'message' => 'Produit not found'
            ], 400);
        }
 
        $updated = $produit->fill($request->all())->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Produit can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        /*$produit = auth()->user()->produits()->find($id); */
        $produit = Produit::find($id);
 
        if (!$produit) {
            return response()->json([
                'success' => false,
                'message' => 'Produit not found'
            ], 400);
        }
 
        if ($produit->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Produit can not be deleted'
            ], 500);
        }
    }
}