<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use OpenApi\Annotations as OA;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProduitController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/produits",
     *   summary="Lister les produits",
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Produit"))
     *   )
     * )
     */
    public function index() { return response()->json(Produit::all()); }

    /**
     * @OA\Get(
     *   path="/api/produits/{id}",
     *   summary="Afficher un produit",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Produit")),
     *   @OA\Response(response=404, description="Non trouvé")
     * )
     */
    public function show(Produit $produit) { return response()->json($produit); }

    /**
     * @OA\Post(
     *   path="/api/produits",
     *   summary="Créer un produit",
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Produit")),
     *   @OA\Response(response=201, description="Créé", @OA\JsonContent(ref="#/components/schemas/Produit")),
     *   @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request) {
        $data = $request->validate([
            'id_categorie' => 'required|integer|exists:Categorie,id_categorie',
            'id_promotion' => 'nullable|integer|exists:Promotion,id_promotion',
            'id_marque' => 'required|integer|exists:Marque,id_marque',
            'nom' => 'required|string|max:254',
            'description' => 'required|string|max:254',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|string|max:254',
        ]);
        $model = Produit::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *   path="/api/produits/{id}",
     *   summary="Mettre à jour un produit",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Produit")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Produit")),
     *   @OA\Response(response=422, description="Validation error"),
     *   @OA\Response(response=404, description="Non trouvé")
     * )
     */
    public function update(Request $request, Produit $produit) {
        $data = $request->validate([
            'id_categorie' => 'sometimes|required|integer|exists:Categorie,id_categorie',
            'id_promotion' => 'nullable|integer|exists:Promotion,id_promotion',
            'id_marque' => 'sometimes|required|integer|exists:Marque,id_marque',
            'nom' => 'sometimes|required|string|max:254',
            'description' => 'sometimes|required|string|max:254',
            'prix' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
            'image' => 'sometimes|required|string|max:254',
        ]);
        $produit->update($data);
        return response()->json($produit);
    }

    /**
     * @OA\Delete(
     *   path="/api/produits/{id}",
     *   summary="Supprimer un produit",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=204, description="Supprimé"),
     *   @OA\Response(response=404, description="Non trouvé")
     * )
     */
    public function destroy(Produit $produit) { $produit->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
