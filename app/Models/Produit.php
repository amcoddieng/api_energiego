<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'Produit';
    protected $primaryKey = 'id_produit';
    public $timestamps = false;

    protected $fillable = [
        'id_categorie','id_promotion','id_marque','nom','description','prix','stock','image'
    ];

    public function getRouteKeyName(): string
    {
        return 'id_produit';
    }

    public function categorie() {
        return $this->belongsTo(Categorie::class, 'id_categorie', 'id_categorie');
    }

    public function marque() {
        return $this->belongsTo(Marque::class, 'id_marque', 'id_marque');
    }

    public function promotion() {
        return $this->belongsTo(Promotion::class, 'id_promotion', 'id_promotion');
    }

    public function lignes() {
        return $this->hasMany(LigneCommande::class, 'id_produit', 'id_produit');
    }

    public function avis() {
        return $this->hasMany(Avis::class, 'id_produit', 'id_produit');
    }
}
