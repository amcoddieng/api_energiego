<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/',function(){
    return 'dddd';
});
// API resources
Route::apiResource('utilisateurs', \App\Http\Controllers\UtilisateurController::class);
Route::apiResource('categories', \App\Http\Controllers\CategorieController::class);
Route::apiResource('marques', \App\Http\Controllers\MarqueController::class);
Route::apiResource('promotions', \App\Http\Controllers\PromotionController::class);
Route::apiResource('paiements', \App\Http\Controllers\PaiementController::class);
Route::apiResource('produits', \App\Http\Controllers\ProduitController::class);
Route::apiResource('clients', \App\Http\Controllers\ClientController::class);
Route::apiResource('administrateurs', \App\Http\Controllers\AdministrateurController::class);
Route::apiResource('commandes', \App\Http\Controllers\CommandeController::class);
Route::apiResource('lignes-commande', \App\Http\Controllers\LigneCommandeController::class);
Route::apiResource('avis', \App\Http\Controllers\AvisController::class);