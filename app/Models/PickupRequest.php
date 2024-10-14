<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PickupRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'pickup_name',
        'pickup_contact_name',
        'pickup_address',
        'pickup_street_address',
        'pickup_city',
        'pickup_zip',
        'pickup_mobile',
        'pickup_email',
        'delivery_name',
        'delivery_contact_name',
        'delivery_address',
        'delivery_street_address',
        'delivery_city',
        'delivery_zip',
        'delivery_mobile',
        'quantity',
        'weight',
        'cod_amount',
        'description',
        'status',
        'deliveryman_id',
    ];
    protected $appends = ['due_amount'];

    public function city()
    {
        return $this->belongsTo(City::class, 'pickup_city', 'id');
    }

    public function deliveryCity()
    {
        return $this->belongsTo(City::class, 'delivery_city', 'id');
    }

    public function weights()
    {
        return $this->belongsTo(Weight::class, 'weight', 'id');
    }


    public function hasMerchant(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'merchant_id', 'id');
    }

    public function hasDeliveryman(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'deliveryman_id', 'id');
    }

    public function hasPickupState(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'pickup_street_address', 'id');

    }

    public function hasDeliveryState(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'delivery_street_address', 'id');

    }

    public function pendingRequest()
    {
        return $this->hasMany(PickupRequest::class, 'pickup_request_id');
    }

    public function hasPriceGroup()
    {
        return $this->hasOne(PricingGroup::class,'id', 'pricing_group_id');
    }

    public function getDueAmountAttribute() :int
    {

        if ($this->payment_status == "0") {
            return $this->cod_amount + $this->amount;
        } else {
            return $this->cod_amount;
        }

    }

}
