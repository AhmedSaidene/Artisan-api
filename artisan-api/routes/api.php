<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProduitController;

use App\Http\Controllers\DocumentController;

use App\Http\Controllers\ClientController;

use App\Http\Controllers\EntrepriseController;

use App\Http\Controllers\ModelDevisController;

use App\Http\Controllers\AuthController;

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
Route::post('login', [AuthController::class,'login']);

Route::middleware('auth:api')->group(function () {

Route::resource('clients', ClientController::class);
Route::get('clients/entreprise/{id}', [ClientController::class,'getByEntrepriseId']);
//Route::get('clients/entreprise/{nom}', [ClientController::class,'getByNom']);  
    //on laisse cette route au front,on filtre et on affiche

 Route::resource('produits', ProduitController::class);
 Route::get('produits/cathegorie/{cathegorie_id}', [ProduitController::class,'getByCathegorieId']);
 //les produits de la {cathegorie_id} 

 Route::resource('documents', DocumentController::class);
 //Route::get('documents/entreprise/{id}', [DocumentController::class,'getByEntrepriseId']);
//Route::get('documents/factures/entreprise/{id}', [DocumentController::class,'getFacturesByEntrepriseId']);
//Route::get('documents/devis/entreprise/{id}', [DocumentController::class,'getDevisByEntrepriseId']);

 Route::resource('entreprises', EntrepriseController::class);
 
 Route::resource('model-devis', ModelDevisController::class);
 
});



