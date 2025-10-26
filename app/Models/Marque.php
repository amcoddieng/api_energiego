<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    protected $table = 'Marque';
    protected $primaryKey = 'id_marque';
    public $timestamps = false;

    protected $fillable = ['nom','paysOrigine'];

    public function produits() {
        return $this->hasMany(Produit::class, 'id_marque', 'id_marque');
    }
}
