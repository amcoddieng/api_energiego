<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProduitController extends Controller
{
    public function index() { return response()->json(Produit::all()); }

    public function show(Produit $produit) { return response()->json($produit); }

    public function store(Request $request) {
        $data = $request->validate([
            'id_categorie' => 'required|integer|exists:Categorie,id_categorie',
            'id_promotion' => 'nullable|integer|exists:Promotion,id_promotion',
            'id_marque' => 'required|integer|exists:Marque,id_marque',
            'nom' => 'required|string|max:254',
            'description' => 'required|string|max:254',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|string|max:254',
        ]);
        $model = Produit::create($data);
        return response()->json($model, Response::HTTP_CREATED);
    }

    public function update(Request $request, Produit $produit) {
        $data = $request->validate([
            'id_categorie' => 'sometimes|required|integer|exists:Categorie,id_categorie',
            'id_promotion' => 'nullable|integer|exists:Promotion,id_promotion',
            'id_marque' => 'sometimes|required|integer|exists:Marque,id_marque',
            'nom' => 'sometimes|required|string|max:254',
            'description' => 'sometimes|required|string|max:254',
            'prix' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
            'image' => 'sometimes|required|string|max:254',
        ]);
        $produit->update($data);
        return response()->json($produit);
    }

    public function destroy(Produit $produit) { $produit->delete(); return response()->json(null, Response::HTTP_NO_CONTENT); }
}
