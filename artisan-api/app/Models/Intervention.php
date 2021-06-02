<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Intervention extends Model
{
    use HasTranslations, HasFactory;

    
    protected $fillable = [
        'img',
        'lib',
        'entreprise_id'
    ];

    public $translatable = ['lib'];
}
/*

*/