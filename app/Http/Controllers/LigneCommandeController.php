<?php

namespace App\Http\Controllers;

use App\Models\LigneCommande;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LigneCommandeController extends Controller
{
    public function index() { return response()->json(LigneCommande::all()); }
    public function show(LigneCommande $ligneCommande) { return response()->json($ligneCommande); }
    public function store(Request $request) {
        $data = $request->validate([
            'id_produit' => 'required|integer|exists:Produit,id_produit',
            'id_commande' => 'required|integer|exists:Commande,id_commande',
            'quantite' => 'required|integer',
            'sousTotal' => 'required|numeric',
        ]);
        $model = LigneCommande::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    public function update(Request $request, LigneCommande $ligneCommande) {
        $data = $request->validate([
            'id_produit' => 'sometimes|required|integer|exists:Produit,id_produit',
            'id_commande' => 'sometimes|required|integer|exists:Commande,id_commande',
            'quantite' => 'sometimes|required|integer',
            'sousTotal' => 'sometimes|required|numeric',
        ]);
        $ligneCommande->update($data);
        return response()->json($ligneCommande);
    }
    public function destroy(LigneCommande $ligneCommande) { $ligneCommande->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
