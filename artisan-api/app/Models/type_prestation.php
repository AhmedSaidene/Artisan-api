<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_prestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'img',
        'lib',
        'entreprise_id'
    ];
}
