<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'Categorie';
    protected $primaryKey = 'id_categorie';
    public $timestamps = false;

    protected $fillable = ['nom','description'];

    public function produits() {
        return $this->hasMany(Produit::class, 'id_categorie', 'id_categorie');
    }
}
