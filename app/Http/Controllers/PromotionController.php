<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PromotionController extends Controller
{
    public function index() { return response()->json(Promotion::all()); }
    public function show(Promotion $promotion) { return response()->json($promotion); }
    public function store(Request $request) {
        $data = $request->validate([
            'codePromo' => 'required|string|max:254',
            'reduction' => 'required|numeric',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date',
        ]);
        $model = Promotion::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    public function update(Request $request, Promotion $promotion) {
        $data = $request->validate([
            'codePromo' => 'sometimes|required|string|max:254',
            'reduction' => 'sometimes|required|numeric',
            'dateDebut' => 'sometimes|required|date',
            'dateFin' => 'sometimes|required|date',
        ]);
        $promotion->update($data);
        return response()->json($promotion);
    }
    public function destroy(Promotion $promotion) { $promotion->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
