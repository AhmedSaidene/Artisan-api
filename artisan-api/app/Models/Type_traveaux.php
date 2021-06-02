<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Type_traveaux extends Model
{
    use HasFactory, HasTranslations;

    
    protected $fillable = [
        'img',
        'lib',
        'entreprise_id'
    ];
    public $translatable = ['lib'];
}
