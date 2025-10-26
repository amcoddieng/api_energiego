<?php
namespace App\OpenApi;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="EnergieGo API",
 *     version="1.0.0",
 *     description="Documentation OpenAPI pour l'API EnergieGo"
 * )
 *
 * @OA\Server(
 *     url="/",
 *     description="Serveur local"
 * )
 *
 * @OA\Schema(
 *   schema="Produit",
 *   type="object",
 *   required={"id_categorie","id_marque","nom","description","prix","stock","image"},
 *   @OA\Property(property="id_produit", type="integer", example=1),
 *   @OA\Property(property="id_categorie", type="integer", example=2),
 *   @OA\Property(property="id_promotion", type="integer", nullable=true, example=null),
 *   @OA\Property(property="id_marque", type="integer", example=3),
 *   @OA\Property(property="nom", type="string", example="Panneau Solaire X"),
 *   @OA\Property(property="description", type="string", example="Haute performance"),
 *   @OA\Property(property="prix", type="number", format="float", example=499),
 *   @OA\Property(property="stock", type="integer", example=20),
 *   @OA\Property(property="image", type="string", example="/images/p1.jpg")
 * )
 *
 * @OA\Schema(
 *   schema="Utilisateur",
 *   type="object",
 *   required={"nom","prenom","email","motDePasse","role","dateInscription"},
 *   @OA\Property(property="id_utilisateur", type="integer", example=1),
 *   @OA\Property(property="nom", type="string", example="Doe"),
 *   @OA\Property(property="prenom", type="string", example="John"),
 *   @OA\Property(property="email", type="string", example="john@exemple.com"),
 *   @OA\Property(property="motDePasse", type="string", example="hashed"),
 *   @OA\Property(property="role", type="string", example="client"),
 *   @OA\Property(property="dateInscription", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *   schema="Categorie",
 *   type="object",
 *   required={"nom","description"},
 *   @OA\Property(property="id_categorie", type="integer", example=1),
 *   @OA\Property(property="nom", type="string"),
 *   @OA\Property(property="description", type="string")
 * )
 *
 * @OA\Schema(
 *   schema="Marque",
 *   type="object",
 *   required={"nom","paysOrigine"},
 *   @OA\Property(property="id_marque", type="integer", example=1),
 *   @OA\Property(property="nom", type="string"),
 *   @OA\Property(property="paysOrigine", type="string")
 * )
 *
 * @OA\Schema(
 *   schema="Promotion",
 *   type="object",
 *   required={"codePromo","reduction","dateDebut","dateFin"},
 *   @OA\Property(property="id_promotion", type="integer", example=1),
 *   @OA\Property(property="codePromo", type="string"),
 *   @OA\Property(property="reduction", type="number"),
 *   @OA\Property(property="dateDebut", type="string", format="date-time"),
 *   @OA\Property(property="dateFin", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *   schema="Paiement",
 *   type="object",
 *   required={"montant","modePaiement","datePaiement"},
 *   @OA\Property(property="id_paiement", type="integer", example=1),
 *   @OA\Property(property="montant", type="number"),
 *   @OA\Property(property="modePaiement", type="string"),
 *   @OA\Property(property="datePaiement", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *   schema="Client",
 *   type="object",
 *   required={"id_utilisateur","adresse","telephone"},
 *   @OA\Property(property="id_utilisateur", type="integer", example=1),
 *   @OA\Property(property="adresse", type="string"),
 *   @OA\Property(property="telephone", type="string")
 * )
 *
 * @OA\Schema(
 *   schema="Administrateur",
 *   type="object",
 *   required={"id_utilisateur"},
 *   @OA\Property(property="id_utilisateur", type="integer", example=1)
 * )
 *
 * @OA\Schema(
 *   schema="Commande",
 *   type="object",
 *   required={"id_paiement","id_utilisateur","dateCommande","statut","total"},
 *   @OA\Property(property="id_commande", type="integer", example=1),
 *   @OA\Property(property="id_paiement", type="integer"),
 *   @OA\Property(property="id_utilisateur", type="integer"),
 *   @OA\Property(property="dateCommande", type="string", format="date-time"),
 *   @OA\Property(property="statut", type="string"),
 *   @OA\Property(property="total", type="number")
 * )
 *
 * @OA\Schema(
 *   schema="LigneCommande",
 *   type="object",
 *   required={"id_produit","id_commande","quantite","sousTotal"},
 *   @OA\Property(property="id_ligne_commande", type="integer", example=1),
 *   @OA\Property(property="id_produit", type="integer"),
 *   @OA\Property(property="id_commande", type="integer"),
 *   @OA\Property(property="quantite", type="integer"),
 *   @OA\Property(property="sousTotal", type="number")
 * )
 *
 * @OA\Schema(
 *   schema="Avis",
 *   type="object",
 *   required={"id_produit","id_utilisateur","note","commentaire","dateAvis"},
 *   @OA\Property(property="id_avis", type="integer", example=1),
 *   @OA\Property(property="id_produit", type="integer"),
 *   @OA\Property(property="id_utilisateur", type="integer"),
 *   @OA\Property(property="note", type="integer"),
 *   @OA\Property(property="commentaire", type="string"),
 *   @OA\Property(property="dateAvis", type="string", format="date-time")
 * )
 */
class OpenApiSpec {}
