<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'lib',
        'img',
        'fabricant',
        'reference',
        'prix_achat',
        'prix_vente',
        'desc',
        'tva',
        'type_prestation_id',
        'type_traveux_id',
        'entreprise_id'
    ];

}
