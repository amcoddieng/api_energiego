<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategorieController extends Controller
{
    public function index()
    {
        return response()->json(Categorie::all());
    }

    public function show(Categorie $categorie)
    {
        return response()->json($categorie);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:254',
            'description' => 'required|string|max:254',
        ]);
        $model = Categorie::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }

    public function update(Request $request, Categorie $categorie)
    {
        $data = $request->validate([
            'nom' => 'sometimes|required|string|max:254',
            'description' => 'sometimes|required|string|max:254',
        ]);
        $categorie->update($data);
        return response()->json($categorie);
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
