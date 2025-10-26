<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PromotionController extends Controller
{
    /**
     * @OA\Get(path="/api/promotions", summary="Lister les promotions",
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Promotion"))
     *   )
     * )
     */
    public function index() { return response()->json(Promotion::all()); }
    /**
     * @OA\Get(path="/api/promotions/{id}", summary="Afficher une promotion",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Promotion"))
     * )
     */
    public function show(Promotion $promotion) { return response()->json($promotion); }
    public function store(Request $request) {
        $data = $request->validate([
            'codePromo' => 'required|string|max:254',
            'reduction' => 'required|numeric',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date',
        ]);
        $model = Promotion::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    /**
     * @OA\Post(path="/api/promotions", summary="Créer une promotion",
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Promotion")),
     *   @OA\Response(response=201, description="Créé", @OA\JsonContent(ref="#/components/schemas/Promotion"))
     * )
     */
    public function update(Request $request, Promotion $promotion) {
        $data = $request->validate([
            'codePromo' => 'sometimes|required|string|max:254',
            'reduction' => 'sometimes|required|numeric',
            'dateDebut' => 'sometimes|required|date',
            'dateFin' => 'sometimes|required|date',
        ]);
        $promotion->update($data);
        return response()->json($promotion);
    }
    /**
     * @OA\Put(path="/api/promotions/{id}", summary="Mettre à jour une promotion",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Promotion")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Promotion"))
     * )
     * @OA\Delete(path="/api/promotions/{id}", summary="Supprimer une promotion",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=204, description="Supprimé")
     * )
     */
    public function destroy(Promotion $promotion) { $promotion->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
