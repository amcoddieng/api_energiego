<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * @OA\Get(path="/api/clients", summary="Lister les clients",
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Client"))
     *   )
     * )
     */
    public function index() { return response()->json(Client::all()); }
    /**
     * @OA\Get(path="/api/clients/{id}", summary="Afficher un client",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Client"))
     * )
     */
    public function show(Client $client) { return response()->json($client); }
    public function store(Request $request) {
        $data = $request->validate([
            'id_utilisateur' => 'required|integer|exists:Utilisateur,id_utilisateur|unique:Client,id_utilisateur',
            'adresse' => 'required|string|max:254',
            'telephone' => 'required|string|max:254',
        ]);
        $model = Client::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    /**
     * @OA\Post(path="/api/clients", summary="Créer un client",
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Client")),
     *   @OA\Response(response=201, description="Créé", @OA\JsonContent(ref="#/components/schemas/Client"))
     * )
     */
    public function update(Request $request, Client $client) {
        $data = $request->validate([
            'adresse' => 'sometimes|required|string|max:254',
            'telephone' => 'sometimes|required|string|max:254',
        ]);
        $client->update($data);
        return response()->json($client);
    }
    /**
     * @OA\Put(path="/api/clients/{id}", summary="Mettre à jour un client",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Client")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Client"))
     * )
     * @OA\Delete(path="/api/clients/{id}", summary="Supprimer un client",
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=204, description="Supprimé")
     * )
     */
    public function destroy(Client $client) { $client->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
