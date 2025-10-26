<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MarqueController extends Controller
{
    /**
     * @OA\Get(path="/api/marques", summary="Lister les marques",
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Marque"))
     *   )
     * )
     */
    public function index() { return response()->json(Marque::all()); }
    /**
     * @OA\Get(path="/api/marques/{id}", summary="Afficher une marque",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Marque")),
     *   @OA\Response(response=404, description="Non trouvé")
     * )
     */
    public function show(Marque $marque) { return response()->json($marque); }
    public function store(Request $request) {
        $data = $request->validate([
            'nom' => 'required|string|max:254',
            'paysOrigine' => 'required|string|max:254',
        ]);
        $model = Marque::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    /**
     * @OA\Post(path="/api/marques", summary="Créer une marque",
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Marque")),
     *   @OA\Response(response=201, description="Créé", @OA\JsonContent(ref="#/components/schemas/Marque"))
     * )
     */
    public function update(Request $request, Marque $marque) {
        $data = $request->validate([
            'nom' => 'sometimes|required|string|max:254',
            'paysOrigine' => 'sometimes|required|string|max:254',
        ]);
        $marque->update($data);
        return response()->json($marque);
    }
    /**
     * @OA\Put(path="/api/marques/{id}", summary="Mettre à jour une marque",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Marque")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Marque"))
     * )
     * @OA\Delete(path="/api/marques/{id}", summary="Supprimer une marque",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=204, description="Supprimé")
     * )
     */
    public function destroy(Marque $marque) { $marque->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
