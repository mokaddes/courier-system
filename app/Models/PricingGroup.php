<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PricingGroup extends Model
{
    use HasFactory;
    protected $table = 'pricing_group';


    public function pricing()
    {
        return $this->hasMany('App\Models\Pricing')->with('hasWeight');
    }



}
