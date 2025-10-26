<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $table = 'Paiement';
    protected $primaryKey = 'id_paiement';
    public $timestamps = false;

    protected $fillable = ['montant','modePaiement','datePaiement'];

    public function commandes() {
        return $this->hasMany(Commande::class, 'id_paiement', 'id_paiement');
    }
}
