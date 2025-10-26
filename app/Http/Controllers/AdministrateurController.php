<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdministrateurController extends Controller
{
    public function index() { return response()->json(Administrateur::all()); }
    public function show(Administrateur $administrateur) { return response()->json($administrateur); }
    public function store(Request $request) {
        $data = $request->validate([
            'id_utilisateur' => 'required|integer|exists:Utilisateur,id_utilisateur|unique:Administrateur,id_utilisateur',
        ]);
        $model = Administrateur::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    public function update(Request $request, Administrateur $administrateur) {
        // rien à mettre à jour hormis lier un autre utilisateur (peu probable)
        $data = $request->validate([
            'id_utilisateur' => 'required|integer|exists:Utilisateur,id_utilisateur|unique:Administrateur,id_utilisateur,' . $administrateur->id_utilisateur . ',id_utilisateur',
        ]);
        $administrateur->update($data);
        return response()->json($administrateur);
    }
    public function destroy(Administrateur $administrateur) { $administrateur->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
