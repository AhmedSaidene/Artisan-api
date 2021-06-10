<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis_has_produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'prix_par_achat',
        'prix_par_vente_unitaire',
        'prix_par_total_HT',
          'quantite',
           'tva',
           'reference',
            'desc',
            'groupe_ligne_doc_id',
           'produit_id'
    ];
}
