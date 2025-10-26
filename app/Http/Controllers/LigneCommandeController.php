<?php

namespace App\Http\Controllers;

use App\Models\LigneCommande;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LigneCommandeController extends Controller
{
    /**
     * @OA\Get(path="/api/lignes-commande", summary="Lister les lignes de commande",
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/LigneCommande"))
     *   )
     * )
     */
    public function index() { return response()->json(LigneCommande::all()); }
    /**
     * @OA\Get(path="/api/lignes-commande/{id}", summary="Afficher une ligne de commande",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/LigneCommande"))
     * )
     */
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
    /**
     * @OA\Post(path="/api/lignes-commande", summary="Créer une ligne de commande",
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/LigneCommande")),
     *   @OA\Response(response=201, description="Créé", @OA\JsonContent(ref="#/components/schemas/LigneCommande"))
     * )
     */
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
    /**
     * @OA\Put(path="/api/lignes-commande/{id}", summary="Mettre à jour une ligne de commande",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/LigneCommande")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/LigneCommande"))
     * )
     * @OA\Delete(path="/api/lignes-commande/{id}", summary="Supprimer une ligne de commande",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=204, description="Supprimé")
     * )
     */
    public function destroy(LigneCommande $ligneCommande) { $ligneCommande->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
