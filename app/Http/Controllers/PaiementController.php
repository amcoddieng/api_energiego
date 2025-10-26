<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaiementController extends Controller
{
    public function index() { return response()->json(Paiement::all()); }
    public function show(Paiement $paiement) { return response()->json($paiement); }
    public function store(Request $request) {
        $data = $request->validate([
            'montant' => 'required|numeric',
            'modePaiement' => 'required|string|max:254',
            'datePaiement' => 'required|date',
        ]);
        $model = Paiement::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    public function update(Request $request, Paiement $paiement) {
        $data = $request->validate([
            'montant' => 'sometimes|required|numeric',
            'modePaiement' => 'sometimes|required|string|max:254',
            'datePaiement' => 'sometimes|required|date',
        ]);
        $paiement->update($data);
        return response()->json($paiement);
    }
    public function destroy(Paiement $paiement) { $paiement->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
