<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AvisController extends Controller
{
    /**
     * @OA\Get(path="/api/avis", summary="Lister les avis",
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Avis"))
     *   )
     * )
     */
    public function index() { return response()->json(Avis::all()); }
    /**
     * @OA\Get(path="/api/avis/{id}", summary="Afficher un avis",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Avis"))
     * )
     */
    public function show(Avis $avi) { return response()->json($avi); }
    public function store(Request $request) {
        $data = $request->validate([
            'id_produit' => 'required|integer|exists:Produit,id_produit',
            'id_utilisateur' => 'required|integer|exists:Client,id_utilisateur',
            'note' => 'required|integer',
            'commentaire' => 'required|string|max:254',
            'dateAvis' => 'required|date',
        ]);
        $model = Avis::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    /**
     * @OA\Post(path="/api/avis", summary="Créer un avis",
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Avis")),
     *   @OA\Response(response=201, description="Créé", @OA\JsonContent(ref="#/components/schemas/Avis"))
     * )
     */
    public function update(Request $request, Avis $avi) {
        $data = $request->validate([
            'id_produit' => 'sometimes|required|integer|exists:Produit,id_produit',
            'id_utilisateur' => 'sometimes|required|integer|exists:Client,id_utilisateur',
            'note' => 'sometimes|required|integer',
            'commentaire' => 'sometimes|required|string|max:254',
            'dateAvis' => 'sometimes|required|date',
        ]);
        $avi->update($data);
        return response()->json($avi);
    }
    /**
     * @OA\Put(path="/api/avis/{id}", summary="Mettre à jour un avis",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Avis")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Avis"))
     * )
     * @OA\Delete(path="/api/avis/{id}", summary="Supprimer un avis",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=204, description="Supprimé")
     * )
     */
    public function destroy(Avis $avi) { $avi->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
