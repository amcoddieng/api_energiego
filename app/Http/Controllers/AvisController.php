<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AvisController extends Controller
{
    public function index() { return response()->json(Avis::all()); }
    public function show(Avis $avi) { return response()->json($avi); }
    public function store(Request $request) {
        $data = $request->validate([
            'id_produit' => 'required|integer|exists:Produit,id_produit',
            'id_utilisateur' => 'required|integer|exists:Client,id_utilisateur',
            'note' => 'required|integer',
            'commentaire' => 'required|string|max:254',
            'dateAvis' => 'required|date',
        ]);
        $model = Avis::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    public function update(Request $request, Avis $avi) {
        $data = $request->validate([
            'id_produit' => 'sometimes|required|integer|exists:Produit,id_produit',
            'id_utilisateur' => 'sometimes|required|integer|exists:Client,id_utilisateur',
            'note' => 'sometimes|required|integer',
            'commentaire' => 'sometimes|required|string|max:254',
            'dateAvis' => 'sometimes|required|date',
        ]);
        $avi->update($data);
        return response()->json($avi);
    }
    public function destroy(Avis $avi) { $avi->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
