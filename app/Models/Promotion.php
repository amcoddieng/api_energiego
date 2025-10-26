<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'Promotion';
    protected $primaryKey = 'id_promotion';
    public $timestamps = false;

    protected $fillable = ['codePromo','reduction','dateDebut','dateFin'];

    public function produits() {
        return $this->hasMany(Produit::class, 'id_promotion', 'id_promotion');
    }
}
