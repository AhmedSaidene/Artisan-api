<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ModelDevis;

class ModelDevisController extends Controller
{
    public function index()
    {
        $models = ModelDevis::all();

        return response()->json([
            'success' => true,
            'data' => $models
        ]);
    }
    public function showByEntrepriseId($id)
    {
        $modelDevis = ModelDevis::where('entreprise_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $modelDevis
        ]);
    }
 
    public function show($id)
    {
       $model = ModelDevis::find($id);
 
        if (!$model) {
            return response()->json([
                'success' => false,
                'message' => 'Model not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $model->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $model = new ModelDevis();

        $model->IBAN = $request->iban;
        $model->entreprise_id = $request->entrepriseId;

        $model->cgv = $request->cgv;
        $model->piedPage = $request->piedPage;
        $model->header = $request->header;
        $model->lib = $request->lib;
       
 
        if ($model->save())
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        /*$produit = auth()->user()->produits()->find($id); */
        $model = ModelDevis::find($id);
        if (!$model) {
            return response()->json([
                'success' => false,
                'message' => 'model not found'
            ], 400);
        }
 
        $updated = $model->fill($request->all())->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'model can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        /*$produit = auth()->user()->produits()->find($id); */
        $model = ModelDevis::find($id);
 
        if (!$model) {
            return response()->json([
                'success' => false,
                'message' => 'Model not found'
            ], 400);
        }
 
        if ($model->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Model can not be deleted'
            ], 500);
        }
    }
}

