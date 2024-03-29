<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class type_prestation extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'img',
        'lib',
        'entreprise_id'
    ];
    
    public $translatable = ['lib'];
}
