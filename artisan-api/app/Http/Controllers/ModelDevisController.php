<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ModelDevis;

class ModelDevisController extends Controller
{
    public function index()
    {
        /* $produits = auth()->user()->produis; */
        $models = ModelDevis::all();

        return response()->json([
            'success' => true,
            'data' => $models
        ]);
    }
 
    public function show($id)
    {
       /* $produit = auth()->user()->produits()->find($id); */
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
    {/*
        $this->validate($request, [
           
        ]);*/
 
        $model = new ModelDevis();

        $model->cgv = $request->cgv;
        $model->piedPage = $request->piedPage;
        $model->header = $request->header;
        $model->IBAN = $request->IBAN;
        $model->lib = $request->lib;
        $model->entreprise_id = $request->entreprise_id;
 
        /*if (auth()->user()->produits()->save($produit)) */
        if ($model->save())
            return response()->json([
                'success' => true,
                'data' => $model->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'model not added'
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

