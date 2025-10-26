<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    public function index() { return response()->json(Client::all()); }
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
    public function update(Request $request, Client $client) {
        $data = $request->validate([
            'adresse' => 'sometimes|required|string|max:254',
            'telephone' => 'sometimes|required|string|max:254',
        ]);
        $client->update($data);
        return response()->json($client);
    }
    public function destroy(Client $client) { $client->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
