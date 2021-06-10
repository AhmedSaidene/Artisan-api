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
       $document = Document::find($id);
 
        if (!$document) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => 
            [
            'doc' => $document,
            'lignes' => $document->groupeLignes
            ]
        ], 200);
    }

    public function showByType($type, $id)
    {//$Categories = Categorie::where('entreprise_id', $id)->get();
       $documents = Document::where('entreprise_id', $id)
                            ->where('type', $type) 
                            ->get();
 
        if (!$documents) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found '
            ], 400);
        }

        $clients = $documents->map(function ($documents) {
            return $documents->clients;
         });
        return response()->json([
            'success' => true,
            'document' => $document,
            'clients' => $clients->toArray(),
        ], 200);
    }
 
    public function store(Request $request)
    {
 
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
        $document->model_devis_id = $request->modelDevis_id;
        //$client->entreprise_id = $request->entreprise_id;
 
        /*if (auth()->user()->produits()->save($produit)) */
        if ($document->save())
            return response()->json([
                'success' => true,
                'id' => $document->id
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
