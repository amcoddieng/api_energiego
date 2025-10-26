<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaiementController extends Controller
{
    /**
     * @OA\Get(path="/api/paiements", summary="Lister les paiements",
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Paiement"))
     *   )
     * )
     */
    public function index() { return response()->json(Paiement::all()); }
    /**
     * @OA\Get(path="/api/paiements/{id}", summary="Afficher un paiement",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Paiement"))
     * )
     */
    public function show(Paiement $paiement) { return response()->json($paiement); }
    public function store(Request $request) {
        $data = $request->validate([
            'montant' => 'required|numeric',
            'modePaiement' => 'required|string|max:254',
            'datePaiement' => 'required|date',
        ]);
        $model = Paiement::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    /**
     * @OA\Post(path="/api/paiements", summary="Créer un paiement",
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Paiement")),
     *   @OA\Response(response=201, description="Créé", @OA\JsonContent(ref="#/components/schemas/Paiement"))
     * )
     */
    public function update(Request $request, Paiement $paiement) {
        $data = $request->validate([
            'montant' => 'sometimes|required|numeric',
            'modePaiement' => 'sometimes|required|string|max:254',
            'datePaiement' => 'sometimes|required|date',
        ]);
        $paiement->update($data);
        return response()->json($paiement);
    }
    /**
     * @OA\Put(path="/api/paiements/{id}", summary="Mettre à jour un paiement",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Paiement")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Paiement"))
     * )
     * @OA\Delete(path="/api/paiements/{id}", summary="Supprimer un paiement",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=204, description="Supprimé")
     * )
     */
    public function destroy(Paiement $paiement) { $paiement->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
