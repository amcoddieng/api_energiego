<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *   path="/api/auth/login",
     *   summary="Connexion (tous rôles)",
     *   @OA\RequestBody(required=true, @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", example="john@exemple.com"),
     *       @OA\Property(property="password", type="string", example="secret"),
     *       @OA\Property(property="role", type="string", nullable=true, example="client")
     *   )),
     *   @OA\Response(response=200, description="OK",
     *     @OA\JsonContent(@OA\Property(property="token", type="string"), @OA\Property(property="user", ref="#/components/schemas/Utilisateur"))
     *   ),
     *   @OA\Response(response=401, description="Identifiants invalides")
     * )
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'role' => 'nullable|string',
        ]);

        $user = Utilisateur::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->motDePasse)) {
            return response()->json(['message' => 'Identifiants invalides'], Response::HTTP_UNAUTHORIZED);
        }
        if (!empty($data['role']) && strtolower($user->role) !== strtolower($data['role'])) {
            return response()->json(['message' => 'Accès refusé pour ce rôle'], Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->createToken('api')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user]);
    }

    /**
     * @OA\Post(
     *   path="/api/auth/admin/login",
     *   summary="Connexion administrateur",
     *   @OA\RequestBody(required=true, @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string"),
     *       @OA\Property(property="password", type="string")
     *   )),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Identifiants invalides")
     * )
     */
    public function adminLogin(Request $request)
    {
        $request->merge(['role' => 'admin']);
        return $this->login($request);
    }

    /**
     * @OA\Post(
     *   path="/api/auth/user/login",
     *   summary="Connexion client/utilisateur",
     *   @OA\RequestBody(required=true, @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string"),
     *       @OA\Property(property="password", type="string")
     *   )),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Identifiants invalides")
     * )
     */
    public function userLogin(Request $request)
    {
        $request->merge(['role' => 'client']);
        return $this->login($request);
    }

    /**
     * @OA\Post(
     *   path="/api/auth/logout",
     *   summary="Déconnexion",
     *   security={{{"sanctum":{}}}},
     *   @OA\Response(response=204, description="Déconnecté")
     * )
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @OA\Get(
     *   path="/api/auth/me",
     *   summary="Profil courant",
     *   security={{{"sanctum":{}}}},
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Utilisateur"))
     * )
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
