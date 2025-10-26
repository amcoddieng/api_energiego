<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'Client';
    protected $primaryKey = 'id_utilisateur';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['id_utilisateur','adresse','telephone'];

    public function utilisateur() {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur', 'id_utilisateur');
    }

    public function commandes() {
        return $this->hasMany(Commande::class, 'id_utilisateur', 'id_utilisateur');
    }

    public function avis() {
        return $this->hasMany(Avis::class, 'id_utilisateur', 'id_utilisateur');
    }
}
