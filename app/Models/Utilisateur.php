<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasApiTokens;
    protected $table = 'Utilisateur';
    protected $primaryKey = 'id_utilisateur';
    public $timestamps = false;

    protected $fillable = [
        'nom','prenom','email','motDePasse','role','dateInscription'
    ];

    public function getRouteKeyName(): string
    {
        return 'id_utilisateur';
    }

    public function setMotDePasseAttribute($value): void
    {
        if ($value && !str_starts_with((string) $value, '$2y$')) {
            $this->attributes['motDePasse'] = Hash::make($value);
        } else {
            $this->attributes['motDePasse'] = $value;
        }
    }

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
