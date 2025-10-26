<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommandeController extends Controller
{
    /**
     * @OA\Get(path="/api/commandes", summary="Lister les commandes",
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Commande"))
     *   )
     * )
     */
    public function index() { return response()->json(Commande::all()); }
    /**
     * @OA\Get(path="/api/commandes/{id}", summary="Afficher une commande",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Commande"))
     * )
     */
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
    /**
     * @OA\Post(path="/api/commandes", summary="Créer une commande",
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Commande")),
     *   @OA\Response(response=201, description="Créé", @OA\JsonContent(ref="#/components/schemas/Commande"))
     * )
     */
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
    /**
     * @OA\Put(path="/api/commandes/{id}", summary="Mettre à jour une commande",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Commande")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Commande"))
     * )
     * @OA\Delete(path="/api/commandes/{id}", summary="Supprimer une commande",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=204, description="Supprimé")
     * )
     */
    public function destroy(Commande $commande) { $commande->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
