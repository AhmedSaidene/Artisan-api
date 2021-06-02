<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\type_prestation;

class TypePrestationController extends Controller
{
    public function showByEntrepriseId($id)
    {
        $prestations = type_prestation::where('entreprise_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $prestations
        ]); 
     }
 
    public function show($id)
    {
       $prestation = type_prestation::find($id);
 
        if (!$prestation) {
            return response()->json([
                'success' => false,
                'message' => 'Prestation not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $prestation->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $prestation = new type_prestation();

        $prestation->setTranslation('lib', 'fr', $request->lib);

        $prestation->img = $request->img;
        $prestation->entreprise_id = $request->entreprise_id;

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
       $prestation = type_prestation::find($id);
        if (!$prestation) {
            return response()->json([
                'success' => false,
                'message' => 'Prestation not found'
            ], 400);
        }

        $updated = $request->all();

        $updated = $prestation->fill($updated)->save(); 
 
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
        $prestation = type_prestation::find($id);
 
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
