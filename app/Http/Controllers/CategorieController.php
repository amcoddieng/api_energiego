<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategorieController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/categories",
     *   summary="Lister les catégories",
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Categorie"))
     *   )
     * )
     */
    public function index()
    {
        return response()->json(Categorie::all());
    }

    /**
     * @OA\Get(
     *   path="/api/categories/{id}",
     *   summary="Afficher une catégorie",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Categorie")),
     *   @OA\Response(response=404, description="Non trouvé")
     * )
     */
    public function show(Categorie $categorie)
    {
        return response()->json($categorie);
    }

    /**
     * @OA\Post(
     *   path="/api/categories",
     *   summary="Créer une catégorie",
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Categorie")),
     *   @OA\Response(response=201, description="Créé", @OA\JsonContent(ref="#/components/schemas/Categorie")),
     *   @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:254',
            'description' => 'required|string|max:254',
        ]);
        $model = Categorie::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *   path="/api/categories/{id}",
     *   summary="Mettre à jour une catégorie",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Categorie")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Categorie")),
     *   @OA\Response(response=422, description="Validation error"),
     *   @OA\Response(response=404, description="Non trouvé")
     * )
     */
    public function update(Request $request, Categorie $categorie)
    {
        $data = $request->validate([
            'nom' => 'sometimes|required|string|max:254',
            'description' => 'sometimes|required|string|max:254',
        ]);
        $categorie->update($data);
        return response()->json($categorie);
    }

    /**
     * @OA\Delete(
     *   path="/api/categories/{id}",
     *   summary="Supprimer une catégorie",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=204, description="Supprimé"),
     *   @OA\Response(response=404, description="Non trouvé")
     * )
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
