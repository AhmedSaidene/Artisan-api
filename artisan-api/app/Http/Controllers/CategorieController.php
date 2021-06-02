<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categorie;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    public function showByEntrepriseId($id)
    {
        $Categories = Categorie::where('entreprise_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $Categories
        ]);
    }
 
    public function show($id)
    {
       $categorie = Categorie::find($id);
 
        if (!$categorie) {
            return response()->json([
                'success' => false,
                'message' => 'Categorie not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $categorie->toArray()
        ], 200);
    }
    public function showByLib($lib, $id)
    {
        $categorie = Categorie::where('lib', $lib)
                              ->where('entreprise_id', $id)
                              ->first();
        if (!$categorie) {
            return response()->json([
                'success' => false
            ]);
        } else {
         return response()->json([
             'success' => true,
             'data' => $categorie->produits
         ]);
        }
    }

    public function store(Request $request)
    {
        $categorie = new Categorie();

        $categorie->img = $request->img;
        $categorie->lib = $request->lib;
        $categorie->entreprise_id = $request->entreprise_id;
 
        if ($categorie->save())
            return response()->json([
                'success' => true,
                'data' => $categorie->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Categorie not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return response()->json([
                'success' => false,
                'message' => 'Categorie not found'
            ], 400);
        }
 
        $updated = $categorie->fill($request->all())->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Categorie can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        /*$produit = auth()->user()->produits()->find($id); */
        $categorie = Categorie::find($id);
 
        if (!$categorie) {
            return response()->json([
                'success' => false,
                'message' => 'Categorie not found'
            ], 400);
        }
 
        if ($categorie->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Categorie can not be deleted'
            ], 500);
        }
    }
}


