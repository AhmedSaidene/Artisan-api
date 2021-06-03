<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type_traveaux;

class TypeTraveauxController extends Controller
{
    public function showByEntrepriseId($entreprise_id)
    {
        $Traveaux = Type_traveaux::where('entreprise_id', $entreprise_id)->get();
        return response()->json([
            'success' => true,
            'data' => $Traveaux
        ]); 
     }
     public function showfavourite($id)
     {
         $Traveaux = Type_traveaux::where('entreprise_id', $id)
                                    ->where('type','favourite')->get();
         return response()->json([
             'success' => true,
             'data' => $Traveaux
         ]); 
      }
      public function add($id)
      {
          $Traveaux = Type_traveaux::where('entreprise_id', $id)
                                        ->where('type',null)->get();
          return response()->json([
              'success' => true,
              'data' => $Traveaux
          ]); 
       }
 
    public function show($id)
    {
       $type_traveaux = Type_traveaux::find($id);
 
        if (!$type_traveaux) {
            return response()->json([
                'success' => false,
                'message' => 'Type de traveaux not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $type_traveaux->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $type_traveaux = new Type_traveaux();

        $type_traveaux->setTranslation('lib', 'fr', $request->lib);
        $type_traveaux->img = $request->img;
        $type_traveaux->entreprise_id = $request->entreprise_id;

        if ($type_traveaux->save())
            return response()->json([
                'success' => true,
                'data' => $type_traveaux->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Type de traveaux not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
       $type_traveaux = Type_traveaux::find($id);
        if (!$type_traveaux) {
            return response()->json([
                'success' => false,
                'message' => 'Type de traveaux not found'
            ], 400);
        }
 
        $updated = $type_traveaux->fill($request->all())->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Type de traveaux can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $type_traveaux = Type_traveaux::find($id);
 
        if (!$type_traveaux) {
            return response()->json([
                'success' => false,
                'message' => 'Type de traveaux not found'
            ], 400);
        }
 
        if ($type_traveaux->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Type de traveaux can not be deleted'
            ], 500);
        }
    }
}

