<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PdeliveryRequest extends Model
{
    use HasFactory;
    
    protected $table = 'pickup_request_to_deliveryman';

    public function hasDeliveryman(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'deliveryman_id', 'id');
    }

    public function pickupRequest(): BelongsTo
    {
        return $this->belongsTo(PickupRequest::class,'pickup_request_id')->with(['city','deliveryCity', 'hasMerchant', 'hasPickupState', 'hasDeliveryState',]);
    }
}
