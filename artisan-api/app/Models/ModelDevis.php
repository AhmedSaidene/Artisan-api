<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDevis extends Model
{
    use HasFactory;

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    
    protected $fillable = [
        'cgv',
        'piedPage',
        'header',
        'IBAN',
        'lib',
        'entreprise_id'
        ];
}
