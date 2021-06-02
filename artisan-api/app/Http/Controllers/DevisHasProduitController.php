<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Devis_has_produit;

class DevisHasProduitController extends Controller
{
    
    public function show($id)
    {
       $ligne = Devis_has_produit::find($id);
 
        if (!$ligne) {
            return response()->json([
                'success' => false,
                'message' => 'Ligne not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $ligne->toArray()
        ], 400);
    }

    public function store(Request $request)
    {/*
        $this->validate($request->all(), [
           
        ]);*/
 
        $ligne = new Devis_has_produit();
        $ligne->produits_id = $request->produits_id;
        $ligne->prix_par_achat = $request->prix_par_achat;
        $ligne->prix_par_vente_unitaire = $request->prix_par_vente_unitaire;
        $ligne->prix_par_total_HT = $request->prix_par_total_HT;
        $ligne->quantite = $request->quantite;
        $ligne->tva = $request->tva;
        $ligne->reference = $request->reference;
        $ligne->description = $request->description;
 
        if ($ligne->save())
            return response()->json([
                'success' => true,
                'data' => $ligne->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'ligne not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        /*$produit = auth()->user()->produits()->find($id); */
        $ligne = Devis_has_produit::find($id);
        if (!$ligne) {
            return response()->json([
                'success' => false,
                'message' => 'ligne not found'
            ], 400);
        }
 
        $updated = $ligne->fill($request->all())->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'ligne can not be updated'
            ], 500);
    }
    
    public function destroy($id)
    {
        $ligne = Devis_has_produit::find($id);
 
        if (!$entreprise) {
            return response()->json([
                'success' => false,
                'message' => 'ligne not found'
            ], 400);
        }
 
        if ($ligne->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ligne can not be deleted'
            ], 500);
        }
    }
}
