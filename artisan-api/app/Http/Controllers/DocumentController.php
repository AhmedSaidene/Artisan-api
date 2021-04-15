<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        /* $produits = auth()->user()->produis; */
        $documents = Document::all();

        return response()->json([
            'success' => true,
            'data' => $documents
        ]);
    }
 
    public function show($id)
    {
       /* $produit = auth()->user()->produits()->find($id); */
       $document = Document::find($id);
 
        if (!$document) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $document->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {/*
        $this->validate($request, [
           
        ]);*/
 
        $document = new Document();

        $document->type = $request->type;
        $document->IBAN = $request->IBAN;
        $document->SWIFT_BIC = $request->SWIFT_BIC;
        $document->tva = $request->tva;
        $document->total_HT = $request->total_HT;
        $document->total_TVA = $request->total_TVA;
        $document->total_TTC = $request->total_TTC;
        $document->statut = $request->statut;
        $document->cgv = $request->cgv;
        $document->piedPage = $request->piedPage;
        $document->client_id = $request->client_id;
        $document->intervention_id = $request->intervention_id;
        $document->type_traveaux_id = $request->type_traveaux_id;
        $document->type_prestation_id = $request->type_prestation_id;
        $document->model_devis_id = $request->model_devis_id;
 
        /*if (auth()->user()->produits()->save($produit)) */
        if ($document->save())
            return response()->json([
                'success' => true,
                'data' => $document->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'document not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        /*$produit = auth()->user()->produits()->find($id); */
        $document = document::find($id);
        if (!$document) {
            return response()->json([
                'success' => false,
                'message' => 'document not found'
            ], 400);
        }
 
        $updated = $document->fill($request->all())->save(); 
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'document can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        /*$produit = auth()->user()->produits()->find($id); */
        $document = Document::find($id);
 
        if (!$document) {
            return response()->json([
                'success' => false,
                'message' => 'document not found'
            ], 400);
        }
 
        if ($document->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'document can not be deleted'
            ], 500);
        }
    }
}
