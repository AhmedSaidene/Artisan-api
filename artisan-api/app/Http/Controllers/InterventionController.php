<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervention;

class InterventionController extends Controller
{
    public function showByEntrepriseId($id)
    {
        $interventions = Intervention::where('entreprise_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $interventions
        ]); 
     }
     public function showfavourite($id)
     {
         $interventions = Intervention::where('entreprise_id', $id)
                                        ->where('type','favourite')->get();
         return response()->json([
             'success' => true,
             'data' => $interventions
         ]); 
      }
      public function add($id)
      {
          $interventions = Intervention::where('entreprise_id', $id)
                                        ->where('type',null)->get();
          return response()->json([
              'success' => true,
              'data' => $interventions
          ]); 
       }
 
    public function show($id)
    {
       $intervention = Intervention::find($id);
 
        if (!$intervention) {
            return response()->json([
                'success' => false,
                'message' => 'Intervention not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $intervention->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $intervention = new Intervention();

        $intervention->setTranslation('lib', 'fr', $request->lib);
        $intervention->img = $request->img;
        $intervention->entreprise_id = $request->entreprise_id;

        if ($intervention->save())
            return response()->json([
                'success' => true,
                'data' => $intervention->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'intervention not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
       $intervention = Intervention::find($id);
        if (!$intervention) {
            return response()->json([
                'success' => false,
                'message' => 'intervention not found'
            ], 400);
        }
 
        $updated = $intervention->fill($request->all())->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'intervention can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $intervention = Intervention::find($id);
 
        if (!$intervention) {
            return response()->json([
                'success' => false,
                'message' => 'intervention not found'
            ], 400);
        }
 
        if ($intervention->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'intervention can not be deleted'
            ], 500);
        }
    }
}