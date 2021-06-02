<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Groupe_ligne_doc;

class GroupeLigneDocController extends Controller
{

    public function showByDocumentId($id)
    {
        $groupe = Groupe_ligne_doc::where('document_id', $id)->pluck('id');
        return response()->json([
            'success' => true,
            'data' => $groupe
        ]);
    }
 
    public function show($id)
    {
       $groupe = Groupe_ligne_doc::find($id);
 
        if (!$groupe) {
            return response()->json([
                'success' => false,
                'message' => 'groupe not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $groupe->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $groupe = new Groupe_ligne_doc();

        $groupe->document_id = $request->documentId;
       
        if ($groupe->save())
            return response()->json([
                'success' => true,
                'data' => $groupe->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'groupe not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $groupe = Groupe_ligne_doc::find($id);
        if (!$groupe) {
            return response()->json([
                'success' => false,
                'message' => 'groupe not found'
            ], 400);
        }
 
        $updated = $groupe->fill($request->all())->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'groupe can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $groupe = Groupe_ligne_doc::find($id);
 
        if (!$groupe) {
            return response()->json([
                'success' => false,
                'message' => 'groupe not found'
            ], 400);
        }
 
        if ($groupe->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'groupe can not be deleted'
            ], 500);
        }
    }
}
