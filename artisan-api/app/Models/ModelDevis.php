<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDevis extends Model
{
    use HasFactory;

    protected $fillable = [
        'cgv',
        'piedPage',
        'header',
        'IBAN',
        'lib',
        'entreprise_id'
        ];
}
