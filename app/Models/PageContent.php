<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{


    
    use HasFactory;

    protected $fillable = [
        'about_us',
        'privacy_policy',
        'terms_condition'
    ];
}
