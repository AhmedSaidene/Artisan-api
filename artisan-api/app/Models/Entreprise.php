<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    public function modelDevis()
    {
        return $this->hasOne(ModelDevis::class);
    }

    protected $fillable = [
        'lib',
        'email',
        'adresse',
        'tel',
        'logo'
        ];
}
