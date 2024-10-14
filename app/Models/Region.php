<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    public function city(): HasMany
    {
        return $this->hasMany(City::class,'region_id','id');
    }
}
