<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $table = 'Utilisateur';
    protected $primaryKey = 'id_utilisateur';
    public $timestamps = false;

    protected $fillable = [
        'nom','prenom','email','motDePasse','role','dateInscription'
    ];

    public function client() {
        return $this->hasOne(Client::class, 'id_utilisateur', 'id_utilisateur');
    }

    public function administrateur() {
        return $this->hasOne(Administrateur::class, 'id_utilisateur', 'id_utilisateur');
    }

    public function commandes() {
        return $this->hasManyThrough(
            Commande::class,
            Client::class,
            'id_utilisateur',
            'id_utilisateur',
            'id_utilisateur',
            'id_utilisateur'
        );
    }

    public function avis() {
        return $this->hasManyThrough(
            Avis::class,
            Client::class,
            'id_utilisateur',
            'id_utilisateur',
            'id_utilisateur',
            'id_utilisateur'
        );
    }
}
