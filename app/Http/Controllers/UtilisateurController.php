<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UtilisateurController extends Controller
{
    public function index()
    {
        return response()->json(Utilisateur::all());
    }

    public function show(Utilisateur $utilisateur)
    {
        return response()->json($utilisateur);
    }

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

    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
