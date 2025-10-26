<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    protected $table = 'LigneCommande';
    protected $primaryKey = 'id_ligne_commande';
    public $timestamps = false;

    protected $fillable = [
        'id_produit','id_commande','quantite','sousTotal'
    ];

    public function commande() {
        return $this->belongsTo(Commande::class, 'id_commande', 'id_commande');
    }

    public function produit() {
        return $this->belongsTo(Produit::class, 'id_produit', 'id_produit');
    }
}
