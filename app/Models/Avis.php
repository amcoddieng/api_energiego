<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $table = 'Avis';
    protected $primaryKey = 'id_avis';
    public $timestamps = false;

    protected $fillable = [
        'id_produit','id_utilisateur','note','commentaire','dateAvis'
    ];

    public function produit() {
        return $this->belongsTo(Produit::class, 'id_produit', 'id_produit');
    }

    public function client() {
        return $this->belongsTo(Client::class, 'id_utilisateur', 'id_utilisateur');
    }
}
