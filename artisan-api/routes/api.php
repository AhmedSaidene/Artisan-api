<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GroupeLigneDocController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ModelDevisController;
use App\Http\Controllers\TypePrestationController;
use App\Http\Controllers\TypeTraveauxController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\DevisHasProduitController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::get('admin/email/{email}', [AuthController::class,'checkAdminByEmail']);
//l'hors de sa création, l'entreprise doit avoir un email unique 
Route::get('entreprise/email/{email}', [AuthController::class,'EntrepriseController']);
   
Route::post('login', [AuthController::class,'login']);

Route::post('entreprise', [EntrepriseController::class,'store']);

Route::post('model-devis', [ModelDevisController::class,'store']);


Route::middleware('auth:api')->group(function () {
    
    Route::resource('user', UserController::class);
    Route::get('user/entreprise/{id}', [UserController::class,'showByEntrepriseId']);

    Route::resource('clients', ClientController::class);
    Route::get('clients/entreprise/{id}', [ClientController::class,'showByEntrepriseId']);
    Route::get('clients/email/{email}', [ClientController::class,'checkClientByEmail']);
   //pour la recherche des client et des documents par le nom du client
   //get le client qui a un nom {nom} et qui appartient à l'entreprise d'id {id} 
   //et ces documents qui a un nom {nom} et qui appartient à l'entreprise d'id {id} 
    Route::get('clients/nom/{nom}/{id}', [ClientController::class,'showByName']);
  
   Route::resource('categories', CategorieController::class);
   Route::get('categories/entreprise/{id}', [CategorieController::class,'showByEntrepriseId']);
   //get les categiries de lib {lib} de l'entreprise {id}
   Route::get('categories/produits/{lib}/{id}', [CategorieController::class,'showByLib']);
   
    Route::resource('produits', ProduitController::class);
    //get les produits de la categorie d'id {id}
    Route::get('produits/categorie/{id}', [ProduitController::class,'showByCategorieId']);
   
    Route::resource('prestations', TypePrestationController::class);
    Route::get('prestations/entreprise/{id}', [TypePrestationController::class,'showByEntrepriseId']);
   
    Route::resource('interventions', InterventionController::class);
    Route::get('interventions/entreprise/{id}', [InterventionController::class,'showByEntrepriseId']);
    Route::get('interventions/entreprise/favourite/{id}', [InterventionController::class,'showfavourite']);
    Route::get('interventions/entreprise/add/{id}', [InterventionController::class,'add']);
   
    Route::resource('traveaux', TypeTraveauxController::class);
    Route::get('traveaux/entreprise/{id}', [TypeTraveauxController::class,'showByEntrepriseId']);
    Route::get('traveaux/entreprise/favourite/{id}', [TypeTraveauxController::class,'showfavourite']);
    Route::get('traveaux/entreprise/add/{id}', [TypeTraveauxController::class,'add']);
    
//Route::resource('entreprises', EntrepriseController::class);
   //............................. Route::get('entreprise/entreprise/{id}', [EntrepriseController::class, 'showByEntrepriseId']);
    Route::get('entreprise/{id}', [EntrepriseController::class, 'show']);
    Route::put('entreprise/{id}', [EntrepriseController::class, 'update']);
    Route::delete('entreprise/{id}', [EntrepriseController::class, 'destroy']);
//get les documents devis de l'entreprise {id}
    Route::get('devis/{id}', [EntrepriseController::class, 'showDevis']);
//get les documents factures de l'entreprise {id}
Route::get('factures/{id}', [EntrepriseController::class, 'showFactures']);


 //Route::resource('model-devis', ModelDevisController::class);
    Route::get('model-devis/entreprise/{id}', [ModelDevisController::class, 'showByEntrepriseId']);
    Route::get('model-devis/{id}', [ModelDevisController::class, 'show']);
    Route::put('model-devis/{id}', [ModelDevisController::class, 'update']);
    Route::delete('model-devis/{id}', [ModelDevisController::class, 'destroy']);
    
 Route::resource('documents', DocumentController::class);

 Route::resource('groupe-lignes', GroupeLigneDocController::class);
 //get le grpupe des lignes du document d'id {id}
 Route::get('groupe-lignes/document/{id}', [GroupeLigneDocController::class, 'showByDocumentId']);

 Route::resource('devis-produits', DevisHasProduitController::class);

 
});


