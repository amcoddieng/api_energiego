<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MarqueController extends Controller
{
    public function index() { return response()->json(Marque::all()); }
    public function show(Marque $marque) { return response()->json($marque); }
    public function store(Request $request) {
        $data = $request->validate([
            'nom' => 'required|string|max:254',
            'paysOrigine' => 'required|string|max:254',
        ]);
        $model = Marque::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }
    public function update(Request $request, Marque $marque) {
        $data = $request->validate([
            'nom' => 'sometimes|required|string|max:254',
            'paysOrigine' => 'sometimes|required|string|max:254',
        ]);
        $marque->update($data);
        return response()->json($marque);
    }
    public function destroy(Marque $marque) { $marque->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
