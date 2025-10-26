<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    public function createUser(Request $req)
    {
        $validator = $req->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'role' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if($validator::fails()){
            return response()->json([
                'status'=>402,
                'message'=>'erreur'
            ]);
        }
        if(user::where('email',$req->email)->exist()){
            return response()->json([
                'status' => 400,
                'message' => 'Cet email est déjà utilisé.',
            ], 400);
        }

         $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'role' => $request->role ?? 'user',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Utilisateur créé avec succès.',
            'user' => $user,
        ], 201);
    }
}
