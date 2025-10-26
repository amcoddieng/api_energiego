<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommandeController extends Controller
{
    public function index() { return response()->json(Commande::all()); }
    public function show(Commande $commande) { return response()->json($commande); }
    public function store(Request $request) {
        $data = $request->validate([
            'id_paiement' => 'required|integer|exists:Paiement,id_paiement',
            'id_utilisateur' => 'required|integer|exists:Client,id_utilisateur',
            'dateCommande' => 'required|date',
            'statut' => 'required|string|max:254',
            'total' => 'required|numeric',
        ]);
        $model = Commande::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    public function update(Request $request, Commande $commande) {
        $data = $request->validate([
            'id_paiement' => 'sometimes|required|integer|exists:Paiement,id_paiement',
            'id_utilisateur' => 'sometimes|required|integer|exists:Client,id_utilisateur',
            'dateCommande' => 'sometimes|required|date',
            'statut' => 'sometimes|required|string|max:254',
            'total' => 'sometimes|required|numeric',
        ]);
        $commande->update($data);
        return response()->json($commande);
    }
    public function destroy(Commande $commande) { $commande->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
