<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'Commande';
    protected $primaryKey = 'id_commande';
    public $timestamps = false;

    protected $fillable = [
        'id_paiement','id_utilisateur','dateCommande','statut','total'
    ];

    public function client() {
        return $this->belongsTo(Client::class, 'id_utilisateur', 'id_utilisateur');
    }

    public function paiement() {
        return $this->belongsTo(Paiement::class, 'id_paiement', 'id_paiement');
    }

    public function lignes() {
        return $this->hasMany(LigneCommande::class, 'id_commande', 'id_commande');
    }
}
