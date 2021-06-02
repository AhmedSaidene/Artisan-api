<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'img',
        'lib',
        'entreprise_id'
    ];

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
