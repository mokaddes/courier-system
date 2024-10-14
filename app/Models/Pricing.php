<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pricing extends Model
{
    use HasFactory;
    protected $table = 'pricings';



    public function hasPrice(): HasOne
    {
        return $this->hasOne(PricingGroup::class, 'id', 'pricing_group_id');
    }

    public function hasWeight(): BelongsTo
    {
        return $this->belongsTo(Weight::class, 'weight_id', 'id');
    }
}
