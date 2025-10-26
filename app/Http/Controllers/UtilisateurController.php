<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UtilisateurController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/utilisateurs",
     *   summary="Lister les utilisateurs",
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Utilisateur"))
     *   )
     * )
     */
    public function index()
    {
        return response()->json(Utilisateur::all());
    }

    /**
     * @OA\Get(
     *   path="/api/utilisateurs/{id}",
     *   summary="Afficher un utilisateur",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Utilisateur")),
     *   @OA\Response(response=404, description="Non trouvé")
     * )
     */
    public function show(Utilisateur $utilisateur)
    {
        return response()->json($utilisateur);
    }

    /**
     * @OA\Post(
     *   path="/api/utilisateurs",
     *   summary="Créer un utilisateur",
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Utilisateur")),
     *   @OA\Response(response=201, description="Créé", @OA\JsonContent(ref="#/components/schemas/Utilisateur")),
     *   @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:254',
            'prenom' => 'required|string|max:254',
            'email' => 'required|string|max:254',
            'motDePasse' => 'required|string|max:254',
            'role' => 'required|string|max:254',
            'dateInscription' => 'required|date',
        ]);
        $model = Utilisateur::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *   path="/api/utilisateurs/{id}",
     *   summary="Mettre à jour un utilisateur",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Utilisateur")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Utilisateur")),
     *   @OA\Response(response=422, description="Validation error"),
     *   @OA\Response(response=404, description="Non trouvé")
     * )
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {
        $data = $request->validate([
            'nom' => 'sometimes|required|string|max:254',
            'prenom' => 'sometimes|required|string|max:254',
            'email' => 'sometimes|required|string|max:254',
            'motDePasse' => 'sometimes|required|string|max:254',
            'role' => 'sometimes|required|string|max:254',
            'dateInscription' => 'sometimes|required|date',
        ]);
        $utilisateur->update($data);
        return response()->json($utilisateur);
    }

    /**
     * @OA\Delete(
     *   path="/api/utilisateurs/{id}",
     *   summary="Supprimer un utilisateur",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=204, description="Supprimé"),
     *   @OA\Response(response=404, description="Non trouvé")
     * )
     */
    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
