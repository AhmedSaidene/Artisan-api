<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypePrestationController extends Controller
{
    public function getByEntrepriseId($entreprise_id)
    {
        $prestations = Prestation::where('entreprise_id', $entreprise_id)->get();
        return response()->json([
            'success' => true,
            'data' => $prestations
        ]); 
     }
 
    public function show($id)
    {
       $prestation = Prestation::find($id);
 
        if (!$prestation) {
            return response()->json([
                'success' => false,
                'message' => 'Prestation not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $prestation->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $prestation = new Prestation();

        $prestation->img = $request->img;
        $prestation->lib = $request->lib;
        $prestation->entreprise_id = $request->entreprise_id;

 
        /*if (auth()->user()->produits()->save($produit)) */
        if ($prestation->save())
            return response()->json([
                'success' => true,
                'data' => $prestation->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Prestation not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
       $prestation = Prestation::find($id);
        if (!$prestation) {
            return response()->json([
                'success' => false,
                'message' => 'Prestation not found'
            ], 400);
        }
 
        $updated = $prestation->fill($request->all())->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Prestation can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $prestation = Prestation::find($id);
 
        if (!$prestation) {
            return response()->json([
                'success' => false,
                'message' => 'Prestation not found'
            ], 400);
        }
 
        if ($prestation->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Prestation can not be deleted'
            ], 500);
        }
    }
}
