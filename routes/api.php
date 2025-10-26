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

// Public read, admin write
Route::apiResource('categories', \App\Http\Controllers\CategorieController::class)->only(['index','show']);
Route::apiResource('marques', \App\Http\Controllers\MarqueController::class)->only(['index','show']);
Route::apiResource('promotions', \App\Http\Controllers\PromotionController::class)->only(['index','show']);
Route::apiResource('produits', \App\Http\Controllers\ProduitController::class)->only(['index','show']);

Route::middleware(['auth:sanctum','role:admin'])->group(function () {
    Route::apiResource('categories', \App\Http\Controllers\CategorieController::class)->only(['store','update','destroy']);
    Route::apiResource('marques', \App\Http\Controllers\MarqueController::class)->only(['store','update','destroy']);
    Route::apiResource('promotions', \App\Http\Controllers\PromotionController::class)->only(['store','update','destroy']);
    Route::apiResource('produits', \App\Http\Controllers\ProduitController::class)->only(['store','update','destroy']);
});

// Client/Admin authenticated actions
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('paiements', \App\Http\Controllers\PaiementController::class)->only(['store']);
    Route::apiResource('commandes', \App\Http\Controllers\CommandeController::class)->only(['store','update','destroy']);
    Route::apiResource('lignes-commande', \App\Http\Controllers\LigneCommandeController::class)
        ->only(['store','update','destroy'])
        ->parameters(['lignes-commande' => 'ligneCommande']);
    Route::apiResource('avis', \App\Http\Controllers\AvisController::class)->only(['store','update','destroy']);
});

// Public reads for non-admin
Route::apiResource('paiements', \App\Http\Controllers\PaiementController::class)->only([]);
Route::apiResource('commandes', \App\Http\Controllers\CommandeController::class)->only(['index','show']);
Route::apiResource('lignes-commande', \App\Http\Controllers\LigneCommandeController::class)
    ->only(['index','show'])
    ->parameters(['lignes-commande' => 'ligneCommande']);
Route::apiResource('avis', \App\Http\Controllers\AvisController::class)->only(['index','show']);

// Auth routes (Sanctum)
Route::prefix('auth')->group(function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('admin/login', [\App\Http\Controllers\AuthController::class, 'adminLogin']);
    Route::post('user/login', [\App\Http\Controllers\AuthController::class, 'userLogin']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
        Route::get('me', [\App\Http\Controllers\AuthController::class, 'me']);
    });
});