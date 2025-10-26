<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdministrateurController extends Controller
{
    /**
     * @OA\Get(path="/api/administrateurs", summary="Lister les administrateurs",
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Administrateur"))
     *   )
     * )
     */
    public function index() { return response()->json(Administrateur::all()); }
    /**
     * @OA\Get(path="/api/administrateurs/{id}", summary="Afficher un administrateur",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Administrateur"))
     * )
     */
    public function show(Administrateur $administrateur) { return response()->json($administrateur); }
    public function store(Request $request) {
        $data = $request->validate([
            'id_utilisateur' => 'required|integer|exists:Utilisateur,id_utilisateur|unique:Administrateur,id_utilisateur',
        ]);
        $model = Administrateur::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    /**
     * @OA\Post(path="/api/administrateurs", summary="Créer un administrateur",
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Administrateur")),
     *   @OA\Response(response=201, description="Créé", @OA\JsonContent(ref="#/components/schemas/Administrateur"))
     * )
     */
    public function update(Request $request, Administrateur $administrateur) {
        // rien à mettre à jour hormis lier un autre utilisateur (peu probable)
        $data = $request->validate([
            'id_utilisateur' => 'required|integer|exists:Utilisateur,id_utilisateur|unique:Administrateur,id_utilisateur,' . $administrateur->id_utilisateur . ',id_utilisateur',
        ]);
        $administrateur->update($data);
        return response()->json($administrateur);
    }
    /**
     * @OA\Put(path="/api/administrateurs/{id}", summary="Mettre à jour un administrateur",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Administrateur")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Administrateur"))
     * )
     * @OA\Delete(path="/api/administrateurs/{id}", summary="Supprimer un administrateur",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=204, description="Supprimé")
     * )
     */
    public function destroy(Administrateur $administrateur) { $administrateur->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
