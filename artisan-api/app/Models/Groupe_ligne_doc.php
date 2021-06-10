<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe_ligne_doc extends Model
{
    use HasFactory;

    public function lignes()
    {
        return $this->hasMany(Devis_has_produit::class);
    }

    protected $fillable = [
        'document_id',
        'Intervention_id',
        'Type_traveaux_id',
        'type_prestation_id',
        ];
}

