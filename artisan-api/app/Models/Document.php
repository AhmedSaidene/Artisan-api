<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    protected $fillable = [
        'type',
        'IBAN',
        'SWIFT_BIC',
        'tva',
        'total_HT',
        'total_TVA',
        'total_TTC',
        'statut',
        'cgv',
        'piedPage',
        'client_id',
        'intervention_id',
        'type_traveaux_id',
        'type_prestation_id',
        'model_devis_id'
    ];
}
